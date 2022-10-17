<?php

namespace App\Http\Controllers;
use App\Models\RandomAuditSampleTime;

use Illuminate\Http\Request;

class RandomAuditSampleTimeController extends Controller
{
     /**
     * Display a listing of the resource.
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
      // $data = RandomAuditSampleTime::all()->skip($offset)->take($limit);
       $data = RandomAuditSampleTime::all();
     /*  $total=count(RandomAuditSampleTime::all());
       $cantPages=intdiv($total,$limit);
       $resto=($total%$limit);
       if($resto > 0){
        $cantPages++;
       }*/
       
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.RandomAuditSampleTime.index',compact('data','offset','cantPages','total'));
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
                $data = RestRoom::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
               
                $total=count(RestRoom::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->toArray());
            
            }else{
                $data = RestRoom::with('users')->where('rest_rooms.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
                $total=count(RestRoom::with('users')->where('rest_rooms.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
            }
            
        }else{
            $data = RestRoom::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(RestRoom::all());
        }
      
           if($request->wantsJson()){
               return response()->json(array('data'=>array('rest_room'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.RandomAuditSampleTime.create',compact('libro','categoria'));
        */
        return view('modules.RandomAuditSampleTime.create');
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
            'verification_type',
            'random_time',
            'random_num',
            'random_code',
        ]);

        $data= RandomAuditSampleTime::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('RandomAuditSampleTime');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RandomAuditSampleTime  $RandomAuditSampleTime
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=RandomAuditSampleTime::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.RandomAuditSampleTime.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RandomAuditSampleTime  $RandomAuditSampleTime
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=RandomAuditSampleTime::findOrfail($id);    
        return view('modules.RandomAuditSampleTime.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RandomAuditSampleTime  $RandomAuditSampleTime
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         RandomAuditSampleTime::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RandomAuditSampleTime  $RandomAuditSampleTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'date',
            'verification_type',
            'random_time',
            'random_num',
            'randomcode',
        ]);
         RandomAuditSampleTime::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('RandomAuditSampleTime.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RandomAuditSampleTime  $RandomAuditSampleTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       RandomAuditSampleTime::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RandomAuditSampleTime  $RandomAuditSampleTime
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        RandomAuditSampleTime::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}
