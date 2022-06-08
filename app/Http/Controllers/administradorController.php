<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PeriodoAcademico;

class administradorController extends Controller
{
    public function listarAdministradores(){
        $administradores = \DB::table('users')
        ->select('Codigo_SIS_U','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Correo_U','Rol_U')
        ->where('Rol_U','<>',1)
        ->get();

        return $administradores;
    }

    public function establecerPeriodoAcademico(request $request){
        $periodo = new PeriodoAcademico();
        $periodo->Semestre_PA=$request->semestre;
        $periodo->Fecha_Inicio_PA=$request->fechaInicio;
        $periodo->Fecha_Fin_PA=$request->fechaFin;

        $periodo->save();
    }

    public function obtenerUsuario($codSIS){
        $docente = \DB::table('users')
        ->where('Codigo_SIS_U','=',$codSIS)
        ->get();

        return $docente;
    }

    public function editarUsuario(request $request){
        $reserva = \DB::table('users')
        ->where('Codigo_SIS_U','=',$request->Codigo_SIS_U)
        ->update(['Nombre_U'=>$request->Nombre_U,'Contrasenia_U'=>$request->Contrasenia_U,'Correo_U'=>$request->Correo_U,'Apellido_Paterno_U'=>$request->Apellido_Paterno_U,'Apellido_Materno_U'=>$request->Apellido_Materno_U,'Rol_U'=>$request->Rol_U]);
    }
}
