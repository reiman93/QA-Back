<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\SlugtherCcps1haccpLog;

use Illuminate\Http\Request;

class SlugtherCcps1haccpLogController extends Controller
{
   /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $data = SlugtherCcps1haccpLog::all();
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.SlugtherCcps11haccpLog.index',compact('data','offset','cantPages','total'));
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
                $data = SlugtherCcps1haccpLog::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
               
                $total=count(SlugtherCcps1haccpLog::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->toArray());
            
            }else{
                $data = SlugtherCcps1haccpLog::with('users')->where('slugther_ccps1.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
                $total=count(SlugtherCcps1haccpLog::with('users')->where('slugther_ccps1.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
            }
            
        }else{
            $data = SlugtherCcps1haccpLog::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(SlugtherCcps1haccpLog::all());
        }
      
           if($request->wantsJson()){
               return response()->json(array('data'=>array('slugther_ccps1'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.SlugtherCcps11haccpLog.create',compact('libro','categoria'));
        */
        return view('modules.SlugtherCcps11haccpLog.create');
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
            'first_carcase_id_number',
            'date',
            'shift',
            'limit',
            'defect_description',
            'carcase_id',
            'correctuve_action_id',
            'preventive_action_id',
            'initial_time',
            'records_review_found_aceptabol',
            'pre_shipment_review',
            
            'monitor_name',
            'visualizar_name',
            'director_general_evaluation',
            'name_director',
            'time_director_aprobation'
        ]);

        $user_data = User::where('users.username','=', $request->monitor_name )->get()->toArray();
        $request['users_id']=$user_data[0]['id'];

        $data= SlugtherCcps1haccpLog::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('SlugtherCcps1haccpLog');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SlugtherCcps11haccpLog  $SlugtherCcps11haccpLog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=SlugtherCcps1haccpLog::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.SlugtherCcps1haccpLog.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SlugtherCcps1haccpLog  $SlugtherCcps11haccpLog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=SlugtherCcps1haccpLog::findOrfail($id);    
        return view('modules.SlugtherCcps11haccpLog.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlugtherCcps1haccpLog  $SlugtherCcps11haccpLog
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         SlugtherCcps11haccpLog::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlugtherCcps11haccpLog  $SlugtherCcps11haccpLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'first_carcase_id_number' => 'required',
            'shift'=> 'required',
            'limit'=> 'required',
            'defect_description' => 'required',
            'carcase_id' => 'required',
            'correctuve_action_id' => 'required',
            'preventive_action_id' => 'required',
            'initial_time'=> 'required',
            'records_review_found_aceptabol' => 'required',
            'pre_shipment_review' => 'required',
            
            'monitor_name'=> 'required',
            'visualizar_name' => 'required',
            'director_general_evaluation'=> 'required',
            'name_director'=> 'required',
            'time_director_aprobation' => 'required',
        ]);
         SlugtherCcps1haccpLog::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('SlugtherCcps11haccpLog.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlugtherCcps11haccpLog  $SlugtherCcps11haccpLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        
        SlugtherCcps1haccpLog::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlugtherCcps1haccpLog  $SlugtherCcps1haccpLog
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        SlugtherCcps1haccpLog::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }

}
