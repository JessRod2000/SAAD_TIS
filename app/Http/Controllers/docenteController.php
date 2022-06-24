<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RolUsuario;
use App\Models\Rol;
use App\Models\UsuarioMaterium;
use App\Models\Grupo;
 
class docenteController extends Controller
{
    public function listarDocentes(){
        $docentes = \DB::table('users')
        ->join('rol_usuario','rol_usuario_Codigo_SIS_U','=','Codigo_SIS_U')
        ->select('Codigo_SIS_U','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Correo_U')
        ->where('Rol_Id_R','=',1)
        ->get();

        return $docentes;
    }

    public function obtenerRoles(){
        $roles = \DB::table('rol')
        ->get();

        return $roles;
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

    public function gruposParaAsignar(){
        $grupos = \DB::table('grupo')
        ->join('materia','Codigo_M','=','materia_Codigo_M')
        ->select('Id_G','Codigo_M','Nombre_M')
        ->where('Asignado_G','=',0)
        ->get();

        return $grupos;
    }

    public function asignar($codSIS,$sisMateria,$grupo){
        $grupoAsignar = \DB::table('grupo')
        ->where('materia_Codigo_M','=',$sisMateria)
        ->where('Id_G','=',$grupo)
        ->update(['Asignado_G'=>1]);

        $asignado = new UsuarioMaterium();

        $asignado->Grupo_UM = $grupo;
        $asignado->asignado_UM = 1;
        $asignado->Fecha_Asignado_UM = now();
        $asignado->Fecha_Desasignado_UM = null;
        $asignado->materia_Codigo_M = $sisMateria;
        $asignado->usuario_Codigo_SIS_U = $codSIS;

        $asignado->save();
    }

    public function desasignar($codSIS,$sisMateria,$grupo){
        $grupoDesasignar = \DB::table('grupo')
        ->where('materia_Codigo_M','=',$sisMateria)
        ->where('Id_G','=',$grupo)
        ->update(['Asignado_G'=>0]);

        $desasignar = \DB::table('usuario_materia')
        ->where('Grupo_UM','=',$grupo)
        ->where('Asignado_UM','=',1)
        ->where('materia_Codigo_M','=',$sisMateria)
        ->where('usuario_Codigo_SIS_U','=',$codSIS)
        ->update(['Asignado_UM'=>0,'Fecha_Desasignado_UM'=>now()]);
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
