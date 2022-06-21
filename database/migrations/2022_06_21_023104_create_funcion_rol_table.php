<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcion_rol', function (Blueprint $table) {
            $table->integer('Funcion_Id_F')->index('fk_Funcion_has_Rol_Funcion1_idx');
            $table->integer('Rol_Id_R')->index('fk_Funcion_has_Rol_Rol1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcion_rol');
    }
}
