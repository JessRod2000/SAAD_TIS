<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsuarioMateriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuario_materia', function (Blueprint $table) {
            $table->foreign(['materia_Codigo_M'], 'fk_usuario_materia_materia1')->references(['Codigo_M'])->on('materia')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['usuario_Codigo_SIS_U'], 'fk_usuario_materia_usuario1')->references(['Codigo_SIS_U'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario_materia', function (Blueprint $table) {
            $table->dropForeign('fk_usuario_materia_materia1');
            $table->dropForeign('fk_usuario_materia_usuario1');
        });
    }
}
