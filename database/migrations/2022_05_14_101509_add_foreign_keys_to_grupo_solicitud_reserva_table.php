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
            $table->foreign(['solicitud_reserva_Id_SR'], 'fk_grupo_solicitud_reserva_solicitud_reserva1')->references(['Id_SR'])->on('solicitud_reserva')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
            $table->dropForeign('fk_grupo_solicitud_reserva_solicitud_reserva1');
        });
    }
}
