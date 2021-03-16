<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAutoevaluationIdTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('autoevaluacion_coordinador', function($table) {
            $table->integer('autoevaluacion_id')->unsigned()->nullable();
            $table->foreign('autoevaluacion_id')->references('id')->on('autoevaluacion');
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
