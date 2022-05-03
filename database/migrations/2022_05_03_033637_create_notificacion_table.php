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
            $table->integer('Id_N')->primary();
            $table->string('Titu_N', 20);
            $table->tinyInteger('Leid_N');
            $table->integer('Id_RR_N')->index('fk_Notificacion_Reporte_Reserva1_idx');
            $table->integer('usuario_Codigo_SIS_U')->index('fk_notificacion_usuario1_idx');
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
