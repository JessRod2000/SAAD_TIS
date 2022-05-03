<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToHorarioLibreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('horario_libre', function (Blueprint $table) {
            $table->foreign(['Codi_A_HL'], 'fk_Horario_Libre_Aula1')->references(['Codi_A'])->on('aula');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('horario_libre', function (Blueprint $table) {
            $table->dropForeign('fk_Horario_Libre_Aula1');
        });
    }
}
