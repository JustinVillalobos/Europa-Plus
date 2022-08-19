<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlojamientosController;
use App\Http\Controllers\SuplementosController;
use App\Http\Controllers\EscuelasController;
use App\Http\Controllers\AjaxController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('alumno',AlumnoController::class);
Route::get('formulario',[AlumnoController::class, 'formulario'])->name('alumno.formulario');
Route::get('busqueda',[AlumnoController::class, 'busqueda'])->name('alumno.busqueda');
Route::post('alumno/store',[AlumnoController::class, 'store'])->name('alumno.store');
Route::post('alumno/update',[AlumnoController::class, 'update'])->name('alumno.update');
Route::post('alumno/destroy',[AlumnoController::class, 'destroy'])->name('alumno.destroy');
Route::post('alumno/updateEstado',[AlumnoController::class, 'updateEstado'])->name('alumno.updateEstado');


Route::resource('pais',PaisController::class);
Route::get('busquedaPais',[PaisController::class, 'busqueda'])->name('pais.busqueda');
Route::post('pais/store',[PaisController::class, 'store'])->name('pais.store');
Route::post('pais/update',[PaisController::class, 'update'])->name('pais.update');
Route::post('pais/destroy',[PaisController::class, 'destroy'])->name('pais.destroy');

Route::resource('provincia',ProvinciaController::class);
Route::get('busquedaProvincia',[ProvinciaController::class, 'busqueda'])->name('provincia.busqueda');
Route::post('provincia/store',[ProvinciaController::class, 'store'])->name('provincia.store');
Route::post('provincia/update',[ProvinciaController::class, 'update'])->name('provincia.update');
Route::post('provincia/destroy',[ProvinciaController::class, 'destroy'])->name('provincia.destroy');

Route::resource('localidad',LocalidadController::class);
Route::get('busquedaLocalidad',[LocalidadController::class, 'busqueda'])->name('localidad.busqueda');
Route::post('localidad/store',[LocalidadController::class, 'store'])->name('localidad.store');
Route::post('localidad/update',[LocalidadController::class, 'update'])->name('localidad.update');
Route::post('localidad/destroy',[LocalidadController::class, 'destroy'])->name('localidad.destroy');

Route::resource('curso',CursosController::class);
Route::get('busquedaCurso',[CursosController::class, 'busqueda'])->name('curso.busqueda');
Route::post('curso/store',[CursosController::class, 'store'])->name('curso.store');
Route::post('curso/update',[CursosController::class, 'update'])->name('curso.update');
Route::post('curso/destroy',[CursosController::class, 'destroy'])->name('curso.destroy');

//AlojamientosController
Route::resource('alojamientos',AlojamientosController::class);
Route::get('busquedaAlojamientos',[AlojamientosController::class, 'busqueda'])->name('alojamientos.busqueda');
Route::post('alojamientos/store',[AlojamientosController::class, 'store'])->name('alojamientos.store');
Route::post('alojamientos/update',[AlojamientosController::class, 'update'])->name('alojamientos.update');
Route::post('alojamientos/destroy',[AlojamientosController::class, 'destroy'])->name('alojamientos.destroy');

//EscuelasController
Route::resource('escuelas',EscuelasController::class);
Route::get('busquedaEscuelas',[EscuelasController::class, 'busqueda'])->name('escuelas.busqueda');
Route::post('escuelas/store',[EscuelasController::class, 'store'])->name('escuelas.store');
Route::post('escuelas/update',[EscuelasController::class, 'update'])->name('escuelas.update');
Route::post('escuelas/destroy',[EscuelasController::class, 'destroy'])->name('escuelas.destroy');


//Suplementos
Route::resource('suplementos',SuplementosController::class);


/* AjaxController */
Route::get('getProvincias',[AjaxController::class, 'getProvincias'])->name('ajax.getProvincias');

Route::get('getLocalidades',[AjaxController::class, 'getLocalidades'])->name('ajax.getLocalidades');
Route::post('store',[AjaxController::class, 'store'])->name('ajax.store');

/*Cliente */
Route::get('success',[HomeController::class, 'mensaje'])->name('home.mensaje');