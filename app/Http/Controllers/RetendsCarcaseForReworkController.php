<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RetendsCarcaseForReworkController extends Controller
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
      // $data = RetendsCarcaseForReworkController::all()->skip($offset)->take($limit);
       $data = RetendsCarcaseForReworkController::all();
     /*  $total=count(RetendsCarcaseForReworkController::all());
       $cantPages=intdiv($total,$limit);
       $resto=($total%$limit);
       if($resto > 0){
        $cantPages++;
       }*/
       
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.RetendsCarcaseForReworkController.index',compact('data','offset','cantPages','total'));
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
            $data = RetendsCarcaseForReworkController::where('RetendsCarcaseForReworkControllers.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }else{
            $data = RetendsCarcaseForReworkController::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
      
         
          $total=count(RetendsCarcaseForReworkController::all());
         // $cantPages=intdiv($total,$limit);
         // $resto=($total%$limit);
         // $cantItemsDisplayed=count($data)+($limit*($currentPage-1));
         /* if($resto > 0){
           $cantPages++;
          }*/
           if($request->wantsJson()){
              // return response()->json(array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset,'total'=>$total,'cantItemsDisplayed'=>$cantItemsDisplayed,'success'=>true,200));
               return response()->json(array('data'=>array('RetendsCarcaseForReworkController'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }else{
              // return view('modules.RetendsCarcaseForReworkController.index',compact('data','offset','cantPages','total'));
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
        return view('modules.RetendsCarcaseForReworkController.create',compact('libro','categoria'));
        */
        return view('modules.RetendsCarcaseForReworkController.create');
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
            'usda_retaind' => 'required',
            'spinal_cords' => 'required',
            'qa_retained' => 'required',
            'other' => 'required',
            'date' => 'required',
            'total_head_retained'=> 'required',
            'location_inbox'=> 'required',
            'rails' => 'required',
            'approx_time' => 'required',
            'qa_id'=> 'required',
            'usda_inspector' => 'required',
            'area_id' => 'required',
            'tipe_contamination_id' => 'required',
            'source'=> 'required',
            'corrective_action_id'=> 'required',
            'route_cause' => 'required',
            'preventive_action_id' => 'required',
        ]);

        $request->state="Pendiente";
        $data= RetendsCarcaseForReworkController::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('RetendsCarcaseForReworkController');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RetendsCarcaseForReworkController  $RetendsCarcaseForReworkController
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=RetendsCarcaseForReworkController::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.RetendsCarcaseForReworkController.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RetendsCarcaseForReworkController  $RetendsCarcaseForReworkController
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=RetendsCarcaseForReworkController::findOrfail($id);    
        return view('modules.RetendsCarcaseForReworkController.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RetendsCarcaseForReworkController  $RetendsCarcaseForReworkController
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         RetendsCarcaseForReworkController::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RetendsCarcaseForReworkController  $RetendsCarcaseForReworkController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
         RetendsCarcaseForReworkController::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('RetendsCarcaseForReworkController.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RetendsCarcaseForReworkController  $RetendsCarcaseForReworkController
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       RetendsCarcaseForReworkController::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RetendsCarcaseForReworkController  $RetendsCarcaseForReworkController
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        RetendsCarcaseForReworkController::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}

