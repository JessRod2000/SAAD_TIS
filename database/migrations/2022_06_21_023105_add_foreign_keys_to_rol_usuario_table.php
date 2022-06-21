<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRolUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rol_usuario', function (Blueprint $table) {
            $table->foreign(['rol_usuario_Codigo_SIS_U'], 'fk_Rol_has_users_users1')->references(['Codigo_SIS_U'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['Rol_Id_R'], 'fk_Rol_has_users_Rol1')->references(['Id_R'])->on('rol')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rol_usuario', function (Blueprint $table) {
            $table->dropForeign('fk_Rol_has_users_users1');
            $table->dropForeign('fk_Rol_has_users_Rol1');
        });
    }
}
