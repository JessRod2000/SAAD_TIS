<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteReservaAulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte_reserva_aula', function (Blueprint $table) {
            $table->integer('reporte_reserva_Id_RR')->index('fk_reporte_reserva_has_aula_reporte_reserva1_idx');
            $table->string('aula_Id_A', 15)->index('fk_reporte_reserva_has_aula_aula1_idx');
            $table->date('Fecha_Reserva_Ocupado_RRA');
            $table->time('Horario_Ocupado_Inicio_RRA');
            $table->integer('Periodos_RRA');
            $table->integer('Estado_RRA');

            $table->primary(['reporte_reserva_Id_RR', 'aula_Id_A']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reporte_reserva_aula');
    }
}
