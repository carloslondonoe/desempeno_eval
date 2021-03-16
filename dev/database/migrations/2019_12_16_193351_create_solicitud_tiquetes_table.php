<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudTiquetesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_tiquetes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('jefe_id')->unsigned();

            $table->string('motivo');
            $table->string('proyecto');
            $table->string('direccion');
            $table->boolean('reserva_hotelera')->default(false);
            $table->boolean('taxi')->default(false);
            $table->string('observaciones');
            $table->enum('autorizado', ['pendiente', 'confirmado', 'rechazado'])->default('pendiente');

            $table->foreign('user_id')->references('id')->on('cms_users');
            $table->foreign('jefe_id')->references('id')->on('cms_users');
            
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
        Schema::dropIfExists('solicitud_tiquetes');
    }
}
