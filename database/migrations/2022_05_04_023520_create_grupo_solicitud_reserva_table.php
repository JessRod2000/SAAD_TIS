<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoSolicitudReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_solicitud_reserva', function (Blueprint $table) {
            $table->string('id_G', 5);
            $table->integer('solicitud_reserva_Id_SR');
            $table->integer('solicitud_reserva_materia_SisM_M');

            $table->index(['solicitud_reserva_Id_SR', 'solicitud_reserva_materia_SisM_M'], 'fk_Grupo_solicitud_reserva_idx');
            $table->primary(['id_G', 'solicitud_reserva_Id_SR', 'solicitud_reserva_materia_SisM_M']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo_solicitud_reserva');
    }
}
