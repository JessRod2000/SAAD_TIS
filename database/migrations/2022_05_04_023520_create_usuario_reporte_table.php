<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioReporteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_reporte', function (Blueprint $table) {
            $table->integer('Id_RR_UR')->index('fk_Usuario_has_Reporte_Reserva_Reporte_Reserva1_idx');
            $table->integer('usuario_Codigo_SIS_U')->index('fk_usuario_reporte_usuario1_idx');

            $table->primary(['Id_RR_UR', 'usuario_Codigo_SIS_U']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_reporte');
    }
}
