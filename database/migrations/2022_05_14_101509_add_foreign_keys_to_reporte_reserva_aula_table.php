<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToReporteReservaAulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reporte_reserva_aula', function (Blueprint $table) {
            $table->foreign(['aula_Id_A'], 'fk_reporte_reserva_has_aula_aula1')->references(['Id_A'])->on('aula')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['reporte_reserva_Id_RR'], 'fk_reporte_reserva_has_aula_reporte_reserva1')->references(['Id_RR'])->on('reporte_reserva')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reporte_reserva_aula', function (Blueprint $table) {
            $table->dropForeign('fk_reporte_reserva_has_aula_aula1');
            $table->dropForeign('fk_reporte_reserva_has_aula_reporte_reserva1');
        });
    }
}
