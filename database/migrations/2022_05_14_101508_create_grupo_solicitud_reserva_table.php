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
            $table->string('Id_Grupo_GSR', 5);
            $table->integer('solicitud_reserva_Id_SR')->index('fk_grupo_solicitud_reserva_solicitud_reserva1_idx');

            $table->primary(['Id_Grupo_GSR', 'solicitud_reserva_Id_SR']);
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
