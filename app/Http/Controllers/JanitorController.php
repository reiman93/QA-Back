<?php

namespace App\Http\Controllers;

use App\Models\Janitor;
use Illuminate\Http\Request;

class JanitorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $data = Janitor::all();
         if($request->wantsJson()){
             return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
         }else{
             return view('modules.Janitor.index',compact('data','offset','cantPages','total'));
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
             $data = Janitor::where('janitors.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
             $total=count(Janitor::where('janitors.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
            }else{
             $data = Janitor::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
             $total=count(Janitor::all());
            }
       
            if($request->wantsJson()){
                return response()->json(array('data'=>array('janitor'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
         return view('modules.Janitor.create',compact('libro','categoria'));
         */
         return view('modules.Janitor.create');
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
             'phone'=> 'required',
         ]);
         $data= Janitor::create($request->except('_token'));
         if($request->wantsJson()){
             return response()->json($data,200); 
         }
     }
 
     /**
      * Display the specified resource.
      *
      * @param  \App\Models\Janitor  $Janitor
      * @return \Illuminate\Http\Response
      */
     public function show(Request $request,$id)
     {
         $data=Janitor::findOrfail($id);
         if($request->wantsJson()){
             return response()->json(array('data'=>$data,'success'=>true),200); 
         }else{
             return view('modules.Janitor.show',compact('data'));
         }
     }
 
     /**
      * Show the form for editing the specified resource.
      *
      * @param  \App\Models\Janitor  $Janitor
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
        
         $data=Janitor::findOrfail($id);    
         return view('modules.Janitor.edit',compact('data'));
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \App\Models\Janitor  $Janitor
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request,$id)
     {
         $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'phone'=> 'required',
         ]);
          Janitor::where('id','=',$id)->update($request->except('_token','_method'));
                        
             if($request->wantsJson()){
             return response()->json(null,200);
             }else{
                 return redirect()->route('Janitor.index');
             }   
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Models\Janitor  $Janitor
      * @return \Illuminate\Http\Response
      */
     public function destroy(Request $request,$id)
     {
        Janitor::findOrfail($id)->delete();
        return response()->json(array('success'=>true),200);
     }
     /**
      * Remove the specified resource from storage.
      *
      * @param  \App\Models\Janitor  $Janitor
      * @return \Illuminate\Http\Response
      */
     public function deleteMulty(Request $request)
     {
         Janitor::whereIn('id',$request->ids)->delete();
        return response()->json(array('success'=>true),200);
     }
}
