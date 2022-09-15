<?php

namespace App\Http\Controllers;
use App\Models\SlugtherCCPS3LacticAcidMonitoringLog;
use App\Models\User;
use App\Models\Relapse_action;
use App\Models\PreventiveAction;





use Illuminate\Http\Request;

class SlugtherCCPS3LacticAcidMonitoringLogController extends Controller
{
   /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
   
       $data = SlugtherCCPS3LacticAcidMonitoringLog::all();

        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.SlugtherCCPS3LacticAcidMonitoringLog.index',compact('data','offset','cantPages','total'));
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
       /* if($request->take){
            $limit=$request->take;
          }

          if($request->skip){
            $offset=$request->skip;
          }else{
              $offset=0;
          }*/
         // $currentPage=intval($request->currentPage);
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
            $data = SlugtherCCPS3LacticAcidMonitoringLog::where('SlugtherCCPS3LacticAcidMonitoringLogs.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }else{
            $data = SlugtherCCPS3LacticAcidMonitoringLog::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
      
         
          $total=count(SlugtherCCPS3LacticAcidMonitoringLog::all());
         // $cantPages=intdiv($total,$limit);
         // $resto=($total%$limit);
         // $cantItemsDisplayed=count($data)+($limit*($currentPage-1));
         /* if($resto > 0){
           $cantPages++;
          }*/
           if($request->wantsJson()){
              // return response()->json(array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset,'total'=>$total,'cantItemsDisplayed'=>$cantItemsDisplayed,'success'=>true,200));
               return response()->json(array('data'=>array('SlugtherCCPS3LacticAcidMonitoringLog'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }else{
              // return view('modules.SlugtherCCPS3LacticAcidMonitoringLog.index',compact('data','offset','cantPages','total'));
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
        return view('modules.SlugtherCCPS3LacticAcidMonitoringLog.create',compact('libro','categoria'));
        */
        return view('modules.SlugtherCCPS3LacticAcidMonitoringLog.create');
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
            'pre_shipment_name',
            'director_general_evaluation',
            'name_director',
            'time_director_aprobation',
        ]);

        $user_data = User::where('users.username','=', $request->monitor_name )->get()->toArray();
        $request['monitor_name']=$user_data[0]['id'];

  //      $user_data = User::where('users.username','=', $request->visualizar_name )->get()->toArray();
  //      $request['visualizar_name']=$user_data[0]['id'];

  //      $user_data = User::where('users.username','=', $request->pre_shipment_name )->get()->toArray();
  //      $request['pre_shipment_name']=$user_data[0]['id'];

        
       /* $user_data = User::where('users.username','=', $request->name_director )->get()->toArray();
        $request['name_director']=$user_data[0]['id'];*/
 

    /*  $relepse = Relapse_action::where('relapse_actions.name','=', $request->correctuve_action_id)->get()->toArray();

      $request['correctuve_action_id']=$relepse[0]['id'];

      $relepse = PreventiveAction::where('preventive_actions.name','=', $request->preventive_action_id)->get()->toArray();

      $request['preventive_action_id']=$relepse[0]['id'];*/

        $data= SlugtherCCPS3LacticAcidMonitoringLog::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('SlugtherCCPS3LacticAcidMonitoringLog');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SlugtherCCPS3LacticAcidMonitoringLog  $SlugtherCCPS3LacticAcidMonitoringLog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=SlugtherCCPS3LacticAcidMonitoringLog::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.SlugtherCCPS3LacticAcidMonitoringLog.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SlugtherCCPS3LacticAcidMonitoringLog  $SlugtherCCPS3LacticAcidMonitoringLog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=SlugtherCCPS3LacticAcidMonitoringLog::findOrfail($id);    
        return view('modules.SlugtherCCPS3LacticAcidMonitoringLog.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlugtherCCPS3LacticAcidMonitoringLog  $SlugtherCCPS3LacticAcidMonitoringLog
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         SlugtherCCPS3LacticAcidMonitoringLog::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlugtherCCPS3LacticAcidMonitoringLog  $SlugtherCCPS3LacticAcidMonitoringLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
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
            'pre_shipment_name',
            'director_general_evaluation',
            'name_director',
            'time_director_aprobation',
        ]);
       // echo("holaaaaaaaaaaaaaaaaaaaa");
       // var_dump($request['first_carcase_id_number']);
       // die;

        $request['date']=date('Y-m-d');//strtotime($request['date']);
        $user_data = User::where('users.username','=', $request->monitor_name )->get()->toArray();
        //var_dump($request['monitor_name']);
       // die;
        $request['monitor_name']=$user_data[0]['id'];

  //      $user_data = User::where('users.username','=', $request->visualizar_name )->get()->toArray();
  //      $request['visualizar_name']=$user_data[0]['id'];

  //      $user_data = User::where('users.username','=', $request->pre_shipment_name )->get()->toArray();
  //      $request['pre_shipment_name']=$user_data[0]['id'];

        
        $user_data = User::where('users.username','=', $request->name_director )->get()->toArray();
        $request['name_director']=$user_data[0]['id'];
 

      $relepse = Relapse_action::where('relapse_actions.name','=', $request->correctuve_action_id)->get()->toArray();

      $request['correctuve_action_id']=$relepse[0]['id'];

      $relepse = PreventiveAction::where('preventive_actions.name','=', $request->preventive_action_id)->get()->toArray();

      $request['preventive_action_id']=$relepse[0]['id'];

         SlugtherCCPS3LacticAcidMonitoringLog::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('SlugtherCCPS3LacticAcidMonitoringLog.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlugtherCCPS3LacticAcidMonitoringLog  $SlugtherCCPS3LacticAcidMonitoringLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       SlugtherCCPS3LacticAcidMonitoringLog::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlugtherCCPS3LacticAcidMonitoringLog  $SlugtherCCPS3LacticAcidMonitoringLog
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        SlugtherCCPS3LacticAcidMonitoringLog::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }

}
