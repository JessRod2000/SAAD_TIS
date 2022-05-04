<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SolicitudReserva;
use App\Models\UsuarioSolicitud;
use App\Models\GrupoSolicitudReserva;
use App\Models\User;
use App\Models\Materium;
use App\Models\UsuarioMaterium;

class solicitudController extends Controller
{
    public function obtenerMaterias(){
        return Materium::all();
    }

    public function obtenerGruposDocentes($codSIS){
        $grupos = \DB::table('usuario_materia')
        ->join('materia','SisM_M','=','materia_SisM_M')
        ->select('Grupo_UM','Nomb_M','SisM_M')
        ->where('usuario_Codigo_SIS_U','=',$codSIS)
        ->where('asignado_UM','=',1)
        ->get();

        return $grupos;
    }

    public function obtenerMateriasDocente($codSIS){
        $materias = \DB::table('usuario_materia')
        ->join('users','usuario_Codigo_SIS_U','=','Codigo_SIS_U')
        ->join('materia','SisM_M','=','materia_SisM_M')
        ->select('Nomb_M','SisM_M')
        ->distinct('Nomb_M','SisM_M') 
        ->where('Codigo_SIS_U','=',$codSIS)
        ->where('asignado_UM','=',1)
        ->get();
        
        return $materias;
    }

    public function obtenerGrupos($codSIS, $sisMateria){
        $grupos = \DB::table('usuario_materia')
        ->select('Grupo_UM')
        ->where('usuario_Codigo_SIS_U','=',$codSIS)
        ->where('materia_SisM_M','=',$sisMateria)
        ->where('asignado_UM','=',1)
        ->get();

        return $grupos;
    }

    public function obtenerGruposCompartidos($codSIS, $sisMateria){
        $grupos = \DB::table('usuario_materia')
        ->join('users','Codigo_SIS_U','=','usuario_Codigo_SIS_U')
        ->select('Grupo_UM','Nombre_U','Apelllido_Paterno_U','Apellido_Materno_U','Codigo_SIS_U')
        ->where('usuario_Codigo_SIS_U','<>',$codSIS)
        ->where('materia_SisM_M','=',$sisMateria)
        ->where('asignado_UM','=',1)
        ->get();

        return $grupos;
    }

    public function reservaIndividual(Request $request){
        $reserva = new SolicitudReserva();
        $usuarioSolicitud = new UsuarioSolicitud();
        
        $grupos = $request->grupos;

        $reserva->materia_SisM_M=$request->materia_SisM_M;
        $reserva->Fecha_SR = $request-> Fecha_SR;
        $reserva->Hora_Inicio_SR = $request-> Hora_Inicio_SR;
        $reserva->Cantidad_Periodos_SR = $request-> Cantidad_Periodos_SR;
        $reserva->Numero_Estudiantes_SR = $request-> Numero_Estudiantes_SR;
        $reserva->Estado_Atendido_SR = $request-> Estado_Atendido_SR;
        $reserva->Motivo_SR = $request-> Motivo_SR;
        $reserva->Hora_Final_SR = $request-> Hora_Final_SR;
        $reserva->Creado_en_SR = now();

        $reserva->save();

        $usuarioSolicitud->Id_SR_US = $reserva->id;
        $usuarioSolicitud->usuario_Codigo_SIS_U = $request->usuario_Codigo_SIS_U;

        $usuarioSolicitud->save();

        foreach($grupos as $gru){
            $grupo = new GrupoSolicitudReserva();

            $grupo->id_G = $gru;
            $grupo->solicitud_reserva_Id_SR = $reserva->id;
            $grupo->solicitud_reserva_materia_SisM_M = $request->materia_SisM_M;

            $response['grupo_solicitud_reserva']=$grupo;

            $grupo->save();
        }

        $response['solicitud_reserva']=$reserva;
        $response['usuario_solicitud']=$usuarioSolicitud;
        
        
        return $response;
    }

    public function reservaCompartida(Request $request){
        $reserva = new SolicitudReserva();
        
        $docentes = $request->docentes;
        $grupos = $request->grupos;

        $reserva->materia_SisM_M=$request->materia_SisM_M;
        $reserva->Fecha_SR = $request-> Fecha_SR;
        $reserva->Hora_Inicio_SR = $request-> Hora_Inicio_SR;
        $reserva->Cantidad_Periodos_SR = $request-> Cantidad_Periodos_SR;
        $reserva->Numero_Estudiantes_SR = $request-> Numero_Estudiantes_SR;
        $reserva->Estado_Atendido_SR = $request-> Estado_Atendido_SR;
        $reserva->Motivo_SR = $request-> Motivo_SR;
        $reserva->Hora_Final_SR = $request-> Hora_Final_SR;
        $reserva->Creado_en_SR = now();

        $reserva->save();

        foreach($docentes as $docen){

            $usuarioSolicitud = new UsuarioSolicitud();

            $usuarioSolicitud->Id_SR_US = $reserva->id;
            $usuarioSolicitud->usuario_Codigo_SIS_U = $docen;

            $usuarioSolicitud->save();
        }

        foreach($grupos as $gru){

            $grupo = new GrupoSolicitudReserva();

            $grupo->id_G = $gru;
            $grupo->solicitud_reserva_Id_SR = $reserva->id;
            $grupo->solicitud_reserva_materia_SisM_M = $request->materia_SisM_M;

            $grupo->save();
        }

        $response['solicitud_reserva']=$reserva;
        
        return $response;
    }
}
