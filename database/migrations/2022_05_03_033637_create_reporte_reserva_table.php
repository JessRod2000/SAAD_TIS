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
            $table->integer('Id_RR')->primary();
            $table->tinyInteger('Acep_RR');
            $table->string('Obse_RR', 200)->nullable();
            $table->date('FechAten_RR');
            $table->time('HoraAten_RR');
            $table->integer('Id_SR_RR')->index('fk_Reporte_Reserva_Solicitud_Reserva1_idx');
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
