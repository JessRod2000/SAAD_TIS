<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToReporteReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reporte_reserva', function (Blueprint $table) {
            $table->foreign(['Id_SR_RR'], 'fk_Reporte_Reserva_Solicitud_Reserva1')->references(['Id_SR'])->on('solicitud_reserva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reporte_reserva', function (Blueprint $table) {
            $table->dropForeign('fk_Reporte_Reserva_Solicitud_Reserva1');
        });
    }
}
