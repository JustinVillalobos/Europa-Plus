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
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginAlumnoController;
use App\Http\Controllers\OperacionController;
use App\Http\Controllers\ConfirmacionesController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\CobrosController;
use App\Http\Controllers\EuropaPlusController;
use App\Http\Controllers\FormularioController;

Route::resource('operacion',OperacionController::class);
Route::get('busquedaOperacion',[OperacionController::class, 'busquedaOperacion'])->name('operacion.busquedaOperacion');
Route::post('create',[OperacionController::class, 'create'])->name('operacion.create');
Route::post('operacion/edit',[OperacionController::class, 'edit'])->name('operacion.edit');
Route::get('operacion/edits/{opr_id}',[OperacionController::class, 'edits'])->name('operacion.edits');
Route::get('vuelo/{opr_id}',[OperacionController::class, 'vuelo'])->name('operacion.vuelo');
Route::get('curso_operacion/{opr_id}',[OperacionController::class, 'curso_operacion'])->name('operacion.curso_operacion');

Route::get('transfer/{opr_id}',[OperacionController::class, 'transfer'])->name('operacion.transfer');
Route::post('operacion/store',[OperacionController::class, 'store'])->name('operacion.store');
Route::post('operacion/update',[OperacionController::class, 'update'])->name('operacion.update');
Route::post('operacion/destroy',[OperacionController::class, 'destroy'])->name('operacion.destroy');
Route::post('operacion/cursoSave',[OperacionController::class, 'cursoSave'])->name('operacion.cursoSave');
Route::post('operacion/vueloSave',[OperacionController::class, 'vueloSave'])->name('operacion.vueloSave');
Route::post('operacion/transferSave',[OperacionController::class, 'transferSave'])->name('operacion.transferSave');
Route::post('operacion/cursoUpdate',[OperacionController::class, 'cursoUpdate'])->name('operacion.cursoUpdate');



Route::resource('alumno',AlumnoController::class);
Route::get('formulario',[AlumnoController::class, 'formulario'])->name('alumno.formulario');
Route::get('busquedaAlumno',[AlumnoController::class, 'busqueda'])->name('alumno.busqueda');
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
Route::get('busquedaSuplemento',[SuplementosController::class, 'busqueda'])->name('suplementos.busqueda');
Route::post('suplementos/store',[SuplementosController::class, 'store'])->name('suplementos.store');
Route::post('suplementos/update',[SuplementosController::class, 'update'])->name('suplementos.update');
Route::post('suplementos/destroy',[SuplementosController::class, 'destroy'])->name('suplementos.destroy');

//Tipos
Route::resource('tipos',TipoController::class);
Route::get('busquedaTipos',[TipoController::class, 'busqueda'])->name('tipos.busqueda');
Route::post('tipos/store',[TipoController::class, 'store'])->name('tipos.store');
Route::post('tipos/update',[TipoController::class, 'update'])->name('tipos.update');
Route::post('tipos/destroy',[TipoController::class, 'destroy'])->name('tipos.destroy');

Route::get('reportes',[ReporteController::class, 'index'])->name('reporte.index');
Route::post('reportes/generateFactura',[ReporteController::class, 'generateFactura'])->name('reporte.generateFactura');
Route::get('busqueda',[ReporteController::class, 'busqueda'])->name('reporte.busqueda');

/* AjaxController */
Route::get('getProvincias',[AjaxController::class, 'getProvincias'])->name('ajax.getProvincias');

Route::get('getLocalidades',[AjaxController::class, 'getLocalidades'])->name('ajax.getLocalidades');
Route::post('store',[AjaxController::class, 'store'])->name('ajax.store');

/*Cliente */
Route::get('success',[HomeController::class, 'mensaje'])->name('home.mensaje');


/* Login */
Route::get('/loginAdmin',[LoginController::class, 'index'])->name('login.index');
Route::get('logout',[LoginController::class, 'logout'])->name('login.logout');

Route::get('/',[LoginAlumnoController::class, 'index'])->name('loginAlumno.index');
Route::get('logoutAlumno',[LoginAlumnoController::class, 'logout'])->name('loginAlumno.logout');

