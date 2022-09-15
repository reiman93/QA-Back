<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;


class UserController extends Controller
{
  
   private $KEY = "gA2W0wXhbSwlaAAF3wtFE/oe5ccrj6i3x8QB+Xe9XFM=";
   private $IV = "df9fa46af13e5921"; 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
      //  $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        //
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
            $data = User::with('rols')->where('users.'.$request->orSearchFields[0]['field'], $operator, $search)->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }else{
            $data = User::with('rols')->get()->skip(intval($request->skip))->take(intval($request->take))->toArray();
        }
          $total=count(User::all());
           if($request->wantsJson()){
               return response()->json(array('data'=>array('user'=>array('count'=>$total,'items'=>$data)),'success'=>true,200));
            }
    }


    public function authenticate(Request $request){ 
      $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);
     
      $data = User::with('rols')->where([
			['users.username','=',$request->username],
            ])->get()->toArray(); 
                                                                    
    /*   $text= openssl_encrypt('admin123','aes-256-cbc',$this->KEY,0,$this->IV);
       $text1=  Crypt::encryptString('admin123');
       echo "decrypted: $text1\n\n";
       var_dump(openssl_decrypt($request->password,'aes-256-cbc',$this->KEY,0,$this->IV));
       $dectext=openssl_decrypt($text,'aes-256-cbc',$this->KEY,0,$this->IV); //substr(hash('sha256', $this->IV), 0, 16)
       echo "decrypted----------: $dectext\n\n";
                                                           
       var_dump(Crypt::decryptString($text1));                                 
       var_dump(Crypt::decryptString($request->password)); die;   */                                
        if($request->wantsJson()){
            if(count($data)>0){
                if (Hash::check($request->password, $data[0]['password'])) {
                    return response()->json(array('token'=>Hash::make($request->username."-".$request->password),'name'=>$data[0]['name'],'foto'=>$data[0]['foto'],'rol'=>$data[0]['rols']['name'],'success'=>true),200);
                }else{
                    return response()->json(array('token'=>'','success'=>false),200);   
                }
            }else{
               return response()->json(array('token'=>'','success'=>false),200);
            }
         } 
     }

     public function getUser(Request $request){ 
        $request->validate([
          'username' => 'required',
      ]);
      
        $data = User::with(['rols','departments'])->where([
              ['users.username','=',$request->username],
              ])->get()->toArray();                                
  
          if($request->wantsJson()){
              if(count($data)>0){
                return response()->json(array('data'=>$data,'success'=>true,'status'=>200));
              }else{
                 return response()->json(array('token'=>'','success'=>false),200);
              }
           } 
       }

     public function updateUser(Request $request){ 
       
        $request->validate([
            'username' => 'required',
        ]);
        $data = User::with('rols')->where([
            ['users.username','=',$request->username],
            ])->get()->toArray(); 

         if($request->password){
            $request['password']= Hash::make($request->password);
         }else{
            $request['password']= $data[0]['password'];
         }  
         if(!$request->rols_id){
            $request['rols_id']= $data[0]['rols_id'];
         }  
        // var_dump($request->password); die;               
         User::where('username','=',$request->username)->update($request->except('_token','_method'));
          
         if($request->wantsJson()){
            return response()->json(null,200);
           } 
       }
     public function registerUser(Request $request){ 
        $request->validate([
            'username' => 'required',
        ]);
       
         if($request->password){
            $request['password']= Hash::make($request->password);
         }               
             
         User::create($request->except('_token','_method'));
          
         if($request->wantsJson()){
            return response()->json(null,200);
           } 
       }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
       /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\V1\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validated();

        $user = Auth::user();

        $post = new User();
        $post->user()->associate($user);
      //  $url_image = $this->upload($request->file('image'));
      //  $post->image = $url_image;
      //  $post->title = $request->input('title');
     //   $post->description = $request->input('description');

        $res = $post->save();

        if ($res) {
            return response()->json(['message' => 'User create succesfully'], 201);
        }
        return response()->json(['message' => 'User to create post'], 500);
    }

    private function upload($image)
    {
        $path_info = pathinfo($image->getClientOriginalName());
        $post_path = 'images/post';

     //   $rename = uniqid() . '.' . $path_info['extension'];
  
        return "$post_path/$rename";
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function deleteMulty(Request $request)
    {
        User::whereIn('id',$request->ids)->delete();
        return response()->json(array('success'=>true),200);
    }
}
