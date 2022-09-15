<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlaogtherOperationalSanitationSOPLog;
use App\Models\User;
use App\Models\Relapse_action;
use App\Models\PreventiveAction;
 

class SlaogtherOperationalSanitationSOPLogController extends Controller
{
     /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
        $data = SlaogtherOperationalSanitationSOPLog::all();
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.SlaogtherOperationalSanitationSOPLog.index',compact('data','offset','cantPages','total'));
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
            $data = SlaogtherOperationalSanitationSOPLog::with('users')->where('sop_log.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }else{
            $data = SlaogtherOperationalSanitationSOPLog::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
      
         
          $total=count(SlaogtherOperationalSanitationSOPLog::all());
         // $cantPages=intdiv($total,$limit);
         // $resto=($total%$limit);
         // $cantItemsDisplayed=count($data)+($limit*($currentPage-1));
         /* if($resto > 0){
           $cantPages++;
          }*/
           if($request->wantsJson()){
              // return response()->json(array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset,'total'=>$total,'cantItemsDisplayed'=>$cantItemsDisplayed,'success'=>true,200));
               return response()->json(array('data'=>array('sop_log'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }else{
              // return view('modules.SlaogtherOperationalSanitationSOPLog.index',compact('data','offset','cantPages','total'));
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
        return view('modules.SlaogtherOperationalSanitationSOPLog.create',compact('libro','categoria'));
        */
        return view('modules.SlaogtherOperationalSanitationSOPLog.create');
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //  var_dump( $request['users_id']);
     //  die;
        $request->validate([
            'verifyed_by'=> 'required',
            'date'=> 'required',
            'time'=> 'required',
            'inform_type'=> 'required',
            'periodo'=> 'required',           
            'day_hours'=> 'required',
            'status'=> 'required',
            'corrective_action'=> 'required',
            'preventive_action'=> 'required'
        ]);

        $request['date']=date('Y-m-d');//strtotime($request['date']);

        $user_data = User::where('users.username','=', $request->verifyed_by)->get()->toArray();
       /*var_dump($user_data);
        die;*/
       // $relepse = Relapse_action::where('relapse_actions.name','=', $request->corrective_action)->get()->toArray(); //se envia el id???

      //  $presentive = PreventiveAction::where('preventive_actions.name','=', $request->preventive_action)->get()->toArray();
        $request['verifyed_by']=$user_data[0]['id'];
       // $request['preventive_action']=$presentive[0]['id'];
      //  $request['corrective_action']=$relepse[0]['id']; //???
        $data= SlaogtherOperationalSanitationSOPLog::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('SOPLog');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SlaogtherOperationalSanitationSOPLog  $SlaogtherOperationalSanitationSOPLog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=SlaogtherOperationalSanitationSOPLog::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.SlaogtherOperationalSanitationSOPLog.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SlaogtherOperationalSanitationSOPLog  $SlaogtherOperationalSanitationSOPLog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data=SlaogtherOperationalSanitationSOPLog::findOrfail($id);    
        return view('modules.SlaogtherOperationalSanitationSOPLog.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlaogtherOperationalSanitationSOPLog  $SlaogtherOperationalSanitationSOPLog
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {

         SlaogtherOperationalSanitationSOPLog::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlaogtherOperationalSanitationSOPLog  $SlaogtherOperationalSanitationSOPLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([

            'date'=> 'required',
            'verifyed_by'=> 'required',
            'inform_type'=> 'required',
            'periodo'=> 'required',
             'time'=> 'required',
             'day_hours'=> 'required',
             'status'=> 'required',
             'corrective_action' => 'required',
              'preventive_action' => 'required'
        ]);

        $request['date']=date('Y-m-d');//strtotime($request['date']);

        $user_data = User::where('users.username','=', $request->verifyed_by)->get()->toArray();
        $relepse = Relapse_action::where('relapse_actions.name','=', $request->corrective_action)->get()->toArray();

        $presentive = PreventiveAction::where('preventive_actions.name','=', $request->preventive_action)->get()->toArray();
    
        $request['preventive_action']=$presentive[0]['id'];
        $request['corrective_action']=$relepse[0]['id'];    
        //  var_dump($user_data);
      //  die;
        $request['verifyed_by']=$user_data[0]['id'];
         SlaogtherOperationalSanitationSOPLog::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('SlaogtherOperationalSanitationSOPLog.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlaogtherOperationalSanitationSOPLog  $SlaogtherOperationalSanitationSOPLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       SlaogtherOperationalSanitationSOPLog::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlaogtherOperationalSanitationSOPLog  $SlaogtherOperationalSanitationSOPLog
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        SlaogtherOperationalSanitationSOPLog::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}