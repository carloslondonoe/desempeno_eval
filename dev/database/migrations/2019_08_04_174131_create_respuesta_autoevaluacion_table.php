<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaAutoevaluacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuesta_autoevaluacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('autoevaluacion_id')->unsigned();
            $table->integer('evaluacion_id');
            $table->integer('competencia_id');
            $table->foreign('autoevaluacion_id')->references('id')->on('autoevaluacion');
            $table->foreign('evaluacion_id')->references('id')->on('evaluacion');
            $table->foreign('competencia_id')->references('id')->on('competencia');            
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
