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

class WpBlog_VueContoller extends Controller
{
    public function __construct(){
		   //$this->middleware('auth');
		   
	}
	
	
	
	/**
     * Show all Blog entries (on Vue framework)
     * uses middleware' => ['sendTokenMy'] in routes/api
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if so far no api_token field in {User table}
        if(auth()->user()->api_token == null){
            return redirect('/getToken')->with('flashMessageFailX', 'Redirected here as no api_token was found. Please generate');
        }
        
        //gets current user Db table field {api_token}
		$myDBToken = auth()->user()->api_token;
    
        return view('wpBlog_Vue.index')->with(compact('myDBToken'));
    }
	
}
