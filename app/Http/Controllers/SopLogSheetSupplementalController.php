<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SopLogSheetSupplemental;
use App\Models\User;

class SopLogSheetSupplementalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
       $data = SopLogSheetSupplemental::all();
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.SopLogSheetSupplemental.index',compact('data','offset','cantPages','total'));
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
                $data = SopLogSheetSupplemental::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
               
                $total=count(SopLogSheetSupplemental::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->toArray());
            
            }else{
                $data = SopLogSheetSupplemental::with('users')->where('sop_sheet_supplems.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
                $total=count(SopLogSheetSupplemental::with('users')->where('sop_sheet_supplems.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
            }
            
        }else{
            $data = SopLogSheetSupplemental::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(SopLogSheetSupplemental::all());
        }
      
           if($request->wantsJson()){
               return response()->json(array('data'=>array('sop_suplement'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.SopLogSheetSupplemental.create',compact('libro','categoria'));
        */
        return view('modules.SopLogSheetSupplemental.create');
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
            'date',
            'verifyed_by',
            'decfects_description',
            'disposition_of_product',
             'restoration_sanitary_condition',
             'root_cause',
             'Further_planned_actions',
        ]);

        $user_data = User::where('users.username','=', $request->verifyed_by )->get()->toArray();
        $request['verifyed_by']=$user_data[0]['id'];
        $request['date']=date('Y-m-d');//strtotime($request['date']);
      
        $request->state="Pendiente";
        $data= SopLogSheetSupplemental::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('SopLogSheetSupplemental');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SopLogSheetSupplemental  $SopLogSheetSupplemental
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=SopLogSheetSupplemental::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.SopLogSheetSupplemental.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SopLogSheetSupplemental  $SopLogSheetSupplemental
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=SopLogSheetSupplemental::findOrfail($id);    
        return view('modules.SopLogSheetSupplemental.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SopLogSheetSupplemental  $SopLogSheetSupplemental
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         SopLogSheetSupplemental::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SopLogSheetSupplemental  $SopLogSheetSupplemental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'date'=> 'required',
            'verifyed_by' => 'required',
            'decfects_description' => 'required',
            'disposition_of_product' => 'required',
             'restoration_sanitary_condition' => 'required',
             'root_cause' => 'required',
             'Further_planned_actions' => 'required',

        ]);
        SopLogSheetSupplemental::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('SopLogSheetSupplemental.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SopLogSheetSupplemental  $SopLogSheetSupplemental
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       SopLogSheetSupplemental::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SopLogSheetSupplemental  $SopLogSheetSupplemental
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        SopLogSheetSupplemental::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }

}
