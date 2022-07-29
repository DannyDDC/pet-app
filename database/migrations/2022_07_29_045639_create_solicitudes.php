<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('correo_electronico');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('ciudad');  
            $table->string('motivo');  
            $table->uuid('animal_id');            
            $table->foreign('animal_id')->references('id')->on('animales'); 
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
        Schema::table('solicitudes', function (Blueprint $table) {       
            $table->dropForeign('solicitudes_animal_id_foreign');
        });
        Schema::dropIfExists('solicitudes');
    }
}
