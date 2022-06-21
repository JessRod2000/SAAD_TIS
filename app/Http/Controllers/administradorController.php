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
        $usuario = \DB::table('users')
        ->where('Codigo_SIS_U','=',$request->Codigo_SIS_U)
        ->update(['Nombre_U'=>$request->Nombre_U,'Contrasenia_U'=>$request->Contrasenia_U,'Correo_U'=>$request->Correo_U,'Apellido_Paterno_U'=>$request->Apellido_Paterno_U,'Apellido_Materno_U'=>$request->Apellido_Materno_U]);
        
        $roles = $request->rolesAsignado;
        $longitud = sizeof($roles);

        for($i =0; $i<$longitud; $i++){
            try{
                $desasignarRol = \DB::table('rol_usuario')
                ->where('rol_usuario_Codigo_SIS_U','=',$request->Codigo_SIS_U)
                ->where('Rol_Id_R','=',$roles[$i])
                ->where('habilitado_R_U','=',1)
                ->update(['habilitado_R_U'=>1]);
            }catch(Exception $e){
                $asignarRol = new RolUsuario();
                $asignarRol->Rol_Id_R=$roles[$i];
                $asignarRol->rol_usuario_Codigo_SIS_U=$request->Codigo_SIS_U;
                $asignarRol->habilitado_R_U =1;
                $asignarRol->fecha_inicio_R_U =now();
                $asignarRol->save();
            }
        }
        
/*
        $desasignarRol = \DB::table('rol_usuario')
        ->where('rol_usuario_Codigo_SIS_U','=',$request->Codigo_SIS_U)
        ->where('Rol_Id_R','=',$roles[$i])
        ->where('habilitado_R_U','=',1)
        ->update(['habilitado_R_U'=>0,'fecha_fin_R_U'=>now()]);
        
        $asignarRol = new RolUsuario();
        $asignarRol->Rol_Id_R=$roles[$i];
        $asignarRol->rol_usuario_Codigo_SIS_U=$request->Codigo_SIS_U;
        $asignarRol->habilitado_R_U =1;
        $asignarRol->fecha_inicio_R_U =now();
        $asignarRol->save();*/
    }

    public function desasignarRoles(request $request){
        $roles = $request->roles;
        $longitud = sizeof($roles);

        for($i =0; $i<$longitud; $i++){
            try{
                $desasignarRol = \DB::table('rol_usuario')
                ->where('rol_usuario_Codigo_SIS_U','=',$request->Codigo_SIS_U)
                ->where('Rol_Id_R','=',$roles[$i])
                ->where('habilitado_R_U','=',1)
                ->update(['habilitado_R_U'=>0,'fecha_fin_R_U'=>now()]);
            }catch(Exception $e){

            }
        }
    }

    public function editarPeriodoAcademico(request $request){
        $periodo = \DB::table('periodo_academico')
        ->where('Id_PA','=',$request->Id_PA)
        ->update(['Fecha_Inicio_PA'=>$request->Fecha_Inicio_PA,'Fecha_Fin_PA'=>$request->Fecha_Fin_PA]);
    }
}
