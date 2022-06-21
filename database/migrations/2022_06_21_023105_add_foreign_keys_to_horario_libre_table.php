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
            $table->foreign(['aula_Id_A'], 'fk_horario_libre_aula1')->references(['Id_A'])->on('aula')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
            $table->dropForeign('fk_horario_libre_aula1');
        });
    }
}
