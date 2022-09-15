<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class KillFloorSterilizeTemperatureChecksController extends Controller
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
      // $data = KillFloorSterilizeTemperatureChecks::all()->skip($offset)->take($limit);
       $data = KillFloorSterilizeTemperatureChecks::all();
     /*  $total=count(KillFloorSterilizeTemperatureChecks::all());
       $cantPages=intdiv($total,$limit);
       $resto=($total%$limit);
       if($resto > 0){
        $cantPages++;
       }*/
       
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.KillFloorSterilizeTemperatureChecks.index',compact('data','offset','cantPages','total'));
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
            $data = KillFloorSterilizeTemperatureChecks::where('KillFloorSterilizeTemperatureChecks.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }else{
            $data = KillFloorSterilizeTemperatureChecks::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
      
         
          $total=count(KillFloorSterilizeTemperatureChecks::all());
         // $cantPages=intdiv($total,$limit);
         // $resto=($total%$limit);
         // $cantItemsDisplayed=count($data)+($limit*($currentPage-1));
         /* if($resto > 0){
           $cantPages++;
          }*/
           if($request->wantsJson()){
              // return response()->json(array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset,'total'=>$total,'cantItemsDisplayed'=>$cantItemsDisplayed,'success'=>true,200));
               return response()->json(array('data'=>array('KillFloorSterilizeTemperatureChecks'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.KillFloorSterilizeTemperatureChecks.create');
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
        'locations' => 'required',
        'date' => 'required',
        'auditor_id' => 'required',
        'priot_tostar_up' => 'required',
        'relapse_actions_id'=> 'required', 
        'notes'=> 'required' 
        ]);

        $user_data = User::where('users.username','=', $request->auditor_id)->get()->toArray();
        $request['auditor_id']=$user_data[0]['id'];
        
        $data= KillFloorSterilizeTemperatureChecks::create($request->except('_token'));
    
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('KillFloorSterilizeTemperatureChecks');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KillFloorSterilizeTemperatureChecks  $KillFloorSterilizeTemperatureChecks
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=KillFloorSterilizeTemperatureChecks::findOrfail($id);
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
            'name' => 'required',
            'description' => 'required',
        ]);
         KillFloorSterilizeTemperatureChecks::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('KillFloorSterilizeTemperatureChecks.index');
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
       KillFloorSterilizeTemperatureChecks::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KillFloorSterilizeTemperatureChecks  $KillFloorSterilizeTemperatureChecks
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        KillFloorSterilizeTemperatureChecks::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}