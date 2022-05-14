<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('Codigo_SIS_U')->primary();
            $table->string('Nombre_U', 25);
            $table->string('Contrasenia_U', 500);
            $table->string('Correo_U', 50);
            $table->string('Apellido_Paterno_U', 15);
            $table->string('Apellido_Materno_U', 15);
            $table->integer('Rol_U');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
