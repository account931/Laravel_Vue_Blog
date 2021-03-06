<?php
//This is the MAIN SEEDER!!!!

use Illuminate\Database\Seeder;
//use App\database\seeds\SeedersFiles\ShopSimpleSeeder;
//use Illuminate\Support\Facades\DB;
//use File;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		//specify what data to run
        // $this->call(UsersTableSeeder::class);
		$this->call('Users_Seeder');  //fill DB table {users} with data
		$this->call('Roles_Seeder');  //fill DB table {roles} with data {4 roles}
		$this->call('RoleUsers_Seeder');  //fill DB table {role_user} with data {assign admin to Dima}
		$this->call('Wpressimage_category_Seeder');      //fill DB table { wpressimage_category} with data
		$this->call('WpressImages_blog_Post_Seeder');    //fill DB table {	wpressimages_blog_post} with data
        $this->call('WpressImages_ImagesStock_Seeder');  //fill DB table {	wpressimage_imagesstock} with data
		 
		$this->command->info('Seedering action was successful!');
    }
	
	
  
}
//------------------- ALL SEEDERS CLASS -----------------------------------




//fill DB table {users} with data 
class Users_Seeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();  //whether to Delete old materials

        //User::create(['email' => 'foo@bar.com']);
        DB::table('users')->insert(['id' => 1, 'name' => 'Admin', 'email' => 'admin@ukr.net', 'password' => bcrypt('adminadmin') ]);
	    DB::table('users')->insert(['id' => 2, 'name' => 'Dima', 'email' => 'dimmm931@gmail.com', 'password' => bcrypt('dimadima') ]);
	    DB::table('users')->insert(['id' => 3, 'name' => 'Olya', 'email' => 'olya@gmail.com', 'password' => bcrypt('olyaolya') ]);

    }
}


//fill DB table {roles} with data (create 4 roles)
class Roles_Seeder extends Seeder {
    public function run()
    {
        DB::table('roles')->delete();  //whether to Delete old materials

        //User::create(['email' => 'foo@bar.com']);
        DB::table('roles')->insert(['id' => 12, 'name' => 'owner', 'display_name' => 'Project Owner', 'description' => 'User is the owner of a given project', 'created_at' => date('Y-m-d H:i:s') ]);
	    DB::table('roles')->insert(['id' => 13, 'name' => 'admin', 'display_name' => 'User Administrator', 'description' => 'User is allowed to manage and edit other users', 'created_at' =>  date('Y-m-d H:i:s') ]);
        DB::table('roles')->insert(['id' => 14, 'name' => 'manager', 'display_name' => 'Company Manager', 'description' => 'User is a manager of a Department', 'created_at' =>  date('Y-m-d H:i:s') ]);
        DB::table('roles')->insert(['id' => 15, 'name' => 'commander', 'display_name' => 'custom role', 'description' => 'Wing Commander', 'created_at' => date('Y-m-d H:i:s') ]);
    }
}



//fill DB table {role_user} with data 
class RoleUsers_Seeder extends Seeder {
    public function run()
    {
        DB::table('role_user')->delete();  //whether to Delete old materials

        DB::table('role_user')->insert(['user_id' => 2, 'role_id' => 13 ]);
    }
}







//Wpress with Images====================================

//fill DB table {wpressimage_category} with data.

class Wpressimage_category_Seeder extends Seeder {
    public function run()
    {
    
	    DB::table('wpressimage_category')->delete();  //whether to Delete old materials
		
        DB::table('wpressimage_category')->insert(['wpCategory_id' => 1, 'wpCategory_name' => 'News' ]);
		DB::table('wpressimage_category')->insert(['wpCategory_id' => 2, 'wpCategory_name' => 'Art' ]);
		DB::table('wpressimage_category')->insert(['wpCategory_id' => 3, 'wpCategory_name' => 'Sport' ]);
		DB::table('wpressimage_category')->insert(['wpCategory_id' => 4, 'wpCategory_name' => 'Geeks' ]);
		DB::table('wpressimage_category')->insert(['wpCategory_id' => 5, 'wpCategory_name' => 'Drops' ]);
		
        

    } 
} 






