<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsuarioMaterium;
use App\Models\Grupo;
 
class docenteController extends Controller
{
    public function listarDocentes(){
        $docentes = \DB::table('users')
        ->select('Codigo_SIS_U','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Correo_U')
        ->where('Rol_U','=',1)
        ->get();

        return $docentes;
    }

    public function index(){
        return UsuarioMaterium::all();
    }

    public function gruposMateria($sisMateria){
        $grupos = \DB::table('grupo')
        ->where('materia_Codigo_M','=',$sisMateria)
        ->get();

        return $grupos;
    }

    public function listarGruposMateria($sisMateria){
        $grupos = \DB::table('usuario_materia')
        ->select('Grupo_UM')
        ->where('materia_Codigo_M','=',$sisMateria)
        ->where('Asignado_UM','=',1)
        ->get();

        return $grupos;
    }

    public function asignar($codSIS,$sisMateria,$grupo){
        $asignado = new UsuarioMaterium();

        $asignado->Grupo_UM = $grupo;
        $asignado->asignado_UM = 1;
        $asignado->materia_SisM_M = $sisMateria;
        $asignado->usuario_Codigo_SIS_U = $codSIS;

        $asignado->save();
    }

    public function desasignar($codSIS,$sisMateria,$grupo){
        $afectado = \DB::table('usuario_materia')
        ->where('usuario_Codigo_SIS_U','=',$codSIS)
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

    public function obtenerDocente($codSIS){
        $docente = \DB::table('users')
        ->where('Codigo_SIS_U','=',$codSIS)
        ->get();

        return $docente;
    }
}
