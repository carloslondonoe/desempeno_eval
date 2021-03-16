<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuntuacionValoracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntuacion_valoracion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('valoracion_id')->unsigned();
            $table->integer('evaluacion_id');
            $table->integer('competencia_id');
            $table->integer('comportamiento_id');
            $table->foreign('valoracion_id')->references('id')->on('valoracion');
            $table->foreign('evaluacion_id')->references('id')->on('evaluacion');
            $table->foreign('competencia_id')->references('id')->on('competencia');            
            $table->foreign('comportamiento_id')->references('id')->on('comportamiento');                                    
            $table->string('puntuacion');
            $table->text('observaciones')->nullable();
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
        Schema::table('putuacion_valoracion', function (Blueprint $table) {
            //
        });
    }
}
