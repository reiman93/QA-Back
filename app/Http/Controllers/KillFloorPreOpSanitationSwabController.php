<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KillFloorPreOpSanitationSwab;
use App\Models\User;

class KillFloorPreOpSanitationSwabController extends Controller
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
      $data = KillFloorPreOpSanitationSwab::all()->skip($offset)->take($limit);
      $total=count(KillFloorPreOpSanitationSwab::all());
      $cantPages=intdiv($total,$limit);
      $resto=($total%$limit);
      if($resto > 0){
       $cantPages++;
      }
      
       if($request->wantsJson()){
           return response()->json(array('data'=>array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset),'success'=>true),200);
       }else{
           return view('modules.kill-floor-preop-sanitation-swab.index',compact('data','offset','cantPages','total'));
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
            $data = KillFloorPreOpSanitationSwab::where('kill_floor_pre_op_sanitation_swabs.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }else{
            $data = KillFloorPreOpSanitationSwab::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
      
         
          $total=count(KillFloorPreOpSanitationSwab::all());
         // $cantPages=intdiv($total,$limit);
         // $resto=($total%$limit);
         // $cantItemsDisplayed=count($data)+($limit*($currentPage-1));
         /* if($resto > 0){
           $cantPages++;
          }*/
           if($request->wantsJson()){
              // return response()->json(array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset,'total'=>$total,'cantItemsDisplayed'=>$cantItemsDisplayed,'success'=>true,200));
               return response()->json(array('data'=>array('KillFloorPreOpSanitationSwabController'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }else{
              // return view('modules.KillFloorPreOpSanitationSwabController.index',compact('data','offset','cantPages','total'));
           }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        $user=User::all();    
        $Area=Area::all();    

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
               return view('modules.kill-floor-pre-op-sanitation-swab.create',compact('data','department','deficiency','analyst','janitor','relapse','offset','cantPages','total')); 
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
        $request->validate([
            'date',
            'reviewed_by' =>'required',
            'area'=> 'required',
            'aceptable' =>'required',
            'sanitzer_titration' =>'required',
            'sanitzer_typ' =>'required',
            'qa_start_time'=>'required',
             'usda_start_time' =>'required',
             'floor_release_time' =>'required',
             'notes',
             'down_time' =>'required',
        ]);

        $request['date']=date('Y-m-d');//strtotime($request['date']);
    
        $user_data = User::where('users.username','=', $request->reviewed_by)->get()->toArray();

        $request['reviewed_by']=$user_data[0]['id'];


        $data= KillFloorPreOpSanitationSwab::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('KillFloorPreOpSanitationSwab');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KillFloorPreOpSanitationSwab  $KillFloorPreOpSanitationSwabController
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=KillFloorPreOpSanitationSwab::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.KillFloorPreOpSanitationSwab.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KillFloorPreOpSanitationSwab  $KillFloorPreOpSanitationSwabController
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=KillFloorPreOpSanitationSwab::findOrfail($id);    
        return view('modules.KillFloorPreOpSanitationSwab.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KillFloorPreOpSanitationSwab  $KillFloorPreOpSanitationSwabController
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         KillFloorPreOpSanitationSwab::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KillFloorPreOpSanitationSwabController  $KillFloorPreOpSanitationSwabController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'date',
            'reviewed_by',
            'area',
            'aceptable',
            'sanitzer_titration',
            'sanitzer_typ' ,
            'qa_start_time',
             'usda_start_time',
             'floor_release_time',
             'notes',
             'down_time' =>'required',
        ]);

        $request['date']=date('Y-m-d');//strtotime($request['date']);
    


        $user_data = User::where('users.username','=', $request->reviewed_by)->get()->toArray();

        $request['reviewed_by']=$user_data[0]['id'];

        KillFloorPreOpSanitationSwab::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('KillFloorPreOpSanitationSwab.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KillFloorPreOpSanitationSwab  $KillFloorPreOpSanitationSwabController
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        KillFloorPreOpSanitationSwab::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KillFloorPreOpSanitationSwab  $KillFloorPreOpSanitationSwabController
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        KillFloorPreOpSanitationSwab::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }

}