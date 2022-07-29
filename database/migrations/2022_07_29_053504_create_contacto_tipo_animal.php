<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactoTipoAnimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_tipo_animal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contacto_id')->unsigned();            
            $table->foreign('contacto_id')->references('id')->on('contactos')->onDelete('cascade'); 
            $table->string('tipo_animal_id', 36);        
            $table->foreign('tipo_animal_id')->references('id')->on('tipo_animales')->onDelete('cascade');                     
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
        Schema::table('contacto_tipo_animal', function (Blueprint $table) { 
            $table->dropForeign('contacto_tipo_animal_contacto_id_foreign'); 
            $table->dropForeign('contacto_tipo_animal_tipo_animal_id_foreign');                                     
        });

        Schema::dropIfExists('contacto_tipo_animal');
    }
}
