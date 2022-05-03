<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\listarMateriaController;
use App\Http\Controllers\solicitudController;
use App\Http\Controllers\docenteController;
use App\Http\Controllers\AutenticarController;
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
    Route::get('/listarTodas',[listarMateriaController::class,'listarTodo']);
    Route::get('/listarPendientes',[listarMateriaController::class,'listarPendientes']);
    Route::get('/listarUrgencia',[listarMateriaController::class,'listarUrgencia']);

    Route::get('/materia',[solicitudController::class,'obtenerMaterias']);
    Route::get('/materias/{codSIS}',[solicitudController::class,'obtenerMateriasDocente']);
    Route::get('/grupos/{codSIS}/{sisMateria}',[solicitudController::class,'obtenerGrupos']);
    Route::get('/gruposCompartida/{codSIS}/{sisMateria}',[solicitudController::class,'obtenerGruposCompartidos']);

    Route::post('/reservaIndividual',[solicitudController::class,'reservaIndividual']);
    Route::post('/reservaCompartida',[solicitudController::class,'reservaCompartida']);

    Route::put('/desasignar/{codSIS}/{sisMateria}/{grupo}',[docenteController::class,'desasignar']);
    Route::get('/existe/{codSIS}/{contrasenia}',[docenteController::class,'existe']);
});



