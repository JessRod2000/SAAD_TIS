<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFuncionRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funcion_rol', function (Blueprint $table) {
            $table->foreign(['Rol_Id_R'], 'fk_Funcion_has_Rol_Rol1')->references(['Id_R'])->on('rol')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['Funcion_Id_F'], 'fk_Funcion_has_Rol_Funcion1')->references(['Id_F'])->on('funcion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcion_rol', function (Blueprint $table) {
            $table->dropForeign('fk_Funcion_has_Rol_Rol1');
            $table->dropForeign('fk_Funcion_has_Rol_Funcion1');
        });
    }
}
