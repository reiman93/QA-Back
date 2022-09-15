<?php
namespace App\Http\Controllers;

use App\Models\State_analisys;
use Illuminate\Http\Request;

class StateAnalisysController extends Controller
{
       /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
        $data = State_analisys::all();
         if($request->wantsJson()){
             return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
         }else{
             return view('modules.State_analisys.index',compact('data','offset','cantPages','total'));
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
            $data = State_analisys::where('state_analisys.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(State_analisys::where('state_analisys.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
        }else{
            $data = State_analisys::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(State_analisys::all());
        }
         
           if($request->wantsJson()){
               return response()->json(array('data'=>array('analysis_state'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.State_analisys.create',compact('libro','categoria'));
        */
        return view('modules.State_analisys.create');
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

        $data= State_analisys::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('State_analisys');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State_analisys  $State_analisys
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=State_analisys::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State_analisys  $State_analisys
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=State_analisys::findOrfail($id);    
        return view('modules.State_analisys.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State_analisys  $State_analisys
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
         State_analisys::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('State_analisys.index');
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State_analisys  $State_analisys
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       State_analisys::findOrfail($id)->delete();
       $data = State_analisys::all()->skip(0)->take(10);
       $total=count(State_analisys::all());
       return response()->json(array('data'=>$data,'total'=>$total,'success'=>true),200);
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State_analisys  $State_analisys
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
       State_analisys::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}

