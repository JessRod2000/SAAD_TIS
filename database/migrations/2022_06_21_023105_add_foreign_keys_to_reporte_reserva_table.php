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
            $table->foreign(['usuarios_Codigo_SIS_U'], 'fk_reporte_reserva_usuario1')->references(['Codigo_SIS_U'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['solicitud_reserva_Id_SR'], 'fk_reporte_reserva_solicitud_reserva1')->references(['Id_SR'])->on('solicitud_reserva')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
            $table->dropForeign('fk_reporte_reserva_usuario1');
            $table->dropForeign('fk_reporte_reserva_solicitud_reserva1');
        });
    }
}
