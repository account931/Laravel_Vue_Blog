 TABLE OF CONTENT:
 
 {CLEANSED_GIT_HUB/Laravel_Vue_Blog}        
     => see additional ReadMe at => 13.2   REST API authentication via token (Token Bearer, String Query) at => https://github.com/account931/Laravel-Yii2_Comment_Vote_widgets/blob/master/blog_Laravel/ReadMe_Laravel_Com_Commands.txt
 
 Main features:
     # Stack: Laravel 5.4, Vue 2, Entrust RBAC, token check by {user} table column
     # Login/register actions work via regular http sessions, while CRUD operations (read, create, delete, etc) uses access token for auth (sent as header in Vue ajax)
     # Auth verification(except for login) is performed via token (token is issued manually when user clicks button "Generate token" and saved to table {users} -> column {api_token}) and this token is sent with every ajax request in headers

     # This WpRess Vue.js Blog uses 3-table DB (same as Wpress Image Blog and {Laravel_Vue_Blog_V6_Passport}):
         wpressimages_blog_post
         wpressimage_category
         wpressimage_imagesstock => each row contains one image and Foreign Key id {wpImStock_postID} to what Blog post {wpressimages_blog_post} it relates to
     
     # Api routes use 'middleware' => ['auth:api', 'myJsonForce'], 'auth:api' automatically checks if a token is passed in request (though passing token u must implement by yourself), 'myJsonForce' forces response in JSON, 
     # Admin api routes additionally use  Route::group(['middleware' => ['myRbacCheck']] (RBAC check by Entrust)



   -------------------
   
   How it works:
   1. Login
   2. Differences and similarities between {CLEANSED_GIT_HUB/Laravel_Vue_Blog_V6_Passport} and {CLEANSED_GIT_HUB/Laravel_Vue_Blog}
   3. *******
   
   -------------------
   
   1. Login
   Login/register actions work via regular http sessions (as built in framework)


   --------------------------------------------------

   2. Differences and similarities between {CLEANSED_GIT_HUB/Laravel_Vue_Blog_V6_Passport} and {CLEANSED_GIT_HUB/Laravel_Vue_Blog}

          => See README.md => https://github.com/account931/Laravel_Vue_Blog_V6_Passport/blob/main/README.md
  

 