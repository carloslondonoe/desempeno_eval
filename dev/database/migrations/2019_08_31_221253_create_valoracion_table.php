<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValoracionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valoracion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('evaluador_id')->unsigned();
            $table->integer('evaluacion_id');

            $table->foreign('user_id')->references('id')->on('cms_users');
            $table->foreign('evaluacion_id')->references('id')->on('evaluacion');
            $table->foreign('evaluador_id')->references('id')->on('cms_users');
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
        Schema::table('valoracion', function (Blueprint $table) {
            //
        });
    }
}
