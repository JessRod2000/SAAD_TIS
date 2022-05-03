<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteAulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte_aula', function (Blueprint $table) {
            $table->integer('Id_RR_RA')->index('fk_Reporte_Reserva_has_Aula_Reporte_Reserva1_idx');
            $table->string('Codi_A_RA', 15)->index('fk_Reporte_Reserva_has_Aula_Aula1_idx');

            $table->primary(['Id_RR_RA', 'Codi_A_RA']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reporte_aula');
    }
}
