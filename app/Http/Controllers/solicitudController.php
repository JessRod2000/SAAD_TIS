<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\administradorController;
use Illuminate\Http\Request;
use App\Models\SolicitudReserva;
use App\Models\UsuarioSolicitud;
use App\Models\GrupoSolicitudReserva;
use App\Models\User;
use App\Models\Materium;
use App\Models\UsuarioMaterium;
use App\Models\ReporteReserva;
use App\Models\ReporteReservaAula;

class solicitudController extends Controller
{
    public function obtenerMaterias(){
        $docentes = [199800245,199901652,199901652,200000459];
        $longitud = sizeof($docentes);
        return $longitud;
        //return Materium::all();
    }

    public function obtenerGruposDocentes($codSIS){
        $grupos = \DB::table('usuario_materia')
        ->join('materia','Codigo_M','=','materia_Codigo_M')
        ->select('Grupo_UM','Nombre_M','Codigo_M')
        ->where('usuario_Codigo_SIS_U','=',$codSIS)
        ->where('asignado_UM','=',1)
        ->get();

        return $grupos;
    }

    public function obtenerMateriasDocente($codSIS){
        $materias = \DB::table('usuario_materia')
        ->join('users','usuario_Codigo_SIS_U','=','Codigo_SIS_U')
        ->join('materia','Codigo_M','=','materia_Codigo_M')
        ->select('Nombre_M','Codigo_M')
        ->distinct('Nombre_M','Codigo_M') 
        ->where('Codigo_SIS_U','=',$codSIS)
        ->where('asignado_UM','=',1)
        ->get();
        
        return $materias;
    }

    public function obtenerGrupos($codSIS, $sisMateria){
        $grupos = \DB::table('usuario_materia')
        ->select('Grupo_UM')
        ->where('usuario_Codigo_SIS_U','=',$codSIS)
        ->where('materia_Codigo_M','=',$sisMateria)
        ->where('asignado_UM','=',1)
        ->get();

        return $grupos;
    }

    public function obtenerGruposCompartidos($codSIS, $sisMateria){
        $grupos = \DB::table('usuario_materia')
        ->join('users','Codigo_SIS_U','=','usuario_Codigo_SIS_U')
        ->select('Grupo_UM','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Codigo_SIS_U')
        ->where('usuario_Codigo_SIS_U','<>',$codSIS)
        ->where('materia_Codigo_M','=',$sisMateria)
        ->where('asignado_UM','=',1)
        ->get();

        return $grupos;
    }

    public function detalleReserva($idReserva){
        $detalle = \DB::table('solicitud_reserva')
        ->join('materia','materia_Codigo_M','=','Codigo_M')
        ->where('Id_SR','=',$idReserva)
        ->get();

        $grupos = \DB::table('solicitud_reserva')
        ->join('usuario_solicitud','Id_SR','=','solicitud_reserva_Id_SR')
        ->join('users','Codigo_SIS_U','=','usuarios_Codigo_SIS_U')
        ->join('materia','materia_Codigo_M','=','Codigo_M')
        ->select('Id_G_US','Codigo_M','Nombre_M','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Codigo_SIS_U')
        ->where('Id_SR','=',$idReserva)
        ->get();
        $respuesta['detalle']=$detalle;
        $respuesta['grupos']=$grupos;

        return $respuesta;
    }

    public function detalleReservaAtendida($idReserva){
        $detalle = \DB::table('solicitud_reserva')
        ->join('materia','materia_Codigo_M','=','Codigo_M')
        ->join('reporte_reserva','solicitud_reserva_Id_SR','=','Id_SR')
        ->join('users','Codigo_SIS_U','=','usuarios_Codigo_SIS_U')
        ->select('Id_RR','Estado_RR','Observacion_RR','Fecha_Reporte_RR','usuarios_Codigo_SIS_U','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Correo_U')
        ->where('Id_SR','=',$idReserva)
        ->get();

        $aulas = \DB::table('reporte_reserva') 
        ->join('reporte_reserva_aula','reporte_reserva_Id_RR','=','Id_RR')
        ->join('aula','Id_A','=','aula_Id_A')
        ->select('Id_A','Capacidad_A','Edificio_A')
        ->where('solicitud_reserva_Id_SR','=',$idReserva)
        ->get();

        $respuesta['detalle']=$detalle;
        $respuesta['aulas']=$aulas;

        return $respuesta;
    }

    public function cancelarPendiente($idReserva){
        $reserva = \DB::table('solicitud_reserva')
        ->where('Id_SR','=',$idReserva)
        ->update(['Estado_Atendido_SR'=>2]);
    }

    public function cancelarAceptada($idReporte){
        $reserva = \DB::table('reporte_reserva')
        ->where('Id_RR','=',$idReporte)
        ->update(['Estado_RR'=>2]);

        $aula = \DB::table('reporte_reserva')
        ->join('reporte_reserva_aula','reporte_reserva_Id_RR','=','Id_RR')
        ->where('Id_RR','=',$idReporte)
        ->update(['Estado_RRA'=>2]);
    }

    public function obtenerPeriodoAcademico(){
        $periodo = \DB::table('periodo_academico')
        ->orderBy('Id_PA','DESC')
        ->first();

        return $periodo;
    }


    public function reservaCompartida(Request $request){
        $periodo = \DB::table('periodo_academico')
        ->select('Id_PA')
        ->orderBy('Id_PA','DESC')
        ->first();

        $reserva = new SolicitudReserva();
        
        $docentes = $request->docentes;
        $grupos = $request->grupos;

        $longitud = sizeof($grupos);

        $reserva->materia_Codigo_M=$request->materia_SisM_M;
        $reserva->Fecha_SR = $request-> Fecha_SR;
        $reserva->Hora_Inicio_SR = $request-> Hora_Inicio_SR;
        $reserva->Cantidad_Periodos_SR = $request-> Cantidad_Periodos_SR;
        $reserva->Numero_Estudiantes_SR = $request-> Numero_Estudiantes_SR;
        $reserva->Estado_Atendido_SR = $request-> Estado_Atendido_SR;
        $reserva->Motivo_SR = $request-> Motivo_SR;
        $reserva->Hora_Final_SR = $request-> Hora_Final_SR;
        $reserva->Creado_en_SR = now();
        $reserva->periodo_academico_Id_PA = $periodo->Id_PA;

        $reserva->save();

        for ($i = 0; $i < $longitud; $i++) {
            $usuarioSolicitud = new UsuarioSolicitud();

            $usuarioSolicitud->solicitud_reserva_Id_SR = $reserva->Id_SR;
            $usuarioSolicitud->usuarios_Codigo_SIS_U = $docentes[$i];
            $usuarioSolicitud->Id_G_US = $grupos[$i];
            $usuarioSolicitud->save();
        }

        $response['solicitud_reserva']=$reserva;
        
        return $response;
    }
}
