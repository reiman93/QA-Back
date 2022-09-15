<?php

namespace App\Http\Controllers;
use App\Models\KillFloorSterilizeTempCheck;

use Illuminate\Http\Request;
use App\Models\User;

class KillFloorSterilizeTempCheckController extends Controller
{
     /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       $data = KillFloorSterilizeTempCheck::all();
  
       
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.KillFloorSterilizeTempCheck.index',compact('data','offset','cantPages','total'));
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
            $data = KillFloorSterilizeTempCheck::where('KillFloorSterilizeTempChecks.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }else{
            $data = KillFloorSterilizeTempCheck::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
      
         
          $total=count(KillFloorSterilizeTempCheck::all());
         // $cantPages=intdiv($total,$limit);
         // $resto=($total%$limit);
         // $cantItemsDisplayed=count($data)+($limit*($currentPage-1));
         /* if($resto > 0){
           $cantPages++;
          }*/
           if($request->wantsJson()){
              // return response()->json(array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset,'total'=>$total,'cantItemsDisplayed'=>$cantItemsDisplayed,'success'=>true,200));
               return response()->json(array('data'=>array('KillFloorSterilizeTempCheck'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }else{
              // return view('modules.KillFloorSterilizeTemperatureChecks.index',compact('data','offset','cantPages','total'));
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
        return view('modules.KillFloorSterilizeTemperatureChecks.create',compact('libro','categoria'));
        */
        return view('modules.KillFloorSterilizeTempCheck.create');
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
            'locations',
            'date',
            'auditor_id',
            'priot_tostar_up',
            'temperature',
            'period',
            'relapse_actions_id',
        ]);
        $user_data = User::where('users.username','=', $request->auditor_id )->get()->toArray();
        $request['auditor_id']=$user_data[0]['id'];

        $data= KillFloorSterilizeTempCheck::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('KillFloorSterilizeTempCheck');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KillFloorSterilizeTempCheck  $KillFloorSterilizeTemperatureChecks
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=KillFloorSterilizeTempCheck::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.KillFloorSterilizeTemperatureChecks.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KillFloorSterilizeTemperatureChecks  $KillFloorSterilizeTemperatureChecks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=KillFloorSterilizeTemperatureChecks::findOrfail($id);    
        return view('modules.KillFloorSterilizeTemperatureChecks.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KillFloorSterilizeTemperatureChecks  $KillFloorSterilizeTemperatureChecks
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         KillFloorSterilizeTemperatureChecks::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KillFloorSterilizeTemperatureChecks  $KillFloorSterilizeTemperatureChecks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'locations_id',
            'date',
            'auditor_id',
            'priot_tostar_up',
            'temperature',
            'period1',
            'temperature1',
            'period2',
            'temperature2',
            'period3',
            'temperature3',
            'relapse_actions_id'
        ]);

        $user_data = User::where('users.username','=', $request->auditor_id )->get()->toArray();
        $request['auditor_id']=$user_data[0]['id'];
        $request['date']=date('Y-m-d');//strtotime($request['date']);
         KillFloorSterilizeTempCheck::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('KillFloorSterilizeTempCheck.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KillFloorSterilizeTemperatureChecks  $KillFloorSterilizeTemperatureChecks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       KillFloorSterilizeTempCheck::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KillFloorSterilizeTemppChecks  $KillFloorSterilizeTemperatureChecks
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        KillFloorSterilizeTemppChecks::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}