//fill DB table {	wpressimages_blog_post} with data.
class WpressImages_blog_Post_Seeder extends Seeder {
    public function run()
    {
    
	    //DB::table('wpressimages_blog_post')->delete();  //whether to Delete old materials
		DB::statement('SET FOREIGN_KEY_CHECKS=0');       //way to set auto increment back to 1 before seeding a table (instead of ->delete())
        DB::table('wpressimages_blog_post')->truncate(); //way to set auto increment back to 1 before seeding a table

		$NUMBER_OF_CATEGORIES = 5;
        $faker = Faker::create();
        $gender = $faker->randomElement(['male', 'female']);

    	foreach (range(1,20) as $index) {
		
            DB::table('wpressimages_blog_post')->insert([
                'wpBlog_title'    => $faker->name, //$faker->name($gender),
                'wpBlog_text'     =>  $faker->realText($maxNbChars = 200, $indexSize = 2), //$faker->text,
                'wpBlog_author'   => 1, //$faker->username,
				'wpBlog_category' => rand(1, $NUMBER_OF_CATEGORIES), //random string between min and max numbe
                //'wpBlog_status' => $faker->date($format = 'Y-m-d', $max = 'now'),
				//'image' => $faker->image(public_path('images/students'),400,300, null, false), //saving images to 'public/images/students. Takes much time
                //'image' => 'http://loremflickr.com/400/300?random='.rand(1, 100),

            ]);
        }   
    } 
}


//REWORK!!!!!!!!!!!!!!!!!!!!
//fill DB table {wpressimage_imagesstock} with data.
class WpressImages_ImagesStock_Seeder extends Seeder {
    public function run()
    {
    
	    DB::table('wpressimage_imagesstock')->delete();  //whether to Delete old materials
        
		$NUMBER_OF_ARTICLES = 20;
        $faker = Faker::create();
        $gender = $faker->randomElement(['male', 'female']);
  
        //Manual image insert, to use preloaded images(for better UI -). If wish may switch to Faker images (decomment next paragraph)
        //Firstly, copy images from folder '/preloaded' to '/wpressImages'. Can't set save those images in '/wpressImages' in first place as '/wpressImages' contains '.gitignore' file not to add to Git all images uploaded there and get the mess.
        // get source directory
        //$pathSource = Storage::disk('images/preloaded')->getDriver()->getAdapter()->applyPathPrefix(null);

        // get destination directory (already exists)
        //$pathDestination = Storage::disk('images/wpressImages')->getDriver()->getAdapter()->applyPathPrefix(null);
        //File::copyDirectory($pathSource, $pathDestination);
        //Storage::move('/images/preloaded',  '/images/wpressImages22');
        // \File::copyDirectory('/images/preloaded',  '/images/wpressImages'); //DOES NOT WORK
        
        
        DB::table('wpressimage_imagesstock')->insert(['wpImStock_postID' => 1,  'wpImStock_name' => 'product1.png' ]);
        DB::table('wpressimage_imagesstock')->insert(['wpImStock_postID' => 2,  'wpImStock_name' => 'product2.png' ]);
        DB::table('wpressimage_imagesstock')->insert(['wpImStock_postID' => 3,  'wpImStock_name' => 'product3.png' ]);
        DB::table('wpressimage_imagesstock')->insert(['wpImStock_postID' => 4,  'wpImStock_name' => 'product4.png' ]);
        DB::table('wpressimage_imagesstock')->insert(['wpImStock_postID' => 5,  'wpImStock_name' => 'product5.png' ]);
        DB::table('wpressimage_imagesstock')->insert(['wpImStock_postID' => 6,  'wpImStock_name' => 'product6.png' ]);
        DB::table('wpressimage_imagesstock')->insert(['wpImStock_postID' => 7,  'wpImStock_name' => 'product7.jpg' ]);
        DB::table('wpressimage_imagesstock')->insert(['wpImStock_postID' => 8,  'wpImStock_name' => 'product8.jpg' ]);
        DB::table('wpressimage_imagesstock')->insert(['wpImStock_postID' => 9,  'wpImStock_name' => 'product9.jpg' ]);
        DB::table('wpressimage_imagesstock')->insert(['wpImStock_postID' => 10, 'wpImStock_name' => 'product10.jpg' ]);
        
        //Working Seeder, just reassigned it from random images to preloaded(for better UI -))))
        /*
    	foreach (range(1,20) as $index) {
		
            DB::table('wpressimage_imagesstock')->insert([
                //assign random images via Faker. Working
                'wpImStock_name'   => $faker->image(public_path('images/wpressImages'),400,300, null, false), //saving images to 'public/images/students. Takes much time
                'wpImStock_postID' =>  rand(1, $NUMBER_OF_ARTICLES), //random string between min and max number

                
				//'image' => $faker->image(public_path('images/students'),400,300, null, false), //saving images to 'public/images/students. Takes much time
                //'image' => 'http://loremflickr.com/400/300?random='.rand(1, 100),

            ]);
        } 
        */        
    } 
}
