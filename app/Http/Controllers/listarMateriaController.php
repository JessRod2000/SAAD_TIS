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
        $reservas = \DB::table('solicitud_reserva')
         ->join('usuario_solicitud','Id_SR','=','solicitud_reserva_Id_SR')
         ->join('users','Codigo_SIS_U','=','usuarios_Codigo_SIS_U')
         ->join('materia','materia_Codigo_M','=','Codigo_M')
         ->select('Creado_en_SR','Id_SR','Nombre_M','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Fecha_SR','Hora_Inicio_SR','Estado_Atendido_SR')
         ->orderBy('Creado_en_SR','ASC')
         ->get();

         return $reservas;
    }

    public function listarPendientes(){
        $reservas = \DB::table('solicitud_reserva')
         ->join('usuario_solicitud','Id_SR','=','solicitud_reserva_Id_SR')
         ->join('users','Codigo_SIS_U','=','usuarios_Codigo_SIS_U')
         ->join('materia','materia_Codigo_M','=','Codigo_M')
         ->select('Creado_en_SR','Id_SR','Nombre_M','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Fecha_SR','Hora_Inicio_SR')
         ->where('Fecha_SR','>',now())
         ->where('Estado_Atendido_SR','=',0)
         ->orderBy('Creado_en_SR','ASC')
         ->get();

         return $reservas;
    }

    public function listarUrgencia(){
        $reservas = \DB::table('solicitud_reserva')
         ->join('usuario_solicitud','Id_SR','=','solicitud_reserva_Id_SR')
         ->join('users','Codigo_SIS_U','=','usuarios_Codigo_SIS_U')
         ->join('materia','materia_Codigo_M','=','Codigo_M')
         ->select('Creado_en_SR','Id_SR','Nombre_M','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Fecha_SR','Hora_Inicio_SR')
         ->where('Fecha_SR','>',now())
         ->where('Estado_Atendido_SR','=',0) 
         ->orderBy('Fecha_SR','ASC')
         ->get();

         return $reservas;
    }
}
