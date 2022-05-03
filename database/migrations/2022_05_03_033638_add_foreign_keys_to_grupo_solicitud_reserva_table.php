<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGrupoSolicitudReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grupo_solicitud_reserva', function (Blueprint $table) {
            $table->foreign(['solicitud_reserva_Id_SR', 'solicitud_reserva_materia_SisM_M'], 'fk_Grupo_solicitud_reserva')->references(['Id_SR', 'materia_SisM_M'])->on('solicitud_reserva')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grupo_solicitud_reserva', function (Blueprint $table) {
            $table->dropForeign('fk_Grupo_solicitud_reserva');
        });
    }
}
