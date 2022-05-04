<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsuarioReporteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuario_reporte', function (Blueprint $table) {
            $table->foreign(['usuario_Codigo_SIS_U'], 'fk_usuario_reporte_usuario1')->references(['Codigo_SIS_U'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['Id_RR_UR'], 'fk_Usuario_has_Reporte_Reserva_Reporte_Reserva1')->references(['Id_RR'])->on('reporte_reserva');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario_reporte', function (Blueprint $table) {
            $table->dropForeign('fk_usuario_reporte_usuario1');
            $table->dropForeign('fk_Usuario_has_Reporte_Reserva_Reporte_Reserva1');
        });
    }
}
