<?php

namespace App\Http\Controllers;
use App\Models\DedicatedEquipmentAuditForm;
use App\Models\User;

use Illuminate\Http\Request;

class DedicatedEquipmentAuditFormController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
        if($request->limit){
            $limit=$request->limit;
          }else{
              $limit=5;
          }
          if($request->offset){
            $offset=$request->offset;
          }else{
              $offset=0;
          }
          $data = DedicatedEquipmentAuditForm::all()->skip($offset)->take($limit);
          $total=count(DedicatedEquipmentAuditForm::all());
          $cantPages=intdiv($total,$limit);
          $resto=($total%$limit);
          if($resto > 0){
           $cantPages++;
          }
          
           if($request->wantsJson()){
               return response()->json(array('data'=>array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset),'success'=>true),200);
           }else{
               return view('modules.dedicate-equipment-audit.index',compact('data','offset','cantPages','total'));
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
                $data = DedicatedEquipmentAuditForm::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
               
                $total=count(DedicatedEquipmentAuditForm::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->toArray());
            
            }else{
                $data = DedicatedEquipmentAuditForm::with('users')->where('dedicated_equipments.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
                $total=count(DedicatedEquipmentAuditForm::with('users')->where('dedicated_equipments.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
            }
            
        }else{
            $data = DedicatedEquipmentAuditForm::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(DedicatedEquipmentAuditForm::all());
        }
      
           if($request->wantsJson()){
               return response()->json(array('data'=>array('dedicated_equipment'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.DedicatedEquipmentAuditForm.create',compact('libro','categoria'));
        */
        return view('modules.DedicatedEquipmentAuditForm.create');
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
        'name' => 'required',
        'period' => 'required',
        'hand_drop' => 'required',
        'spinal_cord' => 'required',
        'limit' => 'required',
        'defect_description' => 'required',
        'lot_number' => 'required',
        'corrective_action_id' => 'required',
        'preventive_action_id' => 'required',
        'time' => 'required',
        'date' => 'required',
        'users_id'=> 'required',
        ]);
        $user_data = User::where('users.username','=', $request->users_id)->get()->toArray();
        $request['users_id']=$user_data[0]['id'];
        
        $data= DedicatedEquipmentAuditForm::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('DedicatedEquipmentAuditForm');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DedicatedEquipmentAuditForm  $DedicatedEquipmentAuditForm
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=DedicatedEquipmentAuditForm::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.DedicatedEquipmentAuditForm.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DedicatedEquipmentAuditForm  $DedicatedEquipmentAuditForm
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=DedicatedEquipmentAuditForm::findOrfail($id);    
        return view('modules.DedicatedEquipmentAuditForm.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DedicatedEquipmentAuditForm  $DedicatedEquipmentAuditForm
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         DedicatedEquipmentAuditForm::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DedicatedEquipmentAuditForm  $DedicatedEquipmentAuditForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
         DedicatedEquipmentAuditForm::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('DedicatedEquipmentAuditForm.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DedicatedEquipmentAuditForm  $DedicatedEquipmentAuditForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       DedicatedEquipmentAuditForm::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DedicatedEquipmentAuditForm  $DedicatedEquipmentAuditForm
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        DedicatedEquipmentAuditForm::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}

