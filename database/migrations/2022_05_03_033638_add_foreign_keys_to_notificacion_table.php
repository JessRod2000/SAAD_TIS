<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToNotificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notificacion', function (Blueprint $table) {
            $table->foreign(['Id_RR_N'], 'fk_Notificacion_Reporte_Reserva1')->references(['Id_RR'])->on('reporte_reserva');
            $table->foreign(['usuario_Codigo_SIS_U'], 'fk_notificacion_usuario1')->references(['Codigo_SIS_U'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notificacion', function (Blueprint $table) {
            $table->dropForeign('fk_Notificacion_Reporte_Reserva1');
            $table->dropForeign('fk_notificacion_usuario1');
        });
    }
}
