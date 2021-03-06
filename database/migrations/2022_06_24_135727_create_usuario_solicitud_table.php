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
            $table->integer('solicitud_reserva_Id_SR')->index('fk_usuario_solicitud_solicitud_reserva1_idx');
            $table->integer('usuarios_Codigo_SIS_U')->index('fk_usuarios_has_solicitud_reserva_usuarios_idx');
            $table->string('Id_G_US', 5);

            $table->primary(['solicitud_reserva_Id_SR', 'usuarios_Codigo_SIS_U', 'Id_G_US']);
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
