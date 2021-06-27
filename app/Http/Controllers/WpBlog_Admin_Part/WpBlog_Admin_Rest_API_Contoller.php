<?php

namespace App\Http\Controllers\WpBlog_Admin_Part;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Storage;
use Illuminate\Support\Facades\DB;
use App\models\wpBlogImages\Wpress_images_Posts; //model for all posts
use App\models\wpBlogImages\Wpress_images_Category; //model for all Wpress_images_Category
use App\User; 
use App\Http\Requests\SaveNewArticleRequest;
use App\Http\Controllers\Controller; //to move Controller to subfolder

class WpBlog_Admin_Rest_API_Contoller extends Controller
{
    public function __construct(){
		//$this->middleware('auth');
        //dd(auth()->user()->id);             
	}
	
	
	
	/**
     * Admin REST API endpoint to /GET all posts
     * Ajax Requst comes from ........../list_all.vue
     * @return json
     */
	public function getAllAdminPosts(Request $request) //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all
    {   
               
        $posts = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->orderBy('wpBlog_created_at', 'desc')->get(); //->with('getImages', 'authorName', 'categoryNames') => hasMany/belongTo Eager Loading
        return response()->json(['error' => false, 'data' => $posts]);
    }
	
	
	
	
	
	
	
	
}
