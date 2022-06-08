<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGrupoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grupo', function (Blueprint $table) {
            $table->foreign(['materia_Codigo_M'], 'fk_grupo_materia1')->references(['Codigo_M'])->on('materia')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grupo', function (Blueprint $table) {
            $table->dropForeign('fk_grupo_materia1');
        });
    }
}
