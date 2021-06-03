<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//default page
/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/',     'HomeController@index');
Route::get('/home', 'HomeController@index');

Auth::routes();

//Route::get('createNewWpressImg',    'WpBlogImagesContoller@create') ->name('createNewWpressImg');  //WpPress with Images route for displaying form to create new entry


//Wpress Blog on Vue Framework
Route::get('/wpBlogVueFrameWork',   'WpBlog_VueContoller@index')  ->name('wpBlogVueFrameWork')->middleware('auth');  //WpPress on Vue Framework Blog index route
Route::group(['middleware' => 'auth', 'prefix' => 'post'], function () { //url must contain /post/, i.e /post/get_all
    Route::get ('get_all',         'WpBlog_VueContoller@getAllPosts')->name('fetch_all');  //REST API to /GET all posts
    Route::post('create_post_vue', 'WpBlog_VueContoller@createPost')->name('create_post_vue'); //REST API to /POST (create) a new blog
});
 

Route::get('/404', function () {
    return abort(404);
});


