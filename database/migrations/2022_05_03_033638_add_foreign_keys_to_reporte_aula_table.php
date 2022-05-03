<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToReporteAulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reporte_aula', function (Blueprint $table) {
            $table->foreign(['Codi_A_RA'], 'fk_Reporte_Reserva_has_Aula_Aula1')->references(['Codi_A'])->on('aula');
            $table->foreign(['Id_RR_RA'], 'fk_Reporte_Reserva_has_Aula_Reporte_Reserva1')->references(['Id_RR'])->on('reporte_reserva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reporte_aula', function (Blueprint $table) {
            $table->dropForeign('fk_Reporte_Reserva_has_Aula_Aula1');
            $table->dropForeign('fk_Reporte_Reserva_has_Aula_Reporte_Reserva1');
        });
    }
}
