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
            $table->integer('Id_HL')->primary();
            $table->time('HoraInic_HL');
            $table->time('HoraFina_HL');
            $table->string('Dia_HL', 10);
            $table->string('Codi_A_HL', 15)->index('fk_Horario_Libre_Aula1_idx');
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
