<?php

use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\BuildController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConstruccionController;
use App\Http\Controllers\CorreoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\FuncionalidadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImplementacionController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LevantamientosController;
use App\Http\Controllers\LiberacionController;
use App\Http\Controllers\MaquetadoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PlaneacionController;
use App\Http\Controllers\PreregistroController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\SistemaController;
use Illuminate\Support\Facades\Auth;


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

#Route::get('/', function () {return view('auth.login');});

Auth::routes();
auth::routes(['verify'=>true]);
#          Pagina Principal         #
Route::get('/', [HomeController::class, 'index'])->middleware('verified')->name('home');
Route::get('/principal',[HomeController::class, 'principal'])->middleware('auth')->name('principal');
#          Perfil         #
Route::post('/profile', [ProfileController::class, 'update'])->name('Actualiza');
Route::get('/profile/{id}', [ProfileController::class, 'edit'])->middleware('auth')->name('profile');
#          Catalogo         #
Route::get('/layouts.datos', [MenuController::class, 'store'])->middleware('auth')->name('Seguir');
#          Area         #
Route::post('area.nuevo', [AreaController::class, 'create'])->name('NArea');
Route::post('area.actualizar', [AreaController::class, 'edit'])->name('UArea');
Route::delete('area.borrar.{id_area}', [AreaController::class, 'destroy'])->name('DArea');
#          Cliente         #
Route::post('cliente.nuevo', [ClienteController::class, 'create'])->name('NCliente');
Route::post('cliente.actualizar.{id_cliente}', [ClienteController::class, 'update'])->name('UCliente');
Route::delete('cliente.Borrar.{id_cliente}', [ClienteController::class, 'destroy'])->name('DCliente');
#          Departamento         #
Route::post('depto.nuevo', [DepartamentoController::class, 'create'])->name('NDepto');
Route::post('depto.actualizar.{id}', [DepartamentoController::class, 'update'])->name('UDepto');
Route::delete('depto.Borrar.{id}', [DepartamentoController::class, 'destroy'])->name('DDepto');
#          Estatus Funcionalidad         #
Route::post('funcion.nuevo', [FuncionalidadController::class, 'create'])->name('NFuncion');
Route::post('funcion.actualizar.{id_estatus}', [FuncionalidadController::class, 'update'])->name('UFuncion');
Route::delete('funcion.Borrar.{id_estatus}', [FuncionalidadController::class, 'destroy'])->name('DFuncion');
#          Puesto         #
Route::post('puesto.nuevo', [PuestoController::class, 'create'])->name('NPuesto');
Route::post('puesto.actualizar.{id_puesto}', [PuestoController::class, 'update'])->name('UPuesto');
Route::delete('puesto.Borrar.{id_puesto}', [PuestoController::class, 'destroy'])->name('DPuesto');
#          Responsable         #
Route::post('responsable.nuevo', [ResponsableController::class, 'create'])->name('NResponsable');
Route::post('responsable.actualizar.{id_responsable}', [ResponsableController::class, 'update'])->name('UResponsable');
Route::delete('responsable.Borrar.{id_responsable}', [ResponsableController::class, 'destroy'])->name('DResponsable');
#          Sistema         #
Route::post('sistema.nuevo', [SistemaController::class, 'create'])->name('NSistema');
Route::post('sistema.actualizar.{id_sistema}', [SistemaController::class, 'update'])->name('USistema');
Route::delete('sistema.Borrar.{id_sistema}', [SistemaController::class, 'destroy'])->name('DSistema');
#          Proceso Requerimiento         #
Route::get('/formatos.requerimientos.new', [RecordController::class, 'index'])->middleware('auth')->name('Nuevo');
Route::post('/formatos.requerimientos.new', [RecordController::class, 'create'])->name('Crear');
Route::get('/formatos.requerimientos.edit', [MenuController::class, 'edit'])->middleware('auth')->name('Editar');
Route::get('/formatos.requerimientos.edit/{folio}', [MenuController::class,'pause'])->name('Pausa');
Route::get('/posponer/{folio}', [MenuController::class,'posponer'])->name('Posponer');
Route::get('/cancelar/{folio}', [RecordController::class,'update'])->name('Cancelar');
Route::get('/formatos.requerimientos/{folio}', [MenuController::class,'play'])->name('Play');
Route::get('/formatos.requerimientos.sub/{folioS}', [MenuController::class,'close'])->middleware('auth')->name('Concluir');
Route::get('/formatos.requerimientos.formato.{id_registro}', [LevantamientosController::class, 'formato'])->middleware('auth')->name('Formato');
Route::post('/formatos.requerimientos.formato', [LevantamientosController::class, 'actualiza'])->name('Actualizar');
Route::get('/formatos.requerimientos.levantamiento.{id_registro}', [LevantamientosController::class, 'edit'])->middleware('auth')->name('Levantamiento');
Route::post('/formatos.requerimientos.edit', [LevantamientosController::class, 'levantamiento'])->name('Guardar');
##  metodos para correo ##
Route::get('/correos.Plantilla.{folio}', [CorreoController::class, 'PDF'])->name('Archivo');
Route::get('/correos.contenido.{folio}', [CorreoController::class, 'respuesta'])->name('Respuesta');
Route::get('/correos.{folio}',[CorreoController::class, 'rechazo'])->name('Rechazo');
##  metodos para correo  autorizacion 2 ##
Route::get('libera.{folio}', [CorreoController::class, 'libera'])->name('Libera');
Route::get('requiere.{folio}',[CorreoController::class, 'requiere'])->name('Requiere');
Route::get('autorizar.{folio}',[CorreoController::class, 'segval'])->name('Aut');
Route::get('archivos.{folio}',[CorreoController::class,'libera']);
Route::post('adjuntar.{folio}',[CorreoController::class,'store'])->name('Adjuntos');
Route::delete('file.borrar.{id}', [CorreoController::class, 'destroy'])->name('dfile');
Route::get('/layouts.correo.{folio}',[CorreoController::class, 'send'])->middleware('auth')->name('Enviar');
Route::post('/layouts.correo',[CorreoController::class, 'sended'])->name('Enviado');
##  metodos para Construccion ##
Route::get('/formatos.requerimientos.planeacion.{folio}',[PlaneacionController::class, 'index'])->middleware('auth')->name('Planeacion');
Route::get('/show.{folio}',[PlaneacionController::class, 'show'])->name('Datos');#datos de calendario
Route::post('/formatos.requerimientos.planeacion', [PlaneacionController::class, 'create'])->name('Plan');

