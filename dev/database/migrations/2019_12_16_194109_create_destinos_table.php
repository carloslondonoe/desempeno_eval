<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solicitud_tiquete_id')->unsigned();
            
            $table->string('destino');
            $table->date('dia_salida');
            $table->date('dia_regreso')->nullable(true);
            $table->time('hora_salida');
            $table->time('hora_regreso')->nullable(true);
            
            $table->foreign('solicitud_tiquete_id')->references('id')->on('solicitud_tiquetes');
            
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
        Schema::dropIfExists('destinos');
    }
}
