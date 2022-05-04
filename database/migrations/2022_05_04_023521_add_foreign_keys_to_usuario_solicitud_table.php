<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsuarioSolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuario_solicitud', function (Blueprint $table) {
            $table->foreign(['usuario_Codigo_SIS_U'], 'fk_usuario_solicitud_usuario1')->references(['Codigo_SIS_U'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['Id_SR_US'], 'fk_Usuario_has_Solicitud_Reserva_Solicitud_Reserva1')->references(['Id_SR'])->on('solicitud_reserva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario_solicitud', function (Blueprint $table) {
            $table->dropForeign('fk_usuario_solicitud_usuario1');
            $table->dropForeign('fk_Usuario_has_Solicitud_Reserva_Solicitud_Reserva1');
        });
    }
}
