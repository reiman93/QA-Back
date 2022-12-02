<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\ChlorineNozzleInspection;

use Illuminate\Http\Request;

class ChlorineNozzleInspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ChlorineNozzleInspection::all();

        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.ChlorineNozzleInspection.index',compact('data','offset','cantPages','total'));
        }
    }

  /**
     * Data with pagin and filters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paginateFilter(Request $request)
    {
        if($request->orSearchFields){
            switch ($request->orSearchFields[0]['operation']) {
                case 'distint':
                    $operator="<>";
                    $search=$request->orSearchFields[0]['values'][0];
                    break;
                case 'equals':
                       $operator="=";
                       $search=$request->orSearchFields[0]['values'][0];
                case 'contains':
                       $operator="LIKE";
                       $search="%".$request->orSearchFields[0]['values'][0]."%";
                       break;
                default:
                    
                    break;
            }
            $this->operator= $operator;
            $this->search= $search;

            if($request->orSearchFields[0]['field']=="users"){
                $data = ChlorineNozzleInspection::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
               
                $total=count(ChlorineNozzleInspection::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->toArray());
            
            }else{
                $data = ChlorineNozzleInspection::with('users')->where('chlorine_nozzles.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
                $total=count(ChlorineNozzleInspection::with('users')->where('chlorine_nozzles.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
            }
            
        }else{
            $data = ChlorineNozzleInspection::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(ChlorineNozzleInspection::all());
        }
      
           if($request->wantsJson()){
               return response()->json(array('data'=>array('chlorine_nozzles'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*cat=Categoria::pluck('nombre','id')
        return view('modules.ChlorineNozzleInspection.create',compact('libro','categoria'));
        */
        return view('modules.ChlorineNozzleInspection.create');
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'auditor_user_id'=> 'required',
            'date',
            'action', /*Relapse action*/
            'period' => 'required',
            'time' => 'required',
            'clorine' => 'required',
            'nozzels_working_propiety' => 'required',
            'flugged_nozzels' => 'required',
            'barrel_checked' => 'required',
            'chlorine_added' => 'required',
            'comments' => 'required'
        ]);
      //  var_dump($request['auditor_user_id'])
        $user_data = User::where('users.username','=', $request->auditor_user_id)->get()->toArray();

        $request['auditor_user_id']=$user_data[0]['id'];

        $data= ChlorineNozzleInspection::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('ChlorineNozzleInspection');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChlorineNozzleInspection  $ChlorineNozzleInspection
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=ChlorineNozzleInspection::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.ChlorineNozzleInspection.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChlorineNozzleInspection  $ChlorineNozzleInspection
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=ChlorineNozzleInspection::findOrfail($id);    
        return view('modules.ChlorineNozzleInspection.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChlorineNozzleInspection  $ChlorineNozzleInspection
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         ChlorineNozzleInspection::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChlorineNozzleInspection  $ChlorineNozzleInspection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'auditor_user_id'=> 'required',
            'date',
            'action', /*Relapse action*/
            'period' => 'required',
            'time' => 'required',
            'clorine' => 'required',
            'nozzels_working_propiety' => 'required',
            'flugged_nozzels' => 'required',
            'barrel_checked' => 'required',
            'chlorine_added' => 'required',
            'comments' => 'required'
        ]);

        $request['date']=date('Y-m-d');//strtotime($request['date']);
    
        $user_data = User::where('users.username','=', $request->auditor_user_id)->get()->toArray();

        $request['auditor_user_id']=$user_data[0]['id'];
         ChlorineNozzleInspection::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('ChlorineNozzleInspection.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChlorineNozzleInspection  $ChlorineNozzleInspection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       ChlorineNozzleInspection::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChlorineNozzleInspection  $ChlorineNozzleInspection
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        ChlorineNozzleInspection::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}

