<?php

namespace App\Http\Controllers;

use App\Models\Sample_form;
use Illuminate\Http\Request;

class SampleFormController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
        $data = Sample_form::all();
         if($request->wantsJson()){
             return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
         }else{
             return view('modules.Sample_form.index',compact('data','offset','cantPages','total'));
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
            $data = Sample_form::where('sample_forms.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(Sample_form::where('sample_forms.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
        }else{
            $data = Sample_form::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(Sample_form::all());
        }
          
           if($request->wantsJson()){
               return response()->json(array('data'=>array('sample'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.Sample_form.create',compact('libro','categoria'));
        */
        return view('modules.Sample_form.create');
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
            'description' => 'required',
        ]);
        $data= Sample_form::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('Sample_form');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sample_form  $Sample_form
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=Sample_form::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sample_form  $Sample_form
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Sample_form::findOrfail($id);    
        return view('modules.Sample_form.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sample_form  $Sample_form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
         Sample_form::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('Sample_form.index');
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sample_form  $Sample_form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       Sample_form::findOrfail($id)->delete();
       $data = Sample_form::all()->skip(0)->take(10);
       $total=count(Sample_form::all());
       return response()->json(array('data'=>$data,'total'=>$total,'success'=>true),200);
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sample_form  $Sample_form
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
       Sample_form::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}
