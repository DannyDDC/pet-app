<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) { 
            $table->increments('id');        
            $table->string('role_id', 36);            
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->uuid('user_id');        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_user', function (Blueprint $table) {  
            $table->dropForeign('role_user_role_id_foreign');          
            $table->dropForeign('role_user_user_id_foreign');    
        });

        Schema::dropIfExists('role_user');
    }
}
