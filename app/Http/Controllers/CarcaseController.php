<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarcaseController extends Controller
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
      // $data = Carcase::all()->skip($offset)->take($limit);
       $data = Carcase::all();
     /*  $total=count(Carcase::all());
       $cantPages=intdiv($total,$limit);
       $resto=($total%$limit);
       if($resto > 0){
        $cantPages++;
       }*/
       
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.Carcase.index',compact('data','offset','cantPages','total'));
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
            $data = Carcase::where('Carcases.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(Carcase::where('Carcases.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
        }else{
            $data = Carcase::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(Carcase::all());
        }
           if($request->wantsJson()){
               return response()->json(array('data'=>array('Carcase'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.Carcase.create',compact('libro','categoria'));
        */
        return view('modules.Carcase.create');
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

        $request->state="Pendiente";
        $data= Carcase::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('Carcase');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carcase  $Carcase
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=Carcase::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.Carcase.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carcase  $Carcase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=Carcase::findOrfail($id);    
        return view('modules.Carcase.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carcase  $Carcase
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         Carcase::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carcase  $Carcase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
         Carcase::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('Carcase.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carcase  $Carcase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       Carcase::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carcase  $Carcase
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        Carcase::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}
