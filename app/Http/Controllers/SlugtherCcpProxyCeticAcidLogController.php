<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SlugtherCcpProxyCeticAcidLog;

class SlugtherCcpProxyCeticAcidLogController extends Controller
{
   /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
      /*  if($request->limit){
         $limit=$request->limit;
       }else{
           $limit=5;
       }
       if($request->offset){
         $offset=$request->offset;
       }else{
           $offset=0;
       }*/
      // $data = SlugtherCcpProxyCeticAcidLog::all()->skip($offset)->take($limit);
       $data = SlugtherCcpProxyCeticAcidLog::all();
     /*  $total=count(SlugtherCcpProxyCeticAcidLog::all());
       $cantPages=intdiv($total,$limit);
       $resto=($total%$limit);
       if($resto > 0){
        $cantPages++;
       }*/
       
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.SlugtherCcpProxyCeticAcidLog.index',compact('data','offset','cantPages','total'));
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
            $data = SlugtherCcpProxyCeticAcidLog::where('SlugtherCcpProxyCeticAcidLogs.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }else{
            $data = SlugtherCcpProxyCeticAcidLog::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
      
         
          $total=count(SlugtherCcpProxyCeticAcidLog::all());
         // $cantPages=intdiv($total,$limit);
         // $resto=($total%$limit);
         // $cantItemsDisplayed=count($data)+($limit*($currentPage-1));
         /* if($resto > 0){
           $cantPages++;
          }*/
           if($request->wantsJson()){
              // return response()->json(array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset,'total'=>$total,'cantItemsDisplayed'=>$cantItemsDisplayed,'success'=>true,200));
               return response()->json(array('data'=>array('SlugtherCcpProxyCeticAcidLog'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }else{
              // return view('modules.SlugtherCcpProxyCeticAcidLog.index',compact('data','offset','cantPages','total'));
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
        return view('modules.SlugtherCcpProxyCeticAcidLog.create',compact('libro','categoria'));
        */
        return view('modules.SlugtherCcpProxyCeticAcidLog.create');
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
        $request['monitor_name']=$user_data[0]['id'];

        $data= SlugtherCcpProxyCeticAcidLog::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('SlugtherCcpProxyCeticAcidLog');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SlugtherCcpProxyCeticAcidLog  $SlugtherCcpProxyCeticAcidLog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=SlugtherCcpProxyCeticAcidLog::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.SlugtherCcpProxyCeticAcidLog.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SlugtherCcpProxyCeticAcidLog  $SlugtherCcpProxyCeticAcidLog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=SlugtherCcpProxyCeticAcidLog::findOrfail($id);    
        return view('modules.SlugtherCcpProxyCeticAcidLog.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlugtherCcpProxyCeticAcidLog  $SlugtherCcpProxyCeticAcidLog
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         SlugtherCcpProxyCeticAcidLog::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlugtherCcpProxyCeticAcidLog  $SlugtherCcpProxyCeticAcidLog
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
         SlugtherCcpProxyCeticAcidLog::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('SlugtherCcpProxyCeticAcidLog.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlugtherCcpProxyCeticAcidLog  $SlugtherCcpProxyCeticAcidLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       SlugtherCcpProxyCeticAcidLog::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlugtherCcpProxyCeticAcidLog  $SlugtherCcpProxyCeticAcidLog
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        SlugtherCcpProxyCeticAcidLog::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }

}
