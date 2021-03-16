<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteValuesTablesEvaluations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('seguimientos')->delete();
        DB::table('plan_de_trabajo')->delete();
        DB::table('puntuacion_coordinador')->delete();
        DB::table('puntuacion_comportamiento')->delete();
        DB::table('autoevaluacion_coordinador')->delete();
        DB::table('autoevaluacion')->delete();
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
