<?php

namespace App\Http\Controllers;

use App\Models\Sample_request_forms;
use App\Models\User;
use App\Models\Area;
use App\Models\laboratory;
use App\Models\Analysis_type;
use App\Models\Relapse_action;
use App\Models\Sample_form;
use App\Models\Satate_Analisys;

use Illuminate\Http\Request;

class SampleRequestFormsController extends Controller
{
     /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
        $data = Sample_request_forms::all();
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.area.index',compact('data','offset','cantPages','total'));
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
                $data = Sample_request_forms::with(['state_analisys','users'])->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
               
                $total=count(Sample_request_forms::with(['state_analisys','users'])->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->toArray());
            
            }else if($request->orSearchFields[0]['field']=="state_analisys"){
                    $data = Sample_request_forms::with(['state_analisys','users'])->whereHas('state_analisys',function($u){
                        $u->where('name',$this->operator,$this->search);
                    })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
                    $total=count(Sample_request_forms::with(['state_analisys','users'])->whereHas('state_analisys',function($u){
                        $u->where('name',$this->operator,$this->search);
                    })->get()->toArray());
            }
            else{
                $data = Sample_request_forms::with(['state_analisys','users'])->where('sample_request_forms.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
                $total=count(Sample_request_forms::with(['state_analisys','users'])->where('sample_request_forms.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
            }
        }else{
            $data = Sample_request_forms::with(['state_analisys','users'])->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(Sample_request_forms::all());
        }
        
           if($request->wantsJson()){
               return response()->json(array('data'=>array('sample_request_forms'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $analyst=Quality_analyst::all(); 
        $analisys_state=Satate_Analisys::all();
        $analisys_type=Analysis_type::all();
        $area=Area::all();
        $sample_form=Sample_form::all();    
        $laboratory=Laboratory::all();    
           

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
               return view('modules.pre-operational-sanitation.create',compact('data','Sample_request_forms','deficiency','analyst','janitor','relapse','offset','cantPages','total')); 
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
     
       $user_data = User::where('users.username','=', $request->user_id)->get()->toArray();
       // $request['date']=date('Y-m-d');//strtotime($request['date']);
       $request['users_id']=$user_data[0]['id'];

        $data= Sample_request_forms::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('preOperSani');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sample_request_forms  $Sample_request_forms
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Sample_request_forms::findOrfail($id);
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
            return view('modules.pre-operational-sanitation.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sample_request_forms  $Sample_request_forms
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       


        $analyst=Quality_analyst::findOrfail(); 
        $analisys_state=Satate_Analisys::findOrfail();
        $analisys_type=Analysis_type::findOrfail();
        $area=Area::findOrfail();
        $sample_form=Sample_form::findOrfail();    
        $laboratory=Laboratory::findOrfail();    

        return view('modules.Sample_request_formsn.edit',compact('deparment','deficiency','analyst','janitor','relapse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sample_request_forms  $Sample_request_forms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
        ]);

        $user_data = User::where('users.username','=', $request->users_id)->get()->toArray();
        $request['users_id']=$user_data[0]['id'];

        Sample_request_forms::where('id','=',$id)->update($request->except('_token','_method'));
                       
        if($request->wantsJson()){
        return response()->json(null,200);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sample_request_forms  $Sample_request_forms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       Sample_request_forms::findOrfail($id)->delete();
       $data = Sample_request_forms::all()->skip(0)->take(10);
       $total=count(Sample_request_forms::all());
       return response()->json(array('data'=>$data,'total'=>$total,'success'=>true),200);
    }

    
      /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sample_request_forms  $sample
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        Sample_request_forms::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}
