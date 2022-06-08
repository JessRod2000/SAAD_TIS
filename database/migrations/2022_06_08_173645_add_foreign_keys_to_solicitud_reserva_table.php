<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSolicitudReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_reserva', function (Blueprint $table) {
            $table->foreign(['periodo_academico_Id_PA1'], 'fk_solicitud_reserva_periodo_academico1')->references(['Id_PA'])->on('periodo_academico')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['materia_Codigo_M'], 'fk_solicitud_reserva_materia1')->references(['Codigo_M'])->on('materia')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_reserva', function (Blueprint $table) {
            $table->dropForeign('fk_solicitud_reserva_periodo_academico1');
            $table->dropForeign('fk_solicitud_reserva_materia1');
        });
    }
}
