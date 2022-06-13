<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReporteReserva;
use App\Models\Notificacion;
use App\Models\ReporteReservaAula;

class reporteController extends Controller
{
    public function aceptarSolicitud(Request $request){
        $aceptar = new ReporteReserva();
        
        $aulas = $request->aulas;

        $longitud = sizeof($aulas);

        $aceptar->Estado_RR = 1;
        $aceptar->Observacion_RR = $request->observacion;
        $aceptar->Fecha_Reporte_RR = now();
        $aceptar->solicitud_reserva_Id_SR = $request->idReserva;
        $aceptar->usuarios_Codigo_SIS_U = $request->codSIS;

        $aceptar->save();

        for ($i = 0; $i < $longitud; $i++) {
            $aulaReporte = new ReporteReservaAula();

            $aulaReporte->reporte_reserva_Id_RR = $aceptar->Id_RR;
            $aulaReporte->aula_Id_A = $aulas[$i];
            $aulaReporte->Fecha_Reserva_Ocupado_RRA = $request->fechaReserva;
            $aulaReporte->Horario_Ocupado_Inicio_RRA = $request->horaInicio;
            $aulaReporte->Periodos_RRA = $request->periodos;
            $aulaReporte->Estado_RRA = 1;

            $aulaReporte->save();
        }


        $docentesdatos = \DB::table('usuario_solicitud')
        ->select('usuarios_Codigo_SIS_U')
        ->where('solicitud_reserva_Id_SR','=',$request->idReserva)
        ->get();

        foreach( $docentesdatos as $docente){
            $nuevanotificacion = new Notificacion();

            $nuevanotificacion->Estado_N = 0;
            $nuevanotificacion->usuario_Codigo_SIS_U = $docente->usuarios_Codigo_SIS_U;
            $nuevanotificacion->reporte_reserva_Id_RR = $aceptar->Id_RR;
            $nuevanotificacion->save();
        
        }

        $reserva = \DB::table('solicitud_reserva')
        ->where('Id_SR','=',$request->idReserva)
        ->update(['Estado_Atendido_SR'=>1]);

        $response['solicitud_aceptar']=$aceptar;
        
        return $response;

    }

    public function rechazarSolicitud(Request $request){
        $rechazar = new ReporteReserva();

        $rechazar->Estado_RR = 0;
        $rechazar->Observacion_RR = $request->observacion;
        $rechazar->Fecha_Reporte_RR = now();
        $rechazar->solicitud_reserva_Id_SR = $request->idReserva;
        $rechazar->usuarios_Codigo_SIS_U = $request->codSIS;

        $rechazar->save();


       
        $docentesdatos = \DB::table('usuario_solicitud')
        ->select('usuarios_Codigo_SIS_U')
        ->where('solicitud_reserva_Id_SR','=',$request->idReserva)
        ->get();

        foreach( $docentesdatos as $docente){
            $nuevanotificacion = new Notificacion();

            $nuevanotificacion->Estado_N = 0;
            $nuevanotificacion->usuario_Codigo_SIS_U = $docente->usuarios_Codigo_SIS_U;
            $nuevanotificacion->reporte_reserva_Id_RR = $rechazar->Id_RR;
            $nuevanotificacion->save();
        
        }
      
     
        $reserva = \DB::table('solicitud_reserva')
        ->where('Id_SR','=',$request->idReserva)
        ->update(['Estado_Atendido_SR'=>1]);

        $response['solicitud_rechazar']=$rechazar;
        
        return $rechazar;

    }

    public function verNotificaciones (Request $request){
        //modificar todas las notificaciones de un docente iddocente, con estado igual a visto
        $notificaciones = \DB::table('notificacion')
        ->where('usuario_Codigo_SIS_U','=',$request->idDocente)
        ->update(['Estado_N'=>1]);
    }

    public function notificacionesDocNuevas($idDocente){
        //dar las notificaciones del docente no vistas//
        $notificaciones = \DB::table('notificacion')
        ->join('reporte_reserva','reporte_reserva_Id_RR','=','reporte_reserva.Id_RR')
        ->join('solicitud_reserva','solicitud_reserva_Id_SR','=','Id_SR')
        ->join('materia', 'materia_Codigo_M','=','Codigo_M')
        ->join('users', 'reporte_reserva.usuarios_Codigo_SIS_U','=','users.Codigo_SIS_U')
        ->distinct()
        ->select('Fecha_Reporte_RR', 'solicitud_reserva_Id_SR', 'Estado_RR','Observacion_RR', 'Nombre_M', 'Nombre_U','Apellido_Paterno_U','Apellido_Materno_U')
        ->where('notificacion.usuario_Codigo_SIS_U','=',$idDocente)
        ->where('Estado_N','=',0)
        ->get();
        return $notificaciones;

    }
    public function notificacionesDocViejas($idDocente){
        $notificaciones = \DB::table('notificacion')
        ->join('reporte_reserva','reporte_reserva_Id_RR','=','reporte_reserva.Id_RR')
        ->join('solicitud_reserva','solicitud_reserva_Id_SR','=','Id_SR')
        ->join('materia', 'materia_Codigo_M','=','Codigo_M')
        ->join('users', 'reporte_reserva.usuarios_Codigo_SIS_U','=','users.Codigo_SIS_U')
        ->distinct()
        ->select('Fecha_Reporte_RR', 'solicitud_reserva_Id_SR', 'Estado_RR','Observacion_RR', 'Nombre_M', 'Nombre_U','Apellido_Paterno_U','Apellido_Materno_U')
        ->where('notificacion.usuario_Codigo_SIS_U','=',$idDocente)
        ->where('Estado_N','=',1)
        ->orderBy('Fecha_Reporte_RR','DESC')
        ->take(5)
        ->get();
        return $notificaciones;
    }


}
