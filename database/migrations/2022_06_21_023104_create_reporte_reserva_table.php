<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte_reserva', function (Blueprint $table) {
            $table->integer('Id_RR', true);
            $table->string('Estado_RR', 5);
            $table->string('Observacion_RR', 500);
            $table->date('Fecha_Reporte_RR');
            $table->integer('solicitud_reserva_Id_SR')->index('fk_reporte_reserva_solicitud_reserva1_idx');
            $table->integer('usuarios_Codigo_SIS_U')->index('fk_reporte_reserva_usuario1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reporte_reserva');
    }
}
