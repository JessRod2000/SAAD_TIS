<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_usuario', function (Blueprint $table) {
            $table->integer('Rol_Id_R')->index('fk_Rol_has_users_Rol1_idx');
            $table->integer('rol_usuario_Codigo_SIS_U')->index('fk_Rol_has_users_users1_idx');
            $table->integer('habilitado_R_U');
            $table->date('fecha_inicio_R_U');
            $table->date('fecha_fin_R_U')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_usuario');
    }
}
