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
            $table->integer('asignado_UM');
            $table->integer('materia_SisM_M')->index('fk_usuario_materia_materia1_idx');
            $table->integer('usuario_Codigo_SIS_U')->index('fk_usuario_materia_usuario1_idx');
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
