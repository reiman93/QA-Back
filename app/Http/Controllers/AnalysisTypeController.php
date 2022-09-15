<?php

namespace App\Http\Controllers;

use App\Models\Analysis_type;
use Illuminate\Http\Request;

class AnalysisTypeController extends Controller
{
  /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
        $data = Analysis_type::all();
         if($request->wantsJson()){
             return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
         }else{
             return view('modules.area.index',compact('data','offset','cantPages','total'));
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
            $data = Analysis_type::where('analysis_types.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(Analysis_type::where('analysis_types.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
        }else{
            $data = Analysis_type::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(Analysis_type::all());
        }
       
           if($request->wantsJson()){
               return response()->json(array('data'=>array('analysis_type'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.Analysis_type.create',compact('libro','categoria'));
        */
        return view('modules.Analysis_type.create');
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
        $data= Analysis_type::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('Analysis_type');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Analysis_type  $Analysis_type
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=Analysis_type::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Analysis_type  $Analysis_type
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Analysis_type::findOrfail($id);    
        return view('modules.Analysis_type.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Analysis_type  $Analysis_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
         Analysis_type::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('area.index');
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Analysis_type  $Analysis_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       Analysis_type::findOrfail($id)->delete();
       $data = Analysis_type::all()->skip(0)->take(10);
       $total=count(Analysis_type::all());
       return response()->json(array('data'=>$data,'total'=>$total,'success'=>true),200);
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Analysis_type  $Analysis_type
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
       Analysis_type::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}
