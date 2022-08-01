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
use App\Http\Controllers\HomeController;
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

Route::resource('provincia',ProvinciaController::class);
Route::get('busquedaProvincia',[ProvinciaController::class, 'busqueda'])->name('provincia.busqueda');

Route::resource('localidad',LocalidadController::class);
Route::get('busquedaLocalidad',[LocalidadController::class, 'busqueda'])->name('localidad.busqueda');

/* AjaxController */
Route::get('getProvincias',[AjaxController::class, 'getProvincias'])->name('ajax.getProvincias');

Route::get('getLocalidades',[AjaxController::class, 'getLocalidades'])->name('ajax.getLocalidades');
Route::post('store',[AjaxController::class, 'store'])->name('ajax.store');

/*Cliente */
Route::get('success',[HomeController::class, 'mensaje'])->name('home.mensaje');