<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class docenteController extends Controller
{
    public function desasignar($id,$materia,$grupo){
        $afectado = \DB::table('usuario_materia')
        ->where('usuario_Codigo_SIS_U','=',$id)
        ->where('materia_SisM_M','=',$materia)
        ->where('Grupo_UM','=',$grupo)
        ->update(['asignado_UM'=>0]);
    }

    public function existe($codSIS,$contrasenia){
        $docente = \DB::table('users')
        ->where('Codigo_SIS_U','=',$codSIS)
        ->where('Contrasenia_U','=',$contrasenia)
        ->get();

        return $docente;
    }
}
