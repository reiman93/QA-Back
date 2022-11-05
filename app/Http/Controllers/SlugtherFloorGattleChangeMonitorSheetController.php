<?php

namespace App\Http\Controllers;

use App\Models\SlugtherFloorGattleChangeMonitorSheet;
use App\Models\User;

use Illuminate\Http\Request;

class SlugtherFloorGattleChangeMonitorSheetController extends Controller
{
   /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   

       $data = SlugtherFloorGattleChangeMonitorSheet::all();

       
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.SlugtherFloorGattleChangeMonitorSheet.index',compact('data','offset','cantPages','total'));
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
                $data = SlugtherFloorGattleChangeMonitorSheet::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
               
                $total=count(SlugtherFloorGattleChangeMonitorSheet::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->toArray());
            
            }else{
                $data = SlugtherFloorGattleChangeMonitorSheet::with('users')->where('slugther_floor_gattles.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
                $total=count(SlugtherFloorGattleChangeMonitorSheet::with('users')->where('slugther_floor_gattles.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
            }
            
        }else{
            $data = SlugtherFloorGattleChangeMonitorSheet::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(SlugtherFloorGattleChangeMonitorSheet::all());
        }
      
           if($request->wantsJson()){
               return response()->json(array('data'=>array('slugther_floor_gattle'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.SlugtherFloorGattleChangeMonitorSheet.create',compact('libro','categoria'));
        */
        return view('modules.SlugtherFloorGattleChangeMonitorSheet.create');
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
            'time' => 'required',
            'state' => 'required',
            'carcass_num_age' => 'required',
            'equipment_cleaned_and_sterilized' => 'required',
             'monitored_by' => 'required'
        ]);

        $request['date']=date('Y-m-d');//strtotime($request['date']);
        $user_data = User::where('users.username','=', $request->monitored_by )->get()->toArray();
        $request['monitored_by']=$user_data[0]['id'];

        $request->state="Pendiente";
        $data= SlugtherFloorGattleChangeMonitorSheet::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('SlugtherFloorGattleChangeMonitorSheet');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SlugtherFloorGattleChangeMonitorSheet  $SlugtherFloorGattleChangeMonitorSheet
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=SlugtherFloorGattleChangeMonitorSheet::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.SlugtherFloorGattleChangeMonitorSheet.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SlugtherFloorGattleChangeMonitorSheet  $SlugtherFloorGattleChangeMonitorSheet
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=SlugtherFloorGattleChangeMonitorSheet::findOrfail($id);    
        return view('modules.SlugtherFloorGattleChangeMonitorSheet.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlugtherFloorGattleChangeMonitorSheet  $SlugtherFloorGattleChangeMonitorSheet
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         SlugtherFloorGattleChangeMonitorSheet::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlugtherFloorGattleChangeMonitorSheet  $SlugtherFloorGattleChangeMonitorSheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'date',
            'time' => 'required',
            'state' => 'required',
            'carcass_num_age' => 'required',
            'equipment_cleaned_and_sterilized' => 'required',
             'monitored_by' => 'required'
        ]);
        $request['date']=date('Y-m-d');//strtotime($request['date']);
        $user_data = User::where('users.username','=', $request->monitored_by )->get()->toArray();
        $request['monitored_by']=$user_data[0]['id'];
         SlugtherFloorGattleChangeMonitorSheet::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('SlugtherFloorGattleChangeMonitorSheet.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlugtherFloorGattleChangeMonitorSheet  $SlugtherFloorGattleChangeMonitorSheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       SlugtherFloorGattleChangeMonitorSheet::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlugtherFloorGattleChangeMonitorSheet  $SlugtherFloorGattleChangeMonitorSheet
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        SlugtherFloorGattleChangeMonitorSheet::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }

}
