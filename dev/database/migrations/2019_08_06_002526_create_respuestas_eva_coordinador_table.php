<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasEvaCoordinadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuesta_autoeva_coordinador', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eva_coordinador_id')->unsigned();
            $table->integer('evaluacion_id');
            $table->integer('competencia_id');
            $table->foreign('eva_coordinador_id')->references('id')->on('autoevaluacion_coordinador');
            $table->foreign('evaluacion_id')->references('id')->on('evaluacion');
            $table->foreign('competencia_id')->references('id')->on('competencia');            
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
        //
    }
}
