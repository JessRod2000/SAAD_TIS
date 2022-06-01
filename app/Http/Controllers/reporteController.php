<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReporteReserva;
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
        $aceptar->usuario_Codigo_SIS_U = $request->codSIS;

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
        $rechazar->usuario_Codigo_SIS_U = $request->codSIS;

        $rechazar->save();

        $reserva = \DB::table('solicitud_reserva')
        ->where('Id_SR','=',$request->idReserva)
        ->update(['Estado_Atendido_SR'=>1]);
    }
}
