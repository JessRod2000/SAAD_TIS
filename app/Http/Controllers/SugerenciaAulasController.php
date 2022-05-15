<?php

namespace App\Http\Controllers;
use App\Models\SolicitudReserva;
use Illuminate\Http\Request;
use App\Models\Aula;

class SugerenciaAulasController extends Controller
{
    //
   
    public function detalleReserva($idReserva){
       
        $reserva = new SolicitudReserva();
        $reserva = \DB::table('solicitud_reserva')
        ->where('Id_SR','=',$idReserva)
        ->get();
        $hora = $reserva->Hora_Inicio_SR;

        

        return $hora;
    }
     //obtener las aulas que tengan libre el dia de la reserva.
    public function listarHorariosAulas($dia){
       
       
        $aulas = \DB::table('aula')
        ->join('horario_libre','aula_Id_A','=','Id_A')
        ->where('dia_HL','=',$dia)
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
        ->select('Nombre_M', 'Id_Grupo_GSR','Creado_en_SR', 'Hora_Inicio_SR','Id_SR')
        ->join('grupo_solicitud_reserva','Id_SR','=','grupo_solicitud_reserva.solicitud_reserva_Id_SR')
        ->where('Codigo_SIS_U','=',$codSIS)
        ->where('Estado_Atendido_SR','=',0)
        ->where('Creado_en_SR','>',now())
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
        ->join('solicitud_reserva','solicitud_reserva_Id_SR','=','Id_SR')
        ->join('materia', 'materia_Codigo_M','=','materia.Codigo_M')
        ->join('usuario_solicitud','usuario_solicitud.solicitud_reserva_Id_SR','=','solicitud_reserva.Id_SR')
        ->select('Nombre_M', 'Fecha_SR','Hora_Inicio_SR','Hora_Final_SR')
        ->where('usuarios_Codigo_SIS_U','=',$codSIS)
        ->where('Estado_RR','=',1)
        ->where('Fecha_SR','>',now())
        ->orderBy('Fecha_SR','ASC')
        ->get();
        return $reservas;
    }
}