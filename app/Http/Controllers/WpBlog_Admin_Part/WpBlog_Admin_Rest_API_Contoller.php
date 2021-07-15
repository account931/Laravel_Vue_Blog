<?php

namespace App\Http\Controllers\WpBlog_Admin_Part;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Storage;
use Illuminate\Support\Facades\DB;
use App\models\wpBlogImages\Wpress_images_Posts;    //model for all posts
use App\models\wpBlogImages\Wpress_images_Category; //model for all Wpress_images_Category
use App\User; 
//use App\Http\Requests\SaveNewArticleRequest;
use App\Http\Requests\UpdateExistingArticleRequest; //Validation Request Class
use App\Http\Controllers\Controller; //to move Controller to subfolder

class WpBlog_Admin_Rest_API_Contoller extends Controller
{
    public function __construct(){
		//$this->middleware('auth');
        //dd(auth()->user()->id);             
	}
	
	
	
	/**
     * Admin REST API endpoint to /GET all posts
     * Ajax Requst comes from ........../resources/assets/js/WpBlog_Admin_Part/components/pages/list_all.vue.
     * Triggered automatically in beforeMount() in /list_all.vue
     * @return json
     */
	public function getAllAdminPosts(Request $request) //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all
    {   
        $posts = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->orderBy('wpBlog_created_at', 'desc')->get(); //->with('getImages', 'authorName', 'categoryNames') => hasMany/belongTo Eager Loading
        return response()->json(['error' => false, 'data' => $posts]);
    }
	
	
    

	
	/**
     * Admin REST API endpoint to /GET get one blog/item by ID. Used in edit/update Form.
     * Ajax Requst comes from ........../resources/assets/js/WpBlog_Admin_Part/components/pages/editItem.vue. Triggered automatically in beforeMount()
     * @return \Illuminate\Http\Response
     */
    public function getAllAdminOneItem($idX)
    {    
        $posts = Wpress_images_Posts::with('getImages', 'authorName', 'categoryNames')->where('wpBlog_id', $idX)->orderBy('wpBlog_created_at', 'desc')->get(); //->with('getImages', 'authorName', 'categoryNames') => hasMany/belongTo Eager Loading
        return response()->json(['error' => false, 'data' => $posts]);
    }
	
	
    
    
    
    /**
     * Admin REST API endpoint to Update/Edit one blog/item by ID, used via  /PUT . Triggered by Edit/Update Form "Submit" button.
     * Ajax Requst comes from ........../resources/assets/js/WpBlog_Admin_Part/components/pages/editItem.vue. Triggered by clicking Form "Submit" button
     * @param $idX, an id of edited post, set in URL(in editItem.vue) like this 'api/post/admin_get_one_blog/' + idZ 
     * @param $request, example of request => [ "title" => "TTTTTTTTT", "body" => "JavaScript Tutorial", "selectV" => "3", "imageToDelete" => "66", "_method" => "PUT", "imagesZZZ" => array:1 [0 => UploadedFile {#1172, -originalName: "2254.png", -mimeType: "image/png", -size: 30871} ] 
     * @return \Illuminate\Http\Response
     */
    public function AdminUpdateOneItem($idX, UpdateExistingArticleRequest $request)  //Request Class validation //Request $request
    {   
         //Due to overridded {function failedValidation(Validator $validator)} in RequestClass, we can proceed here, even if Validation fails
        if (isset($request->validator) && $request->validator->fails()) {
           //return response()->json($request->validator->messages(), 400);
           return response()->json([
               'error' => true, 
               'data' => 'Was seem to be OK, but validation crashes', 
               'validateErrors'=>  $request->validator->messages()]);
        }
        
        
        //Below is just for testing ------
        /*
        //Old images User clicked to delete (while editing)
        $imageToDelete = ' User while updating requested to delete Images: '; 
        
        if ($request->has('imageToDelete')){
            //convert string {$request->imageToDelete} to array
            $del = explode(" ", $request->imageToDelete); // for bizzare reason {$request->imageToDelete) comes to Server as string not array 
            foreach($del as $d){
                $imageToDelete.= $d;    
            }
        } else {
            $imageToDelete.= ' Zero old images ';
        }
        
        //New images uploaded by User (while editing)
        $imagesNew = ' User Uploaded new Images: '; 
        
        if (isset($request->imagesZZZ)){
            foreach($request->imagesZZZ as $d){
                $imagesNew.= " " . $d;    
            }
        } else {
            $imagesNew.= ' Zero new images ';
        }
        
        return response()->json([
            'error' => false, 
            'data' => 'Update is OK. Implement me further. Your ID ' . $idX . ' TITLE: ' . 
                      $request->title . ' ' . $request->body . ' Category: ' . $request->selectV . ' ' .
                      $imageToDelete . ' / ' .
                      $imagesNew
        ]);
        */
        //End Below is just for testing --------
        
        

        
        $model = new Wpress_images_Posts();
        
        //Updates one post/item in DB 'wpressimages_blog_post'
        $updatePost  = $model ->updatePostItem($idX, $request);
        
        //Saves new images (if any) to DB Wpress_ImagesStock (new images that a user uploaded while updtaing/editing a post)
        $uploadNewImg = $model ->updateNewImages($idX, $request);
        
        //Deletes old images (if any) to DB DB Wpress_ImagesStock (old images that a user wished to delete while updtaing/editing a post)
        $deleteOldImg = $model ->deleteOldImages($idX, $request);
        
        
          return response()->json([
            'error' => false, 
            'data' => 'Model methods says: ' . 
                      $updatePost   . ' / ' .
                      $uploadNewImg . ' / ' .
                      $deleteOldImg
        ]);
        
    }
	
    
    
    
    
    
	
    /**
     * Admin REST API endpoint to /DELETE one item
     * Ajax Requst for Delete comes from ........../resources/assets/js/WpBlog_Admin_Part/components/pages/list_all.vue
     * Triggered by click
     * @return json
     */
	public function deleteOneItem($idN) //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/admin_delete_item/{id}
    {
        return response()->json(['error' => false, 'data' => "Implement Deleting for  " . $idN ]); 

        /*
        $data = Abz_Employees::findOrFail($id);
        $info = $data;
        
        //reassign a new superior to deleted user's subordinates. Upon deleting this employee, find this employee subordinates (whose who has this deleted emplyee's ID as in their 'superior_id' column and assign them other superior with the same rank)
		$model = new Abz_Employees();
		$v = $model->reassignSuperior($info);
        
        //delete the image from folder '/images/employees/'
		//$product = Abz_Employees::where('id', $id)->first(); //found image 
		if(file_exists(public_path('images/employees/' . $data->image))){
		    \Illuminate\Support\Facades\File::delete('images/employees/' . $data->image);
		}
        
		$data->delete(); //delete the user
		
		return response()->json(['result' => $v]);
        */        
    }
	
}
