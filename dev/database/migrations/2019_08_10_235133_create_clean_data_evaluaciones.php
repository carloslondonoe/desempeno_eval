<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCleanDataEvaluaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('respuesta_autoevaluacion')->delete();
        DB::table('respuesta_autoeva_coordinador')->delete();
        /*
        DB::table('autoevaluacion_coordinador')->delete();
        DB::table('autoevaluacion')->delete();
        /*
        Schema::dropIfExists('respuesta_autoevaluacion');
        Schema::dropIfExists('respuesta_autoeva_coordinador');
        /* */
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
