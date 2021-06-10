<?php

use Illuminate\Http\Request;
use Http\Controllers\WpBlog_Rest_API_Contoller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//$v = "mm";

//middleware' => ['sendTokenMy', 'auth:api'] // middleware' => 'auth', 'auth:api' //By default auth:api middleware requires each user to have a field in the database called api_token,
Route::group(['middleware' => [ 'auth:api', 'sendTokenMy'],  'prefix' => 'post'], function () { //url must contain /post/, i.e /post/get_all
    Route::get ('get_all',         'WpBlog_Rest_API_Contoller@getAllPosts')->name('fetch_all');  //REST API to /GET all posts
    Route::post('create_post_vue', 'WpBlog_Rest_API_Contoller@createPost') ->name('create_post_vue'); //REST API to /POST (create) a new blog
});  