<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveAutoevaluacionIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('autoevaluacion_coordinador', function (Blueprint $table) {
            $table->dropForeign(['autoevaluacion_id']);
            $table->dropColumn('autoevaluacion_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('autoevaluacion_coordinador', function (Blueprint $table) {
            //
        });
    }
}
