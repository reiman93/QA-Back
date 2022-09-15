<?php

namespace App\Http\Controllers;

use App\Models\Quality_analyst;
use App\Models\Department;
use Illuminate\Http\Request;

class QualityAnalystController extends Controller
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
       $data = Quality_analyst::all()->skip($offset)->take($limit);

       $total=count(Quality_analyst::all());
       $cantPages=intdiv($total,$limit);
       $resto=($total%$limit);
       if($resto > 0){
        $cantPages++;
       }
       
        if($request->wantsJson()){
            return response()->json(array('data'=>array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset),'success'=>true),200);
        }else{
            return view('modules.quality-analyst.index',compact('data','offset','cantPages','total'));
        }
    }

  /**
     * Data with pagin and filters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paginateQualityAnalystFilter(Request $request)
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
          $currentPage=intval($request->currentPage);
          $data = Quality_analyst::all()->skip(intval($offset))->take(intval($limit))->toArray();
          $total=count(Quality_analyst::all());
          $cantPages=intdiv($total,$limit);
          $resto=($total%$limit);
          $cantItemsDisplayed=count($data)+($limit*($currentPage-1));
          if($resto > 0){
           $cantPages++;
          }
           if($request->wantsJson()){
               return response()->json(array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset,'total'=>$total,'cantItemsDisplayed'=>$cantItemsDisplayed,'success'=>true,200));
           }else{
              // return view('modules.QualityAnalyst.index',compact('data','offset','cantPages','total'));
           }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Department::all();
        return view('modules.quality-analyst.create',compact('data'));
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
            'lastname' => 'required',
        ]);
        $data= Quality_analyst::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('qualityAnalyst');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quality_analyst  $Quality_analyst
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Quality_analyst::findOrfail($id);
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
            return view('modules.quality-analyst.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quality_analyst  $QualityAnalyst
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=Quality_analyst::findOrfail($id);
        $department = Department::all();    
        return view('modules.quality-analyst.edit',compact('data','department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quality_analyst  $QualityAnalyst
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
        ]);
        Quality_analyst::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
               return response()->json(null,200);
            }else{
                return redirect()->route('qualityAnalyst.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quality_analyst  $QualityAnalyst
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       Quality_analyst::findOrfail($id)->delete();
       $data = Quality_analyst::all()->skip(0)->take(10);
       $total=count(Quality_analyst::all());
       return response()->json(array('data'=>$data,'total'=>$total,'success'=>true),200);
    }
}
