<?php

namespace App\Http\Controllers;
use App\Models\QualityAssuranceKosherCheckList;
use App\Models\User;

use Illuminate\Http\Request;

class QualityAssuranceKosherCheckListController extends Controller
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
      // $data = QualityAssuranceKosherCheckList::all()->skip($offset)->take($limit);
       $data = QualityAssuranceKosherCheckList::all();
     /*  $total=count(QualityAssuranceKosherCheckList::all());
       $cantPages=intdiv($total,$limit);
       $resto=($total%$limit);
       if($resto > 0){
        $cantPages++;
       }*/
       
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true,'status'=>200));//'cantPages'=>$cantPages,'offset'=>$offset
        }else{
            return view('modules.QualityAssuranceKosherCheckList.index',compact('data','offset','cantPages','total'));
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
            $data = QualityAssuranceKosherCheckList::where('QualityAssuranceKosherCheckLists.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }else{
            $data = QualityAssuranceKosherCheckList::all()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
      
         
          $total=count(QualityAssuranceKosherCheckList::all());
         // $cantPages=intdiv($total,$limit);
         // $resto=($total%$limit);
         // $cantItemsDisplayed=count($data)+($limit*($currentPage-1));
         /* if($resto > 0){
           $cantPages++;
          }*/
           if($request->wantsJson()){
              // return response()->json(array('data'=>$data,'cantPages'=>$cantPages,'offset'=>$offset,'total'=>$total,'cantItemsDisplayed'=>$cantItemsDisplayed,'success'=>true,200));
               return response()->json(array('data'=>array('QualityAssuranceKosherCheckList'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }else{
              // return view('modules.QualityAssuranceKosherCheckList.index',compact('data','offset','cantPages','total'));
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
        return view('modules.QualityAssuranceKosherCheckList.create',compact('libro','categoria'));
        */
        return view('modules.QualityAssuranceKosherCheckList.create');
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

            'date',
       
            'monitor_user_id', 
            
            'comments',
    
            'informrinsed_nife_between_carcase_type',
    
            'human_handing_procedure',
    
            'butt_push_been_backed',
                
            'during_kosher_brisket',
    
            'neck_area_is_bane',
    
            'mark_on_sharks',
                
            'prior_to_any',
            
            'effectivenss_of_cut_kosher',

            'informrinsed_nife_between_carcase_type',

            'cut_has_been_sufficient'
        ]);

        $user_data = User::where('users.username','=', $request->monitor_user_id )->get()->toArray();

        $request['monitor_user_id']=$user_data[0]['id'];

        $data= QualityAssuranceKosherCheckList::create($request->except('_token'));
        if($request->wantsJson()){
            return response()->json($data,200); 
        }else{
           return redirect('QualityAssuranceKosherCheckList');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QualityAssuranceKosherCheckList  $QualityAssuranceKosherCheckList
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data=QualityAssuranceKosherCheckList::findOrfail($id);
        if($request->wantsJson()){
            return response()->json(array('data'=>$data,'success'=>true),200); 
        }else{
            return view('modules.QualityAssuranceKosherCheckList.show',compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QualityAssuranceKosherCheckList  $QualityAssuranceKosherCheckList
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data=QualityAssuranceKosherCheckList::findOrfail($id);    
        return view('modules.QualityAssuranceKosherCheckList.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QualityAssuranceKosherCheckList  $QualityAssuranceKosherCheckList
     * @return \Illuminate\Http\Response
     */
    public function updateState(Request $request,$id)
    {
        $request->validate([
            'state' => 'required',
        ]);
         QualityAssuranceKosherCheckList::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }  
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QualityAssuranceKosherCheckList  $QualityAssuranceKosherCheckList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([

            'date',
       
            'monitor_user_id', 
            
            'Comments',
    
            'informrinsed_nife_between_carcase_type',
    
            'human_handing_procedure',
    
            'butt_push_been_backed',
                
            'during_kosher_brisket',
    
            'neck_area_is_bane',
    
            'mark_on_sharks',
                
            'prior_to_any',
            
            'effectivenss_of_cut_kosher',

            'informrinsed_nife_between_carcase_type',

            'Cut_has_been_sufficient'
        ]);

        
        $request['date']=date('Y-m-d');//strtotime($request['date']);

        $user_data = User::where('users.username','=', $request->monitor_user_id )->get()->toArray();

        $request['monitor_user_id']=$user_data[0]['id'];


         QualityAssuranceKosherCheckList::where('id','=',$id)->update($request->except('_token','_method'));
                       
            if($request->wantsJson()){
            return response()->json(null,200);
            }else{
                return redirect()->route('QualityAssuranceKosherCheckList.index');
            }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QualityAssuranceKosherCheckList  $QualityAssuranceKosherCheckList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
       QualityAssuranceKosherCheckList::findOrfail($id)->delete();
       return response()->json(array('success'=>true),200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QualityAssuranceKosherCheckList  $QualityAssuranceKosherCheckList
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        QualityAssuranceKosherCheckList::whereIn('id',$request->ids)->delete();
       return response()->json(array('success'=>true),200);
    }
}
