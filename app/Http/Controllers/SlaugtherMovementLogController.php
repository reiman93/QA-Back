<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlaugtherMovementLog;
use App\Models\User;

class SlaugtherMovementLogController extends Controller
{
       /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
        $data = SlaugtherMovementLog::all();
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.SlaugtherMovementLog.index',compact('data','offset','cantPages','total'));
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
            $data = SlaugtherMovementLog::with('users')->where('slaugther_movement_logs.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }else{
            $data = SlaugtherMovementLog::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
      
         
          $total=count(SlaugtherMovementLog::all());
         // $cantPages=intdiv($total,$limit);
         // $resto=($total%$limit);
         // $cantItemsDisplayed=count($data)+($limit*($currentPage-1));
         /* if($resto > 0){
           $cantPages++;
          }*/
           if($request->wantsJson()){
              // return response()->json(array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset,'total'=>$total,'cantItemsDisplayed'=>$cantItemsDisplayed,'success'=>true,200));
               return response()->json(array('data'=>array('sop_log'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }else{
              // return view('modules.SlaugtherMovementLog.index',compact('data','offset','cantPages','total'));
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
        return view('modules.SlaugtherMovementLog.create',compact('libro','categoria'));
        */
        return view('modules.SlaugtherMovementLog.create');
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //  var_dump( $request['users_id']);
     //  die;
        $request->validate([
            'date'=> 'required',
            'monitored_by'=> 'required',
            'beginig_carcase_tag'=> 'required',
            'ending_carcase_tag'=> 'required',
            'no30'=> 'required',           
            'definition'=> 'required',
            'supplier_name'=> 'required',
            'lot_num'=> 'required',
            'carcases_grag_tag_num'=> 'required'
        ]);
        $user_data = User::where('users.username','=', $request->monitored_by )->get()->toArray();
        $request['monitored_by']=$user_data[0]['id'];

        $data= SlaugtherMovementLog::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('SOPLog');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SlaugtherMovementLog  $SlaugtherMovementLog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=SlaugtherMovementLog::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.SlaugtherMovementLog.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SlaugtherMovementLog  $SlaugtherMovementLog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data=SlaugtherMovementLog::findOrfail($id);    
        return view('modules.SlaugtherMovementLog.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlaugtherMovementLog  $SlaugtherMovementLog
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {

         SlaugtherMovementLog::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlaugtherMovementLog  $SlaugtherMovementLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([

            'date'=> 'required',
            'monitored_by'=> 'required',
            'beginig_carcase_tag'=> 'required',
            'ending_carcase_tag'=> 'required',
            'no30'=> 'required',           
            'denfinition'=> 'required',
            'supplier_name'=> 'required',
            'lot_num'=> 'required',
            'carcases_grag_tag_num'=> 'required'
        ]);

        $request['date']=date('Y-m-d');//strtotime($request['date']);

        $user_data = User::where('users.username','=', $request->monitored_by)->get()->toArray();

        $request['monitored_by']=$user_data[0]['id'];
         SlaugtherMovementLog::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('SlaugtherMovementLog.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlaugtherMovementLog  $SlaugtherMovementLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       SlaugtherMovementLog::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlaugtherMovementLog  $SlaugtherMovementLog
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        SlaugtherMovementLog::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}
