<?php

namespace App\Http\Controllers;
use App\Models\SolicitudReserva;
use Illuminate\Http\Request;
use App\Models\Aula;

class SugerenciaAulasController extends Controller
{
    //
  
     //obtener las aulas que tengan libre el dia de la reserva.
    public function listarHorariosAulas($dia){
       
       
        $aulas = \DB::table('aula')
        ->join('horario_libre','aula_Id_A','=','Id_A')
        ->where('dia_HL','=',$dia)
        ->get();
       
        

        return $aulas;
    }
    public function listarAulasEdificios($edificio){
       
       
        $aulas = \DB::table('aula')
         ->join('horario_libre','aula_Id_A','=','Id_A')
        ->where('Edificio_A','like',$edificio)
        ->get();
       
        

        return $aulas;
    }
    public function reservasAceptadas($fecha){
        $reservas = \DB::table('reporte_reserva_aula')
        ->join('aula','aula_Id_A','=','Id_A')
        ->where('Fecha_Reserva_Ocupado_RRA','=',$fecha)
        ->where('Estado_RRA','=',1)
        ->get();
        return $reservas;

    }

    
    //Mostrar reservas de un docente, pendientes = 0
    
    public function listarPendientesDoc($codSIS){
        $reservas = \DB::table('solicitud_reserva')
         ->join('materia', 'materia_Codigo_M','=','materia.Codigo_M')
         ->join('usuario_solicitud','solicitud_reserva_Id_SR','=','Id_SR')
        ->join('users','usuarios_Codigo_SIS_U','=','Codigo_SIS_U')
      
         ->select('Id_SR','Nombre_M', 'Id_G_US','Creado_en_SR', 'Hora_Inicio_SR','Id_SR')
         ->where('Codigo_SIS_U','=',$codSIS)
          ->where('Estado_Atendido_SR','=',0)
     
        ->orderBy('Creado_en_SR','ASC')
        ->get();
        return $reservas;
    }

    //reservas aceptadas del docente
    //0= rechazado
    //1= aceptado
    //2 = cancelado

  
    public function listarAceptadasDoc($codSIS)
    {
        $reservas = \DB::table('reporte_reserva')
        ->join('solicitud_reserva','reporte_reserva.solicitud_reserva_Id_SR','=','solicitud_reserva.Id_SR')
        ->join('usuario_solicitud','reporte_reserva.solicitud_reserva_Id_SR','=','usuario_solicitud.solicitud_reserva_Id_SR')
         ->join('materia', 'materia_Codigo_M','=','materia.Codigo_M')
    
       ->select('Id_SR','Nombre_M', 'Id_G_US','Fecha_SR','Hora_Inicio_SR','Hora_Final_SR', 'usuarios_Codigo_SIS_U')
        ->where('usuario_solicitud.usuarios_Codigo_SIS_U','=',$codSIS)
         ->where('Estado_RR','=',1)
        ->orderBy('Fecha_SR','ASC')
        ->get();
        return $reservas;
    }
    public function listarRechazadasDoc($codSIS)
    {
        $reservas = \DB::table('reporte_reserva')
        ->join('solicitud_reserva','reporte_reserva.solicitud_reserva_Id_SR','=','solicitud_reserva.Id_SR')
        ->join('usuario_solicitud','reporte_reserva.solicitud_reserva_Id_SR','=','usuario_solicitud.solicitud_reserva_Id_SR')
         ->join('materia', 'materia_Codigo_M','=','materia.Codigo_M')
    
       ->select('Id_SR','Nombre_M', 'Id_G_US','Fecha_SR','Hora_Inicio_SR','Hora_Final_SR', 'usuarios_Codigo_SIS_U', 'Fecha_Reporte_RR')
         ->where('usuario_solicitud.usuarios_Codigo_SIS_U','=',$codSIS)
         ->where('Estado_RR','=',0)
        ->orderBy('Fecha_SR','ASC')
        ->get();
        return $reservas;
    }

    public function listarAtendidas(){
        $reservas = \DB::table('solicitud_reserva')
         ->join('usuario_solicitud','Id_SR','=','solicitud_reserva_Id_SR')
         ->join('users','Codigo_SIS_U','=','usuarios_Codigo_SIS_U')
         ->join('materia','materia_Codigo_M','=','Codigo_M')
         ->select('Creado_en_SR','Id_SR','Nombre_M','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Fecha_SR','Hora_Inicio_SR','Id_G_US')
         ->where('Estado_Atendido_SR','=',1) 
         ->orderBy('Fecha_SR','ASC')
         ->get();

         return $reservas;
    }
}
