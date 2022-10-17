<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AnimalHandingAuditForm;


class AnimalHandingAuditFormController extends Controller
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
       $data = AnimalHandingAuditForm::all()->skip($offset)->take($limit);
       $total=count(AnimalHandingAuditForm::all());
       $cantPages=intdiv($total,$limit);
       $resto=($total%$limit);
       if($resto > 0){
        $cantPages++;
       }
       
        if($request->wantsJson()){
            return response()->json(array('data'=>array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset),'success'=>true),200);
        }else{
            return view('modules.animal-handing-audit-form.index',compact('data','offset','cantPages','total'));
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
                $data = AnimalHandingAuditForm::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
               
                $total=count(AnimalHandingAuditForm::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->toArray());
            
            }else{
                $data = AnimalHandingAuditForm::with('users')->where('animal_handing_audit_forms.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
                $total=count(AnimalHandingAuditForm::with('users')->where('animal_handing_audit_forms.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
            }
            
        }else{
            $data = AnimalHandingAuditForm::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(AnimalHandingAuditForm::all());
        }
      
           if($request->wantsJson()){
               return response()->json(array('data'=>array('animal_handing'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user=User::all();    


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

          
           if($request->wantsJson()){
               return response()->json(array('data'=>array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset),'success'=>true),200);
           }else{
               return view('modules.animal-handing-audit-form.create',compact('data','department','deficiency','analyst','janitor','relapse','offset','cantPages','total')); 
           } 
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { $request->validate([
        'plant_number' => 'required',
        'users_id' => 'required',
        'name'=>'required',
        'shift'=>'required',
        'haad_count' => 'required',
        'state_animal' => 'required',
        'prod_usage' => 'required',
        'in_plant' => 'required',
        'vocalization5' => 'required',
        'vocalization3' => 'required',
        'acts_abuse_observe' => 'required',
        'acces_to_clean_drinking_wather' => 'required',
        'holding_pens_overcrowded' => 'required',
        'kept_les_75' => 'required',
        'name_employed_stunning' => 'required',
        'name_employed_prodding' => 'required',
        'triller_condition' => 'required',
        'tuck_name_number' => 'required',
        'time_arrival' => 'required',
        'time_unloading' => 'required',
        'comments' => 'required',
        'unloading_dock' => 'required',
        'willfull_acts_ofabuse' => 'required',
        'sleep_fals' => 'required',
        'vocalization' => 'required',
        'rotating_knocking_box' => 'required',
    ]);
     
        $user_data = User::where('users.username','=', $request->users_id)->get()->toArray();

        $request['users_id']=$user_data[0]['id'];
   

        $data= AnimalHandingAuditForm::create($request->except('_token'));
      
        if($request->wantsJson()){
            return response()->json($data,200); 
        }
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnimalHandingAuditForm  $AnimalHandingAuditForm
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=AnimalHandingAuditForm::findOrfail($id);
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
            return view('modules.animal-handing-audit-form.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnimalHandingAuditForm  $AnimalHandingAuditForm
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $user=User::findOrfail($id);    
  

        return view('modules.animal-handing-audit-form.edit',compact('deparment','deficiency','analyst','janitor','relapse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnimalHandingAuditForm  $AnimalHandingAuditForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'plant_number' => 'required',
            'users_id' => 'required',
            'name'=>'required',
            'shift'=>'required',
            'haad_count' => 'required',
            'state_animal' => 'required',
            'prod_usage' => 'required',
            'in_plant' => 'required',
            'vocalization5' => 'required',
            'vocalization3' => 'required',
            'acts_abuse_observe' => 'required',
            'acces_to_clean_drinking_wather' => 'required',
            'holding_pens_overcrowded' => 'required',
            'kept_les_75' => 'required',
            'name_employed_stunning' => 'required',
            'name_employed_prodding' => 'required',
            'triller_condition' => 'required',
            'tuck_name_number' => 'required',
            'time_arrival' => 'required',
            'time_unloading' => 'required',
            'comments' => 'required',
            'unloading_dock' => 'required',
            'willfull_acts_ofabuse' => 'required',
            'sleep_fals' => 'required',
            'vocalization' => 'required',
            'rotating_knocking_box' => 'required',
        ]);
         
            $user_data = User::where('users.username','=', $request->users_id)->get()->toArray();
    
            $request['users_id']=$user_data[0]['id'];
       
    
    
         AnimalHandingAuditForm::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('preOperSani.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnimalHandingAuditForm  $AnimalHandingAuditForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       AnimalHandingAuditForm::findOrfail($id)->delete();
       $data = AnimalHandingAuditForm::all()->skip(0)->take(10);
       $total=count(AnimalHandingAuditForm::all());
       return response()->json(array('data'=>$data,'total'=>$total,'success'=>true),200);
    }
}