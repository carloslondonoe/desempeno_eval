<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanDeTrabajoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_de_trabajo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('lider_id')->unsigned();
            $table->integer('autoevaluacion_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('cms_users');
            $table->foreign('lider_id')->references('id')->on('cms_users');            
            $table->foreign('autoevaluacion_id')->references('id')->on('autoevaluacion');            
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
        Schema::dropIfExists('plan_de_trabajo');
    }
}
