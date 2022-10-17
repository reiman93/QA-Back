<?php

namespace App\Http\Controllers;
use App\Models\SpinalCordAudit;
use App\Models\User;

use Illuminate\Http\Request;

class SpinalCordAuditController extends Controller
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
                $data = SpinalCordAudit::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
               
                $total=count(SpinalCordAudit::with('users')->whereHas('users',function($u){
                    $u->where('name',$this->operator,$this->search);
                })->get()->toArray());
            
            }else{
                $data = SpinalCordAudit::with('users')->where('spinal_cord_audits.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
                $total=count(SpinalCordAudit::with('users')->where('spinal_cord_audits.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
            }
            
        }else{
            $data = SpinalCordAudit::with('users')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            $total=count(SpinalCordAudit::all());
        }
      
           if($request->wantsJson()){
               return response()->json(array('data'=>array('spinal_cord'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.SpinalCordAudit.create',compact('libro','categoria'));
        */
        return view('modules.SpinalCordAudit.create');
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
            'users_id', 
            'date',
            'period',
            'aceptavol_value',
            'unaceptavol_value',
            'comments',
            'inked_missplits',      
        ]);


        $user_data = User::where('users.username','=', $request->users_id )->get()->toArray();
        $request['users_id']=$user_data[0]['id'];
        
        $data= SpinalCordAudit::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('SpinalCordAudit');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpinalCordAudit  $SpinalCordAudit
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=SpinalCordAudit::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.SpinalCordAudit.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpinalCordAudit  $SpinalCordAudit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=SpinalCordAudit::findOrfail($id);    
        return view('modules.SpinalCordAudit.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpinalCordAudit  $SpinalCordAudit
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         SpinalCordAudit::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpinalCordAudit  $SpinalCordAudit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([

            'users_id' => 'required',
            'period' => 'required',
            'aceptavol_value' => 'required',
            'unaceptavol_value' => 'required',
            'comments' => 'required',
            'inked_missplits' => 'required', 
            
        ]);

        $user_data = User::where('users.username','=', $request->users_id )->get()->toArray();
        $request['users_id']=$user_data[0]['id'];
         SpinalCordAudit::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('SpinalCordAudit.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpinalCordAudit  $SpinalCordAudit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       SpinalCordAudit::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpinalCordAudit  $SpinalCordAudit
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        SpinalCordAudit::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }

}
