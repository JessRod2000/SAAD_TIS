<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioSolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_solicitud', function (Blueprint $table) {
            $table->integer('solicitud_reserva_Id_SR')->index('fk_usuarios_has_solicitud_reserva_solicitud_reserva1_idx');
            $table->integer('usuarios_Codigo_SIS_U')->index('fk_usuarios_has_solicitud_reserva_usuarios_idx');

            $table->primary(['solicitud_reserva_Id_SR', 'usuarios_Codigo_SIS_U']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_solicitud');
    }
}
