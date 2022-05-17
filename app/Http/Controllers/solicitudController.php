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
        $reserva = \DB::table('solicitud_reserva')
        ->where('Id_SR','=',$idReserva)
        ->get();

        $grupos = \DB::table('solicitud_reserva')
        ->join('grupo_solicitud_reserva','solicitud_reserva_Id_SR','=','Id_SR')
        ->select('Id_Grupo_GSR','materia_Codigo_M')
        ->where('Id_SR','=',$idReserva)
        ->get();
/*
        $docentes = \DB::table('solicitud_reserva')
        ->join('usuario_solicitud','Id_SR','=','solicitud_reserva_Id_SR')
        ->join('users','Codigo_SIS_U','=','usuarios_Codigo_SIS_U')
        ->join('usuario_materia','usuario_Codigo_SIS_U','=','usuarios_Codigo_SIS_U')
        ->select('Grupo_UM','Nombre_U','Apellido_Paterno_U','Apellido_Materno_U','Codigo_SIS_U')
        ->where('Id_SR','=',$idReserva)
        ->get();
*/
        $respuesta['reserva']= $reserva;
        $respuesta['grupos']= $grupos;
        
        foreach($grupos as $gru){
            $docente = \DB::table('usuario_materia')
            ->join('users','Codigo_SIS_U','=','usuario_Codigo_SIS_U')
            ->select('Grupo_UM','Codigo_SIS_U','Nombre_U')
            ->where('materia_Codigo_M','=',$gru->materia_Codigo_M)
            ->where('Grupo_UM','=',$gru->Id_Grupo_GSR)
            ->get();
            $respuesta[$gru->Id_Grupo_GSR]=$docente;
        }
        
        //$respuesta['docente']=+$docente;
        //$respuesta['docentes']=$docentes;

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

    public function reservaIndividual(Request $request){
        $reserva = new SolicitudReserva();
        $usuarioSolicitud = new UsuarioSolicitud();
        
        $grupos = $request->grupos;

        $reserva->materia_Codigo_M=$request->materia_SisM_M;
        $reserva->Fecha_SR = $request-> Fecha_SR;
        $reserva->Hora_Inicio_SR = $request-> Hora_Inicio_SR;
        $reserva->Cantidad_Periodos_SR = $request-> Cantidad_Periodos_SR;
        $reserva->Numero_Estudiantes_SR = $request-> Numero_Estudiantes_SR;
        $reserva->Estado_Atendido_SR = $request-> Estado_Atendido_SR;
        $reserva->Motivo_SR = $request-> Motivo_SR;
        $reserva->Hora_Final_SR = $request-> Hora_Final_SR;
        $reserva->Creado_en_SR = now();

        $reserva->save();
        return $reserva;
        $usuarioSolicitud->solicitud_reserva_Id_SR = $reserva->Id_SR;
        $usuarioSolicitud->usuarios_Codigo_SIS_U = $request->usuario_Codigo_SIS_U;

        $usuarioSolicitud->save();

        foreach($grupos as $gru){
            $grupo = new GrupoSolicitudReserva();

            $grupo->Id_Grupo_GSR= $gru;
            $grupo->solicitud_reserva_Id_SR = $reserva->Id_SR;
            //$grupo->solicitud_reserva_materia_SisM_M = $request->materia_SisM_M;

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

        $reserva->materia_Codigo_M=$request->materia_SisM_M;
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

            $usuarioSolicitud->solicitud_reserva_Id_SR = $reserva->Id_SR;
            $usuarioSolicitud->usuarios_Codigo_SIS_U = $docen;
            $usuarioSolicitud->save();
        }

        foreach($grupos as $gru){

            $grupo = new GrupoSolicitudReserva();

            $grupo->Id_Grupo_GSR = $gru;
            $grupo->solicitud_reserva_Id_SR = $reserva->Id_SR;
            //$grupo->solicitud_reserva_materia_Codigo_M = $request->materia_Codigo_M;

            $grupo->save();
        }

        $response['solicitud_reserva']=$reserva;
        
        return $response;
    }
}
