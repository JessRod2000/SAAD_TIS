<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioLibreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_libre', function (Blueprint $table) {
            $table->integer('Id_HL');
            $table->time('Hora_Inicio_HL');
            $table->string('Dia_HL', 15);
            $table->string('aula_Id_A', 15)->index('fk_horario_libre_aula1_idx');

            $table->primary(['Id_HL', 'aula_Id_A']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario_libre');
    }
}
