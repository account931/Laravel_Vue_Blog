<?php
//adds api key column to users table //my Rest api token auth implementation (without Passport)

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApikeyColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function($table) {
		    $table->string('api_token')->unique()->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function($table) {
            $table->dropColumn('api_token'); // 
        });
    }
}
