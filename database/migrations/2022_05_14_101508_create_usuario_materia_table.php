<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioMateriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_materia', function (Blueprint $table) {
            $table->string('Grupo_UM', 5);
            $table->integer('Asignado_UM');
            $table->date('Fecha_Asignado_UM');
            $table->date('Fecha_Desasignado_UM')->nullable();
            $table->integer('materia_Codigo_M')->index('fk_usuario_materia_materia1_idx');
            $table->integer('usuario_Codigo_SIS_U')->index('fk_usuario_materia_usuario1_idx');
            $table->integer('Id_UM', true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_materia');
    }
}
