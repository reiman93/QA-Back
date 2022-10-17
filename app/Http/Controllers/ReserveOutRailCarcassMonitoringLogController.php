<?php

namespace App\Http\Controllers;
use App\Models\ReserveOutRailCarcassMonitoringLog;
use App\Models\User;


use Illuminate\Http\Request;

class ReserveOutRailCarcassMonitoringLogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
        $data = ReserveOutRailCarcassMonitoringLog::all();
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.ReserveOutRailCarcassMonitoringLog.index',compact('data','offset','cantPages','total'));
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
                $data = ReserveOutRailCarcassMonitoringLog::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
               
                $total=count(ReserveOutRailCarcassMonitoringLog::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->toArray());
            
            }else{
                $data = ReserveOutRailCarcassMonitoringLog::with('users')->where('reserve_out_rail_carcass_monitoring_logs.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
                $total=count(ReserveOutRailCarcassMonitoringLog::with('users')->where('reserve_out_rail_carcass_monitoring_logs.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
            }
            
        }else{
            $data = ReserveOutRailCarcassMonitoringLog::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(ReserveOutRailCarcassMonitoringLog::all());
        }
      
           if($request->wantsJson()){
               return response()->json(array('data'=>array('reserve_out'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.ReserveOutRailCarcassMonitoringLog.create',compact('libro','categoria'));
        */
        return view('modules.ReserveOutRailCarcassMonitoringLog.create');
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
            'shift',
            'carcasse_ID_number',
            'reason',
            'time_out' ,
            'time_checked',
            'dropped_carcass',
            'min_45',
            'may_45',
            'zero_tolerance',
            'auditor_id_user'
        ]);

        $request['date']=date('Y-m-d');//strtotime($request['date']);
        //var_dump($request['shift']);
        //die;
        $user_data = User::where('users.username','=', $request->auditor_id_user )->get()->toArray();
        //var_dump($user_data);
        //die;
        $request['auditor_id_user']=$user_data[0]['id'];

        $data= ReserveOutRailCarcassMonitoringLog::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('ReserveOutRailCarcassMonitoringLog');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReserveOutRailCarcassMonitoringLog  $ReserveOutRailCarcassMonitoringLog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=ReserveOutRailCarcassMonitoringLog::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.ReserveOutRailCarcassMonitoringLog.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReserveOutRailCarcassMonitoringLog  $ReserveOutRailCarcassMonitoringLog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=ReserveOutRailCarcassMonitoringLog::findOrfail($id);    
        return view('modules.ReserveOutRailCarcassMonitoringLog.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReserveOutRailCarcassMonitoringLog  $ReserveOutRailCarcassMonitoringLog
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         ReserveOutRailCarcassMonitoringLog::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReserveOutRailCarcassMonitoringLog  $ReserveOutRailCarcassMonitoringLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'date',
            'shift',
            'carcasse_ID_number',
            'reason',
            'time_out' ,
            'time_checked',
            'dropped_carcass',
            'min_45',
            'may_45',
            'zero_tolerance',
            'auditor_id_user'
        ]);

        $request['date']=date('Y-m-d');//strtotime($request['date']);
        $user_data = User::where('users.username','=', $request->auditor_id_user )->get()->toArray();
        $request['auditor_id_user']=$user_data[0]['id'];
         ReserveOutRailCarcassMonitoringLog::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('ReserveOutRailCarcassMonitoringLog.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReserveOutRailCarcassMonitoringLog  $ReserveOutRailCarcassMonitoringLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       ReserveOutRailCarcassMonitoringLog::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReserveOutRailCarcassMonitoringLog  $ReserveOutRailCarcassMonitoringLog
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        ReserveOutRailCarcassMonitoringLog::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}


