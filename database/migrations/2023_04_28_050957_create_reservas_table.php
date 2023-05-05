<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->string('Habitacion_id');
            $table->foreign('Habitacion_id')->references('id')->on('habitaciones');
            $table->string('Huespedes_id');
            $table->foreign('Huespedes_id')->references('id')->on('huespedes');
            $table->integer('Numero_de_huespedes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
