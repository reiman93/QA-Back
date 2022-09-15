<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Pre_operational_sanitation;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $data = Area::all();
       
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
           if($request->orSearchFields[0]['field']=="date"){
                
            $dateSearch=str_split($request->orSearchFields[0]['values'][0],10)[0];
            $data = Area::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            foreach ($data as $key => $value) {
                $prep =  Pre_operational_sanitation::latest()->with('users')->where(
                   [ [ "areas_id","=" ,$value['id'] ],[$request->orSearchFields[0]['field'],"=",$dateSearch] ]
                    )->take(1)->get()->toArray();
                    if($prep){
                $data[$key]['users']=$prep[0]['users'];
                $data[$key]['date']=$prep[0]['date'];
                $data[$key]['notes']=$prep[0]['notes'];
             }else{
                $data[$key]['state']="Waiting for approval";
                $data[$key]['users']=array('foto'=>null,'name'=>'');
                $data[$key]['date']=$dateSearch;
                $data[$key]['notes']="Area non review";
                
             }
                     }
             $total=count(Area::all());       
           }
           else if($request->orSearchFields[0]['field']=="users"){
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
            $data = Area::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
          foreach ($data as $key => $value) {
              $prep =  Pre_operational_sanitation::latest()->with('users')->whereHas('users',function($u){
                $u->where('name',$this->operator,$this->search);
            })->where("areas_id","=" ,$value['id'])->take(1)->get()->toArray();
           if($prep){
              $data[$key]['users']=$prep[0]['users'];
              $data[$key]['date']=$prep[0]['date'];
              $data[$key]['notes']=$prep[0]['notes'];
           }else{
              $data[$key]['state']="Waiting for approval";
              $data[$key]['users']=array('foto'=>null,'name'=>'');
              $data[$key]['date']=date('Y-m-d');  
              $data[$key]['notes']="Area non review";
           }
                   }
                   $total=count(Area::all());   
         }
         else if($request->orSearchFields[0]['field']=="notes"){
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

            $data = Area::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
          foreach ($data as $key => $value) {
              $prep =  Pre_operational_sanitation::latest()->with('users')->where([ [ "areas_id","=" ,$value['id'] ],[$request->orSearchFields[0]['field'],$operator,$search] ])->take(1)->get()->toArray();
           if($prep){
              $data[$key]['users']=$prep[0]['users'];
              $data[$key]['date']=$prep[0]['date'];
              $data[$key]['notes']=$prep[0]['notes'];
           }else{
              $data[$key]['state']="Waiting for approval";
              $data[$key]['users']=array('foto'=>null,'name'=>'');
              $data[$key]['date']=date('Y-m-d');  
              $data[$key]['notes']="Area non review";
           }
                   }
                   $total=count(Area::all());   
         }
         else{
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
            
            $data = Area::where($request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray(); 
            foreach ($data as $key => $value) {
                $prep =  Pre_operational_sanitation::latest()->with('users')->where("areas_id","=" ,$value['id']
                    )->take(1)->get()->toArray();
             if($prep){
                $data[$key]['users']=$prep[0]['users'];
                $data[$key]['date']=$prep[0]['date'];
                $data[$key]['notes']=$prep[0]['notes'];
             }else{
                $data[$key]['state']="Waiting for approval";
                $data[$key]['users']=array('foto'=>null,'name'=>'');
                $data[$key]['date']=date('Y-m-d');
                $data[$key]['notes']="Area non review";
             }
          }
          $total=count(Area::where($request->orSearchFields[0]['field'], $operator, $search)->get()->toArray());
        }
        }else{
            $data = Area::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
            foreach ($data as $key => $value) {
                $prep =  Pre_operational_sanitation::latest()->with('users')->where(
                   [ [ "areas_id","=" ,$value['id'] ],[ "date","=" ,date('Y-m-d')] ]
                    )->take(1)->get()->toArray();
             if($prep){
                $data[$key]['users']=$prep[0]['users'];
                $data[$key]['date']=$prep[0]['date'];
                $data[$key]['notes']=$prep[0]['notes'];
             }else{
                $data[$key]['state']="Waiting for approval";
                $data[$key]['users']=array('foto'=>null,'name'=>'');
                $data[$key]['date']=date('Y-m-d');
                $data[$key]['notes']="Area non review";
             }
          }
          $total=count(Area::all());
        }
      
           if($request->wantsJson()){
               return response()->json(array('data'=>array('area'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
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
        return view('modules.area.create',compact('libro','categoria'));
        */
        return view('modules.area.create');
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

        $request['state']="Waiting for approval";
        $data= Area::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('area');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=Area::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.area.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=Area::findOrfail($id);    
        return view('modules.area.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request)
    {
        $request->validate([
            'state' => 'required',
        ]);
         Area::where('id','=',$request->id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
         Area::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('area.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       Area::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        Area::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}
