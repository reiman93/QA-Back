<?php

namespace App\Http\Controllers;
use App\Models\VisualCheckSpinalCordAndSheath;
use App\Models\User;


use Illuminate\Http\Request;

class VisualCheckSpinalCordAndSheathController extends Controller
{
      /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
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
                $data = VisualCheckSpinalCordAndSheath::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
               
                $total=count(VisualCheckSpinalCordAndSheath::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->toArray());
            
            }else{
                $data = VisualCheckSpinalCordAndSheath::with('users')->where('visual_sheaths.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
                $total=count(VisualCheckSpinalCordAndSheath::with('users')->where('visual_sheaths.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
            }
            
        }else{
            $data = VisualCheckSpinalCordAndSheath::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(VisualCheckSpinalCordAndSheath::all());
        }
      
           if($request->wantsJson()){
               return response()->json(array('data'=>array('visual_spinal_coord'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.VisualCheckSpinalCordAndSheath.create',compact('libro','categoria'));
        */
        return view('modules.VisualCheckSpinalCordAndSheath.create');
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
            'carcase',
            'removed',
            'slaugther_cooler_supy',
            'qa_notified',
            'qa_id'
        ]);
       
        $user_data = User::where('users.username','=', $request->qa_id )->get()->toArray();
        $request['qa_id']=$user_data[0]['id'];
     //   var_dump($request['qa_id']);
     //   die;
        $data= VisualCheckSpinalCordAndSheath::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisualCheckSpinalCordAndSheath  $VisualCheckSpinalCordAndSheath
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=VisualCheckSpinalCordAndSheath::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.VisualCheckSpinalCordAndSheath.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisualCheckSpinalCordAndSheath  $VisualCheckSpinalCordAndSheath
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=VisualCheckSpinalCordAndSheath::findOrfail($id);    
        return view('modules.VisualCheckSpinalCordAndSheath.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisualCheckSpinalCordAndSheath  $VisualCheckSpinalCordAndSheath
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         VisualCheckSpinalCordAndSheath::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisualCheckSpinalCordAndSheath  $VisualCheckSpinalCordAndSheath
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'carcase',
            'removed',
            'slaugther_cooler_supy',
            'qa_notified',
            'qa_id'
        ]);

        $user_data = User::where('users.username','=', $request->qa_id )->get()->toArray();
  
        $qa_not = User::where('users.username','=', $request->qa_notified )->get()->toArray();
        //var_dump($qa_not[0]['id']);
        //die;
      
        $request['qa_notified']=$qa_not[0]['id'];
      //  var_dump($request['qa_notified']);
        //die;
        $request['qa_id']=$user_data[0]['id'];
     //   var_dump($request['qa_id']);
     //   die;
         VisualCheckSpinalCordAndSheath::where('id','=',$id)->update($request->except('_token','_method'));

                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('VisualCheckSpinalCordAndSheath.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisualCheckSpinalCordAndSheath  $VisualCheckSpinalCordAndSheath
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       VisualCheckSpinalCordAndSheath::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisualCheckSpinalCordAndSheath  $VisualCheckSpinalCordAndSheath
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        VisualCheckSpinalCordAndSheath::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}
