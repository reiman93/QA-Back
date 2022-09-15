<?php

namespace App\Http\Controllers;

use App\Models\notifications;
use Illuminate\Http\Request;
use DB;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $data = notifications::all();
         if($request->wantsJson()){
             return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
         }else{
             return view('modules.area.index',compact('data','offset','cantPages','total'));
         }
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getActiveNotifications(Request $request)
    {
   
        $data = notifications::where([
/* 			['notifications.recived','=','false'], */
			[ 'notifications.user','=', $request->user]
            ])->get()->toArray();
        $total=count($data);
        if($request->wantsJson()){
            return response()->json(array('data'=>array('total'=>$total,'notifications'=>$data),'success'=>true,'status'=>200));
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
            $data = notifications::where([
                ['notifications.'.$request->orSearchFields[0]['field'], $operator, $search],
                [ 'notifications.user','=', $request->select[0]]
                ]
                )->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }else{
            $data = notifications::where('notifications.user','=', $request->select[0])->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
      
           $total=count(notifications::all());
           if($request->wantsJson()){
               return response()->json(array('data'=>array('notification'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'user' => 'required',
            'name' => 'required',
            'description' => 'required',
            'recived' => 'required',
        ]);
        $request['date']=date('Y-m-d');
        $data= notifications::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,notifications $notifications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function edit(notifications $notifications)
    {
        $request->validate([
            'recived' => 'required',
        ]);
         Area::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('area.index');
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, notifications $notifications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function destroy(notifications $notifications)
    {
        //
    }
       /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request)
    {
       $value['recived']=true;
       if($request->ids=="all"){
         DB::table('notifications')->update($value);
       }else{
        notifications::whereIn('id',$request->ids)->update($value);
       }

       return response()->json(array('success'=>true),200);
    }
       /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
       notifications::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}
