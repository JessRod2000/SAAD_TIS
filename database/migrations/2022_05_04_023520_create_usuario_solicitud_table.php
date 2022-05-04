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
            $table->integer('Id_SR_US')->index('fk_Usuario_has_Solicitud_Reserva_Solicitud_Reserva1_idx');
            $table->integer('usuario_Codigo_SIS_U')->index('fk_usuario_solicitud_usuario1_idx');

            $table->primary(['Id_SR_US', 'usuario_Codigo_SIS_U']);
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
