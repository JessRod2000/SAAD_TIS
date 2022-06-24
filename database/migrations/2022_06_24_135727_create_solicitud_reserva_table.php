<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_reserva', function (Blueprint $table) {
            $table->integer('Id_SR', true);
            $table->integer('materia_Codigo_M')->index('fk_solicitud_reserva_materia1_idx');
            $table->date('Fecha_SR');
            $table->time('Hora_Inicio_SR');
            $table->integer('Cantidad_Periodos_SR');
            $table->integer('Numero_Estudiantes_SR');
            $table->integer('Estado_Atendido_SR');
            $table->string('Motivo_SR', 200);
            $table->time('Hora_Final_SR');
            $table->timestamp('Creado_en_SR')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_reserva');
    }
}
