<?php
//https://medium.com/js-dojo/build-a-simple-blog-with-multiple-image-upload-using-laravel-vue-5517de920796

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use Storage;
use Illuminate\Support\Facades\DB;
use App\models\wpBlogImages\Wpress_images_Posts; //model for all posts
use App\models\wpBlogImages\Wpress_images_Category; //model for all Wpress_images_Category
use App\User; 

class WpBlog_Rest_API_Contoller extends Controller
{
    public function __construct(){
		//$this->middleware('auth');
        //dd(auth()->user()->id);
                
	}
	
	
	
	/**
     * REST API endpoint to /GET all posts
     *
     * @return json
     */
	public function getAllPosts(Request $request) //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all
    {   
        //dd(\Auth::user()->id); //works
        
        
        //VERSION_1 when u pass token in ajax URL as ?token=XXXX (in Vuex store /store/index.js)
        /*if($_GET['token'] == ''){ 
            return response()->json(['error' => true, 'data' =>  ' Token is missing' ]);
        }
        
        if (!User::where('api_token', $_GET['token'])->exists()){
            return response()->json(['error' => true, 'data' =>  ' Token is not valid' ]);
        } */           
        
        
        
        
        //VERSION_2(MAIN) when u pass Bearer token in Headers via (either in ajax or php middleware/AccsessToken Middleware)(in final version pass it in ajax in /store/index.js)
        //When use in /routes/api Route::group(['middleware' => ['auth:api'] + middleware/MyForceJsonResponse below checking won't work(except for positive one) as it is done automatically
        //When use in /routes/api Route::group(['middleware' => ['api'] below checking will work (will be no automatical check)
        //gets the Bearer token
        
        /*
        $token = ($request->bearerToken() != null) ? $request->bearerToken() : "no tokennnn";//works
        //dd($token);
        
        
        if($token == ''){
            return response()->json(['error' => true, 'data' =>  'Bearer Token is  missing' ]);
        }
        
        
        
        //verify if Bearer token is correct. Works
        if(!Auth::guard('api')->check()){
            return response()->json(['error' => true, 'data' => 'Bearer ' .$token . ' is  wrong' ]);
        } 
        
       
        
        if(Auth::guard('api')->check()){
            //dd($token . " is  correct");
            return response()->json(['error' => true, 'data' => 'Bearer ' . $token . ' is  correct' ]);
        } else {
            return response()->json(['error' => true, 'data' => 'Bearer ' . $token . ' is  wrong' ]);
            //dd($token . " is  wrong"); //works only if 'auth:api' middleware is off
        }
        */
        
        
        //var_dump(getallheaders());
        //dd($_GET);
        /*
        if(!isset($_GET['api_token'])){
            return response()->json(['error' => true, 'data' =>'Where is the token? ' ]);
        }
        
        $one = User::where('api_token', '=', $_GET['api_token'])->first();
        if(!$one){
            return response()->json(['error' => true, 'data' =>"Token is not correct"] );
        } else {
             return response()->json(['error' => true, 'data' =>"Token is Good" ]);
        }
        */
        
        $posts = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->orderBy('wpBlog_created_at', 'desc')->get(); //->with('getImages', 'authorName', 'categoryNames') => hasMany/belongTo Eager Loading
        return response()->json(['error' => false, 'data' => $posts]);
    }
	
	
	
	
	 /**
     * REST API to /POST (create) a new blog. NOT IMPLEMENTED. REWRITE WITHOUT TRANSACTION
     * @param Request $request
     * @return json
     */
	public function createPost(Request $request)
    {
		/*
		header('Access-Control-Allow-Origin:  *');
        header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
	    */
       
        
		return response()->json("Too Good, but process back-end validation : " . $request->title .  " / " .  $request->body);
		//dd($request->all());
		
		/*
        DB::transaction(function () use ($request) {
            $user = Auth::user();
            $title = $request->title;
            $body = $request->body;
            $images = $request->images;

            $post = Wpress_images_Posts::create([
                'title' => $title,
                'body' => $body,
                'user_id' => $user->id,
            ]);
            // store each image
            foreach($images as $image) {
                $imagePath = Storage::disk('uploads')->put($user->email . '/posts/' . $post->id, $image);
                PostImage::create([
                    'post_image_caption' => $title,
                    'post_image_path' => '/uploads/' . $imagePath,
                    'post_id' => $post->id
                ]);
            }
        });
        return response()->json(200);
		*/
    }
	
	
	
	
	
	
	
}
