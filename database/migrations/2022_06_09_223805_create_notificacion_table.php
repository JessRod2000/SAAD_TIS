<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacion', function (Blueprint $table) {
            $table->integer('Id_N', true);
            $table->integer('Estado_N');
            $table->integer('usuario_Codigo_SIS_U')->index('fk_notificacion_usuario1_idx');
            $table->integer('reporte_reserva_Id_RR')->index('fk_notificacion_reporte_reserva1_idx');

            $table->primary(['Id_N', 'usuario_Codigo_SIS_U', 'reporte_reserva_Id_RR']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificacion');
    }
}
