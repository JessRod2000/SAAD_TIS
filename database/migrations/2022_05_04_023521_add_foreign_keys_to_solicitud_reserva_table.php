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
            $table->foreign(['materia_SisM_M'], 'fk_solicitud_reserva_materia1')->references(['SisM_M'])->on('materia')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
            $table->dropForeign('fk_solicitud_reserva_materia1');
        });
    }
}