Route::get('/formatos.requerimientos.analisis.{folio}',[AnalisisController::class, 'index'])->middleware('auth')->name('Analisis');
Route::post('/formatos.requerimientos.analisis', [AnalisisController::class, 'create'])->name('Propuesta');

Route::get('/formatos.requerimientos.construccion.{folio}',[ConstruccionController::class, 'index'])->middleware('auth')->name('Construccion');
Route::post('/formatos.requerimientos.construccion',[ConstruccionController::class, 'create'])->name('Construir');
##  metodos para liberacion ##
Route::get('/formatos.requerimientos.liberacion.{folio}',[LiberacionController::class, 'index'])->name('Liberacion');
Route::post('/formatos.requerimientos.liberacion',[LiberacionController::class, 'create'])->name('Liberar');
##  metodos para implementacion ##
Route::get('/formatos.requerimientos.implementacion.{folio}',[ImplementacionController::class, 'index'])->name('Implementacion');
Route::post('/formatos.requerimientos.implementacion',[ImplementacionController::class, 'create'])->name('Implementar');
##  metodos para solicitar informacion ##
Route::get('/formatos.requerimientos.informacion.{folio}',[InfoController::class, 'index'])->middleware('auth')->name('Informacion');
Route::post('/formatos.requerimientos.informacion',[InfoController::class, 'create'])->name('Solicitud');
##  metodos para Subprocesos ##
Route::get('/formatos.subproceso.{folio}',[MenuController::class, 'subproceso'])->middleware('auth')->name('Subproceso');
Route::post('/formatos.subproceso',[MenuController::class, 'sub'])->name('Sub');
#          metodos para Maquetado          #
route::get('formatos.maquetado.new',[MaquetadoController::class, 'index'])->middleware('auth')->name('NuevaMaqueta');
route::post('formatos.maquetado.new',[MaquetadoController::class, 'create'])->name('NRegistro');
##  metodos para Comentarios ##
route::get('formatos.comentarios.{folio}',[MenuController::class, 'avance'])->middleware('auth')->name('Avance');
route::post('formatos.comentarios',[MenuController::class, 'comentar'])->name('Comentar');
##  metodos para Soporte ##
route::get('soporte.nuevo',[BuildController::class, 'index'])->middleware('auth')->name('Soporte');
route::post('soporte.ajustes',[BuildController::class, 'edit'])->name('SUser');
##  seg  ##
route::get('soporte.niveles',[BuildController::class, 'edit'])->middleware('auth')->name('Seg');
##  metodos para Usuario ##
route::get('formatos.ajustes',[PermissionsController::class, 'ajustes'])->middleware('auth')->name('Ajustes');
route::post('formatos.ajustes',[PermissionsController::class, 'edit'])->name('AUser');

##  metodos para registro previo  ##
route::get('preregistro',[PreregistroController::class, 'index'])->name('PreRegistro');
route::post('preregistro.crear',[PreregistroController::class, 'create'])->name('ClienteSol');
route::get('preregistro.carga.{folio}',[PreregistroController::class, 'upload'])->name('Plus');
route::post('preregistro.archivos.{folio}',[PreregistroController::class,'data'])->name('Previsto');

route::get('preregistro.listado',[PreregistroController::class, 'store'])->name('Admsol');
route::get('preregistro.datos.{folio}',[PreregistroController::class, 'show'])->name('AA');
route::get('requerimiento.nuevo.{folio}',[PreregistroController::class, 'edit'])->name('NR');
route::post('preregistro.rechazo.{folio}',[PreregistroController::class, 'destroy'])->name('RechazoP');