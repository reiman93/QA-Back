<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlugtherFloorVisualCheck;
use App\Models\User;

class SlugtherFloorVisualCheckController extends Controller
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
      // $data = SlugtherFloorVisual::all()->skip($offset)->take($limit);
       $data = SlugtherFloorVisualCheck::all();
     /*  $total=count(SlugtherFloorVisual::all());
       $cantPages=intdiv($total,$limit);
       $resto=($total%$limit);
       if($resto > 0){
        $cantPages++;
       }*/
       
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.SlugtherFloorVisual.index',compact('data','offset','cantPages','total'));
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
       /* if($request->take){
            $limit=$request->take;
          }

          if($request->skip){
            $offset=$request->skip;
          }else{
              $offset=0;
          }*/
         // $currentPage=intval($request->currentPage);
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
            $data = SlugtherFloorVisualCheck::where('SlugtherFloorVisuals.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }else{
            $data = SlugtherFloorVisualCheck::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
      
         
          $total=count(SlugtherFloorVisualCheck::all());
         // $cantPages=intdiv($total,$limit);
         // $resto=($total%$limit);
         // $cantItemsDisplayed=count($data)+($limit*($currentPage-1));
         /* if($resto > 0){
           $cantPages++;
          }*/
           if($request->wantsJson()){
              // return response()->json(array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset,'total'=>$total,'cantItemsDisplayed'=>$cantItemsDisplayed,'success'=>true,200));
               return response()->json(array('data'=>array('SlugtherFloorVisual'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }else{
              // return view('modules.SlugtherFloorVisual.index',compact('data','offset','cantPages','total'));
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
        return view('modules.SlugtherFloorVisual.create',compact('libro','categoria'));
        */
        return view('modules.SlugtherFloorVisual.create');
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
            'period' => 'required',
            'qa_user_id' => 'required',
        ]);

        $user_data = User::where('users.username','=', $request->qa_user_id )->get()->toArray();
        $request['qa_user_id']=$user_data[0]['id'];

        $data= SlugtherFloorVisualCheck::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('SlugtherFloorVisual');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SlugtherFloorVisualCheck  $SlugtherFloorVisual
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=SlugtherFloorVisualCheck::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.SlugtherFloorVisual.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SlugtherFloorVisualCheck  $SlugtherFloorVisual
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=SlugtherFloorVisualCheck::findOrfail($id);    
        return view('modules.SlugtherFloorVisual.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlugtherFloorVisualCheck  $SlugtherFloorVisual
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
        SlugtherFloorVisualCheck::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SlugtherFloorVisual  $SlugtherFloorVisual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            
            'period' => 'required',
            'qa_user_id' => 'required',
            'date' => 'required',
            'qualified_employee' => 'required',
            'specific_job' => 'required',
            'sanitary_conditions' => 'required',
            'pass_or_fails' => 'required',
             'chain_speed'=> 'required', 
             'two_nife'=> 'required',
              'reduction_comments ' => 'required'
        ]);
        SlugtherFloorVisualCheck::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('SlugtherFloorVisual.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlugtherFloorVisualCheck  $SlugtherFloorVisual
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        SlugtherFloorVisualCheck::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SlugtherFloorVisualCheck  $SlugtherFloorVisual
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        SlugtherFloorVisualCheck::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }

}
