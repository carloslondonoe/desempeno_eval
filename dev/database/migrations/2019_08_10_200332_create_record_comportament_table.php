<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordComportamentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntuacion_comportamiento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('autoevaluacion_id')->unsigned();
            $table->integer('evaluacion_id');
            $table->integer('competencia_id');
            $table->integer('comportamiento_id');
            $table->foreign('autoevaluacion_id')->references('id')->on('autoevaluacion');
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
        Schema::dropIfExists('puntuacion_comportamiento');
    }
}
