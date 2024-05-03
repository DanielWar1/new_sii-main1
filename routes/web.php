<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Escolares\AlumnoController;
use App\Http\Controllers\Escolares\DocenteController;
use App\Http\Controllers\Escolares\PlanEstudioController;
use App\Models\Docente;
use App\Http\Controllers\Escolares\EdificioController;
use App\Models\Salones;
use App\Http\Controllers\Escolares\SalonesController;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/home', [HomeController::class, 'index'])->name('home');

//Grupo de rutas para Escolares
Route::get('/escolares/alumnos', [AlumnoController::class, 'index'])->name('escolaresAlumnos');
Route::get('/escolares/alumnos/alta', [AlumnoController::class, 'altaAlumno'])->name('escolaresAlumnosAlta');
Route::post('/escolares/alumnos/crear', [AlumnoController::class, 'crearAlumno'])->name('escolaresAlumnosCrear');

Route::group (['middleware' => ['role:escolares']], function (){
    Route::get('/escolares/planes_estudio', [PlanEstudioController::class, 'index'])->name('escolaresPlanesEstudio');
    Route::patch('/escolares/planes_estudio/editar/{id}', [PlanEstudioController::class, 'updatePlanEstudio'])->name('planEstudioUpdate');
    Route::delete('/escolares/planes_estudio/delete/{id}', [PlanEstudioController::class, 'deletePlanEstudio'])->name('PlanesEstudioEliminar');
    Route::post('/escolares/planes_estudio/create', [PlanEstudioController::class, 'createPlanEstudio'])->name('PlanesEstudioCrear');
    
    Route::get('/escolares/docentes', [DocenteController::class, 'getDocentes'])->name('Docentes');
    Route::patch('/escolares/Docentes/edit/{id}',[DocenteController::class, 'updateDocente'])->name('DocenteEditar');
    Route::post('/escolares/Docentes/create',[DocenteController::class, 'createDocente'])->name('DocenteCrear');
    Route::delete('/escolares/Docentes/delete/{id}',[DocenteController::class, 'deleteDocente'])->name('Docenteliminar');
    
    Route::get('/escolares/edificios', [EdificioController::class, 'getEdificios'])->name('Edificios');
    Route::patch('/escolares/edificios/edit/{id}',[EdificioController::class, 'updateEdificio'])->name('EdificioEditar');
    Route::post('/escolares/edificios/create',[EdificioController::class, 'createEdificio'])->name('EdificioCrear');
    Route::delete('/escolares/edificios/delete/{id}',[EdificioController::class, 'deleteEdificio'])->name('EdificioEliminar');

    Route::patch('/escolares/salones/edit/{id}',[SalonesController::class, 'updateSalones'])->name('SalonesEditar');
    Route::post('/escolares/salones/create',[SalonesController::class, 'createSalones'])->name('SalonesCrear');
    Route::delete('/escolares/salones/delete/{id}',[SalonesController::class, 'deleteSalones'])->name('SalonesEliminar');
    

});