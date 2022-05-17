<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\listarMateriaController;
use App\Http\Controllers\solicitudController;
use App\Http\Controllers\docenteController;
use App\Http\Controllers\AutenticarController;
use App\Http\Controllers\SugerenciaAulasController;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('registro', [AutenticarController::class,'registro']);

Route::post('acceso', [AutenticarController::class,'acceso']);


Route::group(['middleware' => ['auth:sanctum']], function(){
    //Rutas de acceso y control de usuarios
    Route::post('cerrarsesion', [AutenticarController::class,'cerrarSesion']);
    Route::get('users', [AutenticarController::class,'index']);

   //Routas de gestion de reservas y docentes
    Route::get('/docentesDeReserva/{idReserva}',[listarMateriaController::class,'docentesDeReserva']);
    Route::get('/listarTodas',[listarMateriaController::class,'listarTodo']);
    Route::get('/listarPendientes',[listarMateriaController::class,'listarPendientes']);
    Route::get('/listarUrgencia',[listarMateriaController::class,'listarUrgencia']);

    Route::get('/listarMaterias',[solicitudController::class,'obtenerMaterias']);
    Route::get('/materias/{codSIS}',[solicitudController::class,'obtenerMateriasDocente']);
    Route::get('/grupos/{codSIS}/{sisMateria}',[solicitudController::class,'obtenerGrupos']);
    Route::get('/gruposCompartida/{codSIS}/{sisMateria}',[solicitudController::class,'obtenerGruposCompartidos']);
    Route::get('/obtenerGruposDocentes/{codSIS}',[solicitudController::class,'obtenerGruposDocentes']);
 
    Route::post('/reservaIndividual',[solicitudController::class,'reservaIndividual']);
    Route::post('/reservaCompartida',[solicitudController::class,'reservaCompartida']);
    
    Route::patch('/cancelarAceptada/{idReporte}',[solicitudController::class,'cancelarAceptada']);
    Route::patch('/cancelarPendiente/{idReserva}',[solicitudController::class,'cancelarPendiente']);
    Route::get('/detalleReserva/{idReserva}',[solicitudController::class,'detalleReserva']);

//para borrar---------------------
    Route::get('/index',[docenteController::class,'index']);
//--------------------------------
    Route::get('/gruposMateria/{sisMateria}',[docenteController::class,'gruposMateria']);
    Route::get('/listarGruposMateria/{sisMateria}',[docenteController::class,'listarGruposMateria']);
    
    Route::get('/gruposParaAsignar',[docenteController::class,'gruposParaAsignar']);
    Route::patch('/asignar/{codSIS}/{sisMateria}/{grupo}',[docenteController::class,'asignar']);
    Route::patch('/desasignar/{codSIS}/{sisMateria}/{grupo}',[docenteController::class,'desasignar']);
    //Route::get('/existe/{codSIS}/{contrasenia}',[docenteController::class,'existe']);
    Route::get('/listarDocente',[docenteController::class,'listarDocentes']);
    Route::get('/obtenerDocente/{codSIS}',[docenteController::class,'obtenerDocente']);

    Route::get('/listarHorariosAulas/{dia}',[SugerenciaAulasController::class,'listarHorariosAulas']);
    Route::get('/reservasAceptadas/{fecha}',[SugerenciaAulasController::class,'reservasAceptadas']);
    
    Route::get('/listarPendientesDoc/{codigoSIS}',[SugerenciaAulasController::class,'listarPendientesDoc']);
    Route::get('/listarAceptadasDoc/{codigoSIS}',[SugerenciaAulasController::class,'listarAceptadasDoc']);
    
   
});
