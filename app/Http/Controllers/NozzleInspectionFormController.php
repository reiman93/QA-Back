<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NozzleInspectionForm;
use App\Models\User;

class NozzleInspectionFormController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $data = NozzleInspectionForm::all();
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.NozzleInspectionForm.index',compact('data','offset','cantPages','total'));
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
                $data = NozzleInspectionForm::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
               
                $total=count(NozzleInspectionForm::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->toArray());
            
            }else{
                $data = NozzleInspectionForm::with('users')->where('nozzle_inspections.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
                $total=count(NozzleInspectionForm::with('users')->where('nozzle_inspections.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
            }
            
        }else{
            $data = NozzleInspectionForm::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(NozzleInspectionForm::all());
        }
      
           if($request->wantsJson()){
               return response()->json(array('data'=>array('nozzle_inspections'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.NozzleInspectionForm.create',compact('libro','categoria'));
        */


        return view('modules.NozzleInspectionForm.create');
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
        'auditor',
        'date',
        'process',
        'period',
        'time',
        'lactic_mp3',

        'nozzals_working',
        'plugged_nozzles',
        'propper_alications',
        'product_sprend_out',

        'suppervisor_verification',
        ]);

        $request['date']=date('Y-m-d');//strtotime($request['date']);

        $user_data = User::where('users.username','=', $request->auditor)->get()->toArray();
        
      //  var_dump($request->auditor);
      //  die;
        $request['auditor']=$user_data[0]['id'];

   //     $user_data = User::where('users.username','=', $request->suppervisor_verification)->get()->toArray();

     //   $request['suppervisor_verification']=$user_data[0]['id'];

        $data= NozzleInspectionForm::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('NozzleInspectionForm');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NozzleInspectionForm  $NozzleInspectionForm
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=NozzleInspectionForm::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.NozzleInspectionForm.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NozzleInspectionForm  $NozzleInspectionForm
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=NozzleInspectionForm::findOrfail($id);    
        return view('modules.NozzleInspectionForm.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NozzleInspectionForm  $NozzleInspectionForm
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         NozzleInspectionForm::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NozzleInspectionForm  $NozzleInspectionForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'auditor',
            'date',
            'process',
            'period',
            'time',
            'lactic_mp3',
    
            'nozzals_working',
            'plugged_nozzles',
            'propper_alications',
            'product_sprend_out',
    
            'suppervisor_verification',
            ]);
    
            $request['date']=date('Y-m-d');//strtotime($request['date']);
    
            $user_data = User::where('users.username','=', $request->auditor)->get()->toArray();
    
            $request['auditor']=$user_data[0]['id'];
    
    //        $user_data = User::where('users.username','=', $request->suppervisor_verification)->get()->toArray();
    
        //    $request['suppervisor_verification']=$user_data[0]['id'];
             NozzleInspectionForm::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('NozzleInspectionForm.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NozzleInspectionForm  $NozzleInspectionForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       NozzleInspectionForm::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NozzleInspectionForm  $NozzleInspectionForm
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        NozzleInspectionForm::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }}
