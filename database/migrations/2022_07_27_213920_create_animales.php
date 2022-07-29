<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animales', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre', 50);
            $table->integer('anios');
            $table->integer('meses');
            $table->float('altura');
            $table->float('peso');
            $table->string('color', 50);
            $table->boolean('vacunado');          
            $table->string('ruta_imagen', 200)->nullable();
            $table->string('tipo_animal_id', 36);            
            $table->foreign('tipo_animal_id')->references('id')->on('tipo_animales'); 
            $table->uuid('user_id');            
            $table->foreign('user_id')->references('id')->on('users'); 
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
        Schema::table('animales', function (Blueprint $table) {  
            $table->dropForeign('animales_tipo_animal_id_foreign');    
            $table->dropForeign('animales_user_id_foreign');
        });

        Schema::dropIfExists('animales');
    }
}
