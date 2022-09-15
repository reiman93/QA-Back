<?php

namespace App\Http\Controllers;

use App\Models\Pre_operational_sanitation;
use App\Models\User;
use App\Models\Area;
use App\Models\Department;
use App\Models\Deficiency_type;
use App\Models\Quality_analyst;
use App\Models\Janitor;
use App\Models\Relapse_action;
use Illuminate\Http\Request;

class PreOperationalSanitationController extends Controller
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
       $data = Pre_operational_sanitation::all()->skip($offset)->take($limit);
       $total=count(Pre_operational_sanitation::all());
       $cantPages=intdiv($total,$limit);
       $resto=($total%$limit);
       if($resto > 0){
        $cantPages++;
       }
       
        if($request->wantsJson()){
            return response()->json(array('data'=>array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset),'success'=>true),200);
        }else{
            return view('modules.pre-operational-sanitation.index',compact('data','offset','cantPages','total'));
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
                $data=Pre_operational_sanitation::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            }else{
                $data = Pre_operational_sanitation::with('users')->where($request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            }
        }else{
            $data = Pre_operational_sanitation::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
          $total=count(Pre_operational_sanitation::all());
          
          if($request->wantsJson()){
               return response()->json(array('data'=>array('pre_operational'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $department=Department::all();    
        $deficiency=Deficiency_type::all();    
        $analyst=Quality_analyst::all();    
        $janitor=Janitor::all();    
        $relapse=Relapse_action::all();

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
          $data = Area::all()->skip($offset)->take($limit);
          $total=count(Area::all());
          $cantPages=intdiv($total,$limit);
          $resto=($total%$limit);
          if($resto > 0){
           $cantPages++;
          }
          
           if($request->wantsJson()){
               //return response()->json(array('data'=>array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset),'success'=>true),200);
           }else{
               return view('modules.pre-operational-sanitation.create',compact('data','department','deficiency','analyst','janitor','relapse','offset','cantPages','total')); 
           } 
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    

      //  $request['date']=date('Y-m-d');//strtotime($request['date']);
        $user_data = User::where('users.username','=', $request->users_id)->get()->toArray();
        $request['users_id']=$user_data[0]['id'];

        $data= Pre_operational_sanitation::create($request->except('_token'));
       
        if($request->wantsJson()){
            return response()->json($data,200); 
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pre_operational_sanitation  $Pre_operational_sanitation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Pre_operational_sanitation::findOrfail($id);
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
            return view('modules.pre-operational-sanitation.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pre_operational_sanitation  $Pre_operational_sanitation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $deparment=Department::findOrfail($id);    
        $deficiency=Deficiency_type::findOrfail($id);    
        $analyst=Quality_analyst::findOrfail($id);    
        $janitor=Janitor::findOrfail($id);    
        $relapse=Relapse_action::findOrfail($id);  

        return view('modules.pre-operational-sanitation.edit',compact('deparment','deficiency','analyst','janitor','relapse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pre_operational_sanitation  $Pre_operational_sanitation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $user_data = User::where('users.username','=', $request->users_id)->get()->toArray();
        $request['users_id']=$user_data[0]['id'];

        Pre_operational_sanitation::where('id','=',$id)->update($request->except('_token','_method'));
                       
        if($request->wantsJson()){
         return response()->json(null,200);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pre_operational_sanitation  $Pre_operational_sanitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       Pre_operational_sanitation::findOrfail($id)->delete();
       $data = Pre_operational_sanitation::all()->skip(0)->take(10);
       $total=count(Pre_operational_sanitation::all());
       return response()->json(array('data'=>$data,'total'=>$total,'success'=>true),200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        Pre_operational_sanitation::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}
