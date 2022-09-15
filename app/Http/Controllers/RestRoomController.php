<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RestRoom;
use App\Models\Relapse_action;
use App\Models\User;


class RestRoomController extends Controller
{
    /**
     * Display a lisRestRoomControllerting of the resource.
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
      // $data = RestRoom::all()->skip($offset)->take($limit);
       $data = RestRoom::all();
     /*  $total=count(RestRoom::all());
       $cantPages=intdiv($total,$limit);
       $resto=($total%$limit);
       if($resto > 0){
        $cantPages++;
       }*/
       
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.RestRoom.index',compact('data','offset','cantPages','total'));
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
            $data = RestRoom::where('RestRooms.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }else{
            $data = RestRoom::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
      
         
          $total=count(RestRoom::all());
         // $cantPages=intdiv($total,$limit);
         // $resto=($total%$limit);
         // $cantItemsDisplayed=count($data)+($limit*($currentPage-1));
         /* if($resto > 0){
           $cantPages++;
          }*/
           if($request->wantsJson()){
              // return response()->json(array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset,'total'=>$total,'cantItemsDisplayed'=>$cantItemsDisplayed,'success'=>true,200));
               return response()->json(array('data'=>array('RestRoom'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }else{
              // return view('modules.RestRoom.index',compact('data','offset','cantPages','total'));
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
        return view('modules.RestRoom.create',compact('libro','categoria'));
        */
        return view('modules.RestRoom.create');
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
        'time'=> 'required',
        'date'=> 'required',
        'shift'=> 'required',
        'state'=> 'required',
        'sex'=> 'required',
        'corrective_action'=> 'required',
        'auditor'=> 'required'
        ]);

        $user_data = User::where('users.username','=', $request->auditor )->get()->toArray();
        $request['auditor']=$user_data[0]['id'];
 
        $data= RestRoom::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RestRoom  $RestRoom
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=RestRoom::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.RestRoom.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RestRoom  $RestRoom
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=RestRoom::findOrfail($id);    
        return view('modules.RestRoom.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RestRoom  $RestRoom
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         RestRoom::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RestRoom  $RestRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
                'time'=> 'required',
                'shift'=> 'required',
                'state'=> 'required',
                'sex'=> 'required',
                'corrective_action'=> 'required',
                'auditor'=> 'required'
        ]);

        $relepse = Relapse_action::where('relapse_actions.name','=', $request->corrective_action)->get()->toArray();

        $request['corrective_action']=$relepse[0]['id'];
         RestRoom::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('RestRoom.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RestRoom  $RestRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       RestRoom::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RestRoom  $RestRoom
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        RestRoom::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}

