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
Route::get('/', function () {
    return view('welcome');
});

Route::resource('alumno',AlumnoController::class);
Route::get('formulario',[AlumnoController::class, 'formulario'])->name('alumno.formulario');
Route::get('busqueda',[AlumnoController::class, 'busqueda'])->name('alumno.busqueda');