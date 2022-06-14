<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SolicitudReserva;
use App\Models\User;
use App\Models\Materium;

class listarMateriaController extends Controller
{
    public function listarTodo(){
        $periodo = \DB::table('periodo_academico')
        ->orderBy('Id_PA', 'DESC')
        ->first();
       
        $from1 = $periodo->Fecha_Inicio_PA;
        $from2 = $periodo->Fecha_Fin_PA;


        $reservas = \DB::table('solicitud_reserva')
         ->join('usuario_solicitud','Id_SR','=','solicitud_reserva_Id_SR')
         ->join('users','Codigo_SIS_U','=','usuarios_Codigo_SIS_U')
         ->join('materia','materia_Codigo_M','=','Codigo_M')
         ->select('Creado_en_SR','Id_SR','Nombre_M','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Fecha_SR','Hora_Inicio_SR','Estado_Atendido_SR')
         ->whereBetween('Creado_en_SR',[$from1, $from2])
         ->orderBy('Creado_en_SR','ASC')
         ->get();

         return $reservas;
    }

    public function listarPendientes(){

        $periodo = \DB::table('periodo_academico')
        ->orderBy('Id_PA', 'DESC')
        ->first();
       
        $from1 = $periodo->Fecha_Inicio_PA;
        $from2 = $periodo->Fecha_Fin_PA;


        $reservas = \DB::table('solicitud_reserva')
         ->join('usuario_solicitud','Id_SR','=','solicitud_reserva_Id_SR')
         ->join('users','Codigo_SIS_U','=','usuarios_Codigo_SIS_U')
         ->join('materia','materia_Codigo_M','=','Codigo_M')
         ->select('Creado_en_SR','Id_SR','Nombre_M','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Fecha_SR','Hora_Inicio_SR')
         ->where('Fecha_SR','>',now())
         ->where('Estado_Atendido_SR','=',0)
         ->whereBetween('Creado_en_SR',[$from1, $from2])
         ->orderBy('Creado_en_SR','ASC')
         ->get();

         return $reservas;
    }

    public function listarUrgencia(){

        $periodo = \DB::table('periodo_academico')
        ->orderBy('Id_PA', 'DESC')
        ->first();
       
        $from1 = $periodo->Fecha_Inicio_PA;
        $from2 = $periodo->Fecha_Fin_PA;


        $reservas = \DB::table('solicitud_reserva')
         ->join('usuario_solicitud','Id_SR','=','solicitud_reserva_Id_SR')
         ->join('users','Codigo_SIS_U','=','usuarios_Codigo_SIS_U')
         ->join('materia','materia_Codigo_M','=','Codigo_M')
         ->select('Creado_en_SR','Id_SR','Nombre_M','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Fecha_SR','Hora_Inicio_SR')
         ->where('Fecha_SR','>',now())
         ->where('Estado_Atendido_SR','=',0) 
         ->whereBetween('Creado_en_SR',[$from1, $from2])
         ->orderBy('Fecha_SR','ASC')
         ->get();

         return $reservas;
    }
  
    
}
