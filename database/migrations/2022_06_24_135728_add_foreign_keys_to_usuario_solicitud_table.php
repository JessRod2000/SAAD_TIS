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
            $table->foreign(['usuarios_Codigo_SIS_U'], 'fk_usuarios_has_solicitud_reserva_usuarios')->references(['Codigo_SIS_U'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['solicitud_reserva_Id_SR'], 'fk_usuario_solicitud_solicitud_reserva1')->references(['Id_SR'])->on('solicitud_reserva')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
            $table->dropForeign('fk_usuarios_has_solicitud_reserva_usuarios');
            $table->dropForeign('fk_usuario_solicitud_solicitud_reserva1');
        });
    }
}
