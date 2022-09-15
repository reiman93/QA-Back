<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
     /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
        $data = Laboratory::all();
         if($request->wantsJson()){
             return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
         }else{
             return view('modules.laboratory.index',compact('data','offset','cantPages','total'));
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
            $data = Laboratory::where('laboratories.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(Laboratory::where('laboratories.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
        }else{
            $data = Laboratory::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(Laboratory::all());
        }
        
           if($request->wantsJson()){
               return response()->json(array('data'=>array('laboratory'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.Laboratory.create',compact('libro','categoria'));
        */
        return view('modules.Laboratory.create');
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
            'address' => 'required',
            'phone' => 'required',
            'gmail' => 'required',
        ]);
        $data= Laboratory::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('Laboratory');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laboratory  $Laboratory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=Laboratory::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laboratory  $Laboratory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Laboratory::findOrfail($id);    
        return view('modules.Laboratory.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laboratory  $Laboratory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'gmail' => 'required',
        ]);
         Laboratory::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('laboratory.index');
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laboratory  $Laboratory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       Laboratory::findOrfail($id)->delete();
       $data = Laboratory::all()->skip(0)->take(10);
       $total=count(Laboratory::all());
       return response()->json(array('data'=>$data,'total'=>$total,'success'=>true),200);
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laboratory  $Laboratory
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
       Laboratory::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}