Route::post('loginValidator',[LoginController::class, 'loginValidator'])->name('login.loginValidator');
Route::post('loginAlumnoValidator',[LoginAlumnoController::class, 'loginValidator'])->name('loginAlumno.loginValidator');

/*Confirmaciones */


Route::get('confirmaciones',[ConfirmacionesController::class, 'index'])->name('confirmaciones.index');
Route::post('confirmaciones/solicitud_curso_modal',[ConfirmacionesController::class, 'solicitud_curso_modal'])->name('confirmaciones.solicitud_curso_modal');
Route::post('confirmaciones/solicitud_curso_email',[ConfirmacionesController::class, 'solicitud_curso_email'])->name('confirmaciones.solicitud_curso_email');
Route::post('confirmaciones/confirmacion_curso_email',[ConfirmacionesController::class, 'confirmacion_curso_email'])->name('confirmaciones.confirmacion_curso_email');
Route::post('confirmaciones/confirmacion_vuelo_email',[ConfirmacionesController::class, 'confirmacion_vuelo_email'])->name('confirmaciones.confirmacion_vuelo_email');
Route::post('confirmaciones/confirmacion_seguro',[ConfirmacionesController::class, 'confirmacion_seguro'])->name('confirmaciones.confirmacion_seguro');
Route::post('confirmaciones/solicitud_transfer_modal',[ConfirmacionesController::class, 'solicitud_transfer_modal'])->name('confirmaciones.solicitud_transfer_modal');
Route::post('confirmaciones/solicitud_transfer_email',[ConfirmacionesController::class, 'solicitud_transfer_email'])->name('confirmaciones.solicitud_transfer_email');
Route::post('confirmaciones/confirmacion_transfer_email',[ConfirmacionesController::class, 'confirmacion_transfer_email'])->name('confirmaciones.confirmacion_transfer_email');
Route::post('confirmaciones/descripcion_modal',[ConfirmacionesController::class, 'descripcion_modal'])->name('confirmaciones.descripcion_modal');
Route::post('confirmaciones/descripcion_email',[ConfirmacionesController::class, 'descripcion_email'])->name('confirmaciones.descripcion_email');

Route::post('confirmaciones/confirmacion_condicionada',[ConfirmacionesController::class, 'confirmacion_condicionada'])->name('confirmaciones.confirmacion_condicionada');
Route::post('confirmaciones/confirmar_condicionada_email',[ConfirmacionesController::class, 'confirmar_condicionada_email'])->name('confirmaciones.confirmar_condicionada_email');

Route::post('confirmaciones/confirmar_email',[ConfirmacionesController::class, 'confirmar_email'])->name('confirmaciones.confirmar_email');


Route::post('confirmaciones/entrega_email',[ConfirmacionesController::class, 'entrega_email'])->name('confirmaciones.entrega_email');
Route::get('test',[ConfirmacionesController::class, 'test'])->name('confirmaciones.test');




Route::get('operacion/cobros/{opr_id}',[CobrosController::class, 'cobros'])->name('cobros.cobros');
Route::post('operacion/resto_curso',[CobrosController::class, 'resto_curso'])->name('cobros.resto_curso');
Route::post('operacion/devolucion',[CobrosController::class, 'devolucion'])->name('cobros.devolucion');
Route::post('operacion/save_concepto',[CobrosController::class, 'save_concepto'])->name('cobros.save_concepto');
Route::post('operacion/sendFactura',[ConfirmacionesController::class, 'sendFactura'])->name('cobros.sendFactura');



Route::get('europa',[EuropaPlusController::class, 'index'])->name('europa.index');
Route::get('europa/links',[EuropaPlusController::class, 'links'])->name('europa.links');
Route::get('europa/edit',[EuropaPlusController::class, 'edit'])->name('europa.edit');
Route::post('europa/update',[EuropaPlusController::class, 'update'])->name('europa.update');

Route::get('formularios',[FormularioController::class, 'index'])->name('formularios.index');
Route::get('formularios/junior',[FormularioController::class, 'formulario1'])->name('formularios.formulario1');