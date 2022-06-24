<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RolUsuario;

class administradorController extends Controller
{
    public function listarAdministradores(){
        $administradores = \DB::table('users')
        ->join('rol_usuario','rol_usuario_Codigo_SIS_U','=','Codigo_SIS_U')
        ->select('Codigo_SIS_U','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Correo_U')
        ->where('Rol_Id_R','=',2)
        ->get();

        return $administradores;
    }

    public function obtenerUsuario($codSIS){
        $docente = \DB::table('users')
        ->where('Codigo_SIS_U','=',$codSIS)
        ->get();

        return $docente;
    }

    public function editarUsuario(request $request){
        if($request->Contrasenia_U == null){
            $usuario = \DB::table('users')
            ->where('Codigo_SIS_U','=',$request->Codigo_SIS_U)
            ->update(['Nombre_U'=>$request->Nombre_U,'Correo_U'=>$request->Correo_U,'Apellido_Paterno_U'=>$request->Apellido_Paterno_U,'Apellido_Materno_U'=>$request->Apellido_Materno_U]);
        }else{
            $usuario = \DB::table('users')
            ->where('Codigo_SIS_U','=',$request->Codigo_SIS_U)
            ->update(['Nombre_U'=>$request->Nombre_U,'Contrasenia_U'=>$request->Contrasenia_U,'Correo_U'=>$request->Correo_U,'Apellido_Paterno_U'=>$request->Apellido_Paterno_U,'Apellido_Materno_U'=>$request->Apellido_Materno_U]);
        }
        
        $anterior = $request->anterior;
        $longi1 = sizeof($anterior);

        $nuevo = $request->nuevo;
        $longi2 = sizeof($nuevo);

        for($j =0; $j<$longi2; $j++){
            for($i =0; $i<$longi1; $i++){
                if($nuevo[$j]==$anterior[$i]){
                    $i=$longi1;
                }else{
                    if($i==($longi1-1)){
                        $asignarRol = new RolUsuario();
                        $asignarRol->Rol_Id_R=$nuevo[$j];
                        $asignarRol->rol_usuario_Codigo_SIS_U=$request->Codigo_SIS_U;
                        $asignarRol->habilitado_R_U =1;
                        $asignarRol->fecha_inicio_R_U =now();
                        $asignarRol->save();
                    }
                }
            }
        }

        for($i =0; $i<$longi1; $i++){
            for($j =0; $j<$longi2; $j++){
                if($anterior[$i]==$nuevo[$j]){
                    $j = $longi2;
                }else{
                    if($j==($longi2-1)){
                        $desasignarRol = \DB::table('rol_usuario')
                        ->where('rol_usuario_Codigo_SIS_U','=',$request->Codigo_SIS_U)
                        ->where('Rol_Id_R','=',$anterior[$i])
                        ->where('habilitado_R_U','=',1)
                        ->update(['habilitado_R_U'=>0,'fecha_fin_R_U'=>now()]);
                    }
                }
            }

        }
    }
}
