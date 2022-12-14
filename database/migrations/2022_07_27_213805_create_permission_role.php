<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) { 
            $table->increments('id');
            $table->string('permission_id', 50);            
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->string('role_id', 50);            
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
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
        Schema::table('permission_role', function (Blueprint $table) {   
            $table->dropForeign('permission_role_permission_id_foreign');           
            $table->dropForeign('permission_role_role_id_foreign');
        });

        Schema::dropIfExists('permission_role');
    }
}
