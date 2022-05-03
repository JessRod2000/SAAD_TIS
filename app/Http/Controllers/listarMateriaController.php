<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SolicitudReserva;
use App\Models\UsuarioSolicitud;
use App\Models\User;
use App\Models\Materium;

class listarMateriaController extends Controller
{
    public function listarTodo(){
        $reservas = \DB::table('solicitud_reserva')
         ->join('usuario_solicitud','Id_SR','=','Id_SR_US')
         ->join('users','Codigo_SIS_U','=','usuario_Codigo_SIS_U')
         ->join('materia','materia_SisM_M','=','SisM_M')
         ->select('Id_SR','Nomb_M','Nombre_U','Apelllido_Paterno_U','Apellido_Materno_U','Fecha_SR','Hora_Inicio_SR','Estado_Atendido_SR')
         ->get();

         return $reservas;
    }

    public function listarPendientes(){
        $reservas = \DB::table('solicitud_reserva')
         ->join('usuario_solicitud','Id_SR','=','Id_SR_US')
         ->join('users','Codigo_SIS_U','=','usuario_Codigo_SIS_U')
         ->join('materia','materia_SisM_M','=','SisM_M')
         ->select('Id_SR','Nomb_M','Nombre_U','Apelllido_Paterno_U','Apellido_Materno_U','Fecha_SR','Hora_Inicio_SR')
         ->where('Fecha_SR','>',now())
         ->where('Estado_Atendido_SR','=',0)
         ->orderBy('Creado_en_SR','ASC')
         ->get();

         return $reservas;
    }

    public function listarUrgencia(){
        $reservas = \DB::table('solicitud_reserva')
         ->join('usuario_solicitud','Id_SR','=','Id_SR_US')
         ->join('users','Codigo_SIS_U','=','usuario_Codigo_SIS_U')
         ->join('materia','materia_SisM_M','=','SisM_M')
         ->select('Id_SR','Nomb_M','Nombre_U','Apelllido_Paterno_U','Apellido_Materno_U','Fecha_SR','Hora_Inicio_SR')
         ->where('Fecha_SR','>',now())
         ->where('Estado_Atendido_SR','=',0) 
         ->orderBy('Fecha_SR','ASC')
         ->get();

         return $reservas;
    }
}
