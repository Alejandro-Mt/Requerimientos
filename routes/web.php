<?php

use App\Http\Controllers\AccesoController;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\BuildController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConstruccionController;
use App\Http\Controllers\CorreoController;
use App\Http\Controllers\EstatusController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\FuncionalidadController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImplementacionController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LevantamientosController;
use App\Http\Controllers\LiberacionController;
use App\Http\Controllers\MaquetadoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MesaContoller;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\PlaneacionController;
use App\Http\Controllers\PreregistroController;
use App\Http\Controllers\PrioridadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RedefinisionController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\RondaController;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\Solicitantescontroller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


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
Route::get('auth/google', [GoogleController::class,'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class,'handleGoogleCallback']);
Auth::routes();
auth::routes(['verify'=>true]);

#          Pagina Principal         #
Route::get('/', [HomeController::class, 'index'])->middleware('verified')->name('home');
Route::get('/principal',[HomeController::class, 'principal'])->middleware('auth')->name('principal');
Route::post('gsheets',[HomeController::class, 'gsheets'])->name('GSheet');
#          Perfil         #
Route::post('/profile', [ProfileController::class, 'update'])->name('Actualiza');
Route::get(substr(Crypt::encryptString('/profile'), 0, 3).'{id}', [ProfileController::class, 'edit'])->middleware('auth')->name('profile');
Route::post('user.pass',[ProfileController::class, 'updatepass'])->middleware('auth')->name('UsrPass');
Route::get('configuracion', [ProfileController::class, 'settings']);
#          prioridades         #
Route::get('prioridad.solicitudes', [PrioridadController::class, 'index'])->name('AutP');
Route::get('autorizacion.prioridad.{id}.{respuesta}', [PrioridadController::class, 'update'])->name('AutR');

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
Route::post('estatus.nuevo', [EstatusController::class, 'create'])->name('NEstatus');
Route::post('estatus.actualizar.{id_estatus}', [EstatusController::class, 'update'])->name('UEstatus');
Route::delete('estatus.Borrar.{id_estatus}', [EstatusController::class, 'destroy'])->name('DEstatus');
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
#          Solicitante         #
Route::post('solicitante.nuevo', [Solicitantescontroller::class, 'create'])->name('NSolicitante');
Route::post('solicitante.actualizar.{id_sistema}', [Solicitantescontroller::class, 'update'])->name('USolicitante');
Route::delete('solicitante.Borrar.{id_sistema}', [Solicitantescontroller::class, 'destroy'])->name('DSolicitante');

#          Reportes            #
Route::post('registros.reporte', [RecordController::class, 'report'])->name('ReqReport');

#          Proceso Requerimiento         #
  #    \\      Proceso nuevo      //   #
Route::get('/formatos.requerimientos.new', [RecordController::class, 'index'])->middleware('auth')->name('Nuevo');
Route::post('/formatos.requerimientos.new', [RecordController::class, 'create'])->name('Crear');
Route::post('/update/{folio}', [RecordController::class,'update'])->name('EditReq');
Route::post('tester.{folio}',[RecordController::class, 'tester'])->name('Tester');
Route::get('/formatos.requerimientos.edit', [MenuController::class, 'edit'])->middleware('auth')->name('Editar');
Route::get('/formatos.requerimientos.edit/{folio}', [MenuController::class,'pause'])->name('Pausa');

  #    \\      Proceso extras      //   #
Route::get('/posponer.{folio}.{id_motivo}.{id_estatus}', [MenuController::class,'posponer'])->name('Posponer');
Route::post('/cancelar/{folio}', [RecordController::class,'cancel'])->name('Cancelar');
Route::get('/formatos.requerimientos/{folio}', [MenuController::class,'play'])->name('Play');
Route::get('/formatos.requerimientos.sub/{folioS}', [MenuController::class,'close'])->middleware('auth')->name('Concluir');
Route::get(substr(Crypt::encryptString('mesa'),90,5).'{folio}',[MesaContoller::class,'index'])->middleware('auth')->name('Mesa');
Route::post('crear.mesa.{folio}',[MesaContoller::class,'create'])->middleware('auth')->name('NMesa');
#    \\      Proceso levantamiento      //   #
Route::get(substr(Crypt::encryptString('/formatos.requerimientos.formato'), 10, 5).'{id_registro}', [LevantamientosController::class, 'formato'])->middleware('auth')->name('Formato');
Route::post('/formatos.requerimientos.formato', [LevantamientosController::class, 'actualiza'])->name('Actualizar');
Route::get(substr(Crypt::encryptString('/formatos.requerimientos.levantamiento'), 15, 5).'{id_registro}', [LevantamientosController::class, 'edit'])->middleware('auth')->name('Levantamiento');
Route::post('/formatos.requerimientos.edit', [LevantamientosController::class, 'levantamiento'])->name('Guardar');
##  metodos para correo ##
Route::get(substr(Crypt::encryptString('/correos.Plantilla'), 20, 5).'{folio}', [CorreoController::class, 'PDF'])->name('Archivo');
Route::get('/correos.contenido.{folio}', [CorreoController::class, 'respuesta'])->name('Respuesta');
Route::get('/correos.{folio}',[CorreoController::class, 'rechazo'])->name('Rechazo');
##  metodos para correo  autorizacion 2 ##
Route::get('impacto.{folio}.{impacto}', [CorreoController::class, 'impacto'])->name('DPrioridad');
Route::post('clase.{folio}',[CorreoController::class, 'clase'])->name('Clase');
#Route::get('requiere.{folio}',[CorreoController::class, 'requiere'])->name('PAlta');
Route::get('autorizar.{folio}',[CorreoController::class, 'segval'])->name('Aut');
Route::get('definicion.{folio}',[PlaneacionController::class, 'notify'])->name('Def_Req');
#  Route::get('flujo.{folio}',[PlaneacionController::class, 'nflujo'])->name('N_Flujo');
Route::get('flujo.autorizacion.{folio}.{respuesta}',[PlaneacionController::class, 'rflujo'])->name('R_Flujo');
Route::get('archivos.{folio}',[CorreoController::class,'libera']);
Route::post('adjuntar.{folio}',[CorreoController::class,'store'])->name('Adjuntos');
Route::delete('file.borrar.{id}', [CorreoController::class, 'destroy'])->name('dfile');
Route::get(substr(Crypt::encryptString('/layouts.correo'), 25, 5).'{folio}',[CorreoController::class, 'send'])->middleware('auth')->name('Enviar');
Route::post('/layouts.correo',[CorreoController::class, 'sended'])->name('Enviado');
##  metodos para Construccion ##
Route::get(substr(Crypt::encryptString('/formatos.requerimientos.planeacion'), 30, 5).'{folio}',[PlaneacionController::class, 'index'])->middleware('auth')->name('Planeacion');
Route::get('/gantt.descargable.{folio}',[HomeController::class,'exportGantt'])->middleware('auth')->name('Gantt');
Route::get('/show.{folio}',[PlaneacionController::class, 'show'])->name('Datos');#datos de calendario
Route::get('/rango.{folio}',[PlaneacionController::class, 'range']);
Route::get('/start.{folio}',[PlaneacionController::class, 'start']);
Route::post('/formatos.requerimientos.planeacion', [PlaneacionController::class, 'create'])->name('Plan');

Route::get(substr(Crypt::encryptString('/formatos.requerimientos.analisis'), 35, 5).'{folio}',[AnalisisController::class, 'index'])->middleware('auth')->name('Analisis');
Route::post('/formatos.requerimientos.analisis', [AnalisisController::class, 'create'])->name('Propuesta');

Route::get(substr(Crypt::encryptString('/formatos.requerimientos.construccion'), 40, 5).'{folio}',[ConstruccionController::class, 'index'])->middleware('auth')->name('Construccion');
Route::post('/formatos.requerimientos.construccion',[ConstruccionController::class, 'create'])->name('Construir');

Route::post('Ajuste.Definision.{folio}',[RedefinisionController::class, 'create'])->name('ReDef');
##  metodos para liberacion ##
Route::get(substr(Crypt::encryptString('pruebas.testing'), 95, 5).'{folio}',[LiberacionController::class, 'index'])->name('PruebasTesting')->middleware('auth');
Route::post('pruebas.liberacion',[LiberacionController::class, 'create'])->name('GPT');
Route::get(substr(Crypt::encryptString('/formatos.requerimientos.liberacion'), 45, 5).'{folio}',[LiberacionController::class, 'edit'])->name('Liberacion')->middleware('auth');
Route::post('/formatos.requerimientos.liberacion',[LiberacionController::class, 'update'])->name('Liberar');
#    \\      Proceso Requerimiento      //   #
Route::get(substr(Crypt::encryptString('ronda.registro'), 50, 5).'{folio}', [RondaController::class, 'index'])->name('Ronda')->middleware('auth');
Route::post('ronda.crear', [RondaController::class, 'create'])->name('CRonda');
##  metodos para implementacion ##
Route::get(substr(Crypt::encryptString('/formatos.requerimientos.implementacion'), 55, 5).'{folio}',[ImplementacionController::class, 'index'])->name('Implementacion')->middleware('auth');
Route::post('/formatos.requerimientos.implementacion',[ImplementacionController::class, 'create'])->name('Implementar');
##  metodos para solicitar informacion ##
Route::get(substr(Crypt::encryptString('/formatos.requerimientos.informacion'), 60, 1).'{folio}',[InfoController::class, 'index'])->middleware('auth')->name('Informacion');
Route::post('/formatos.requerimientos.informacion',[InfoController::class, 'create'])->name('Solicitud');
##  metodos para Subprocesos ##
Route::get('/formatos.subproceso.{folio}',[MenuController::class, 'subproceso'])->middleware('auth')->name('Subproceso');
Route::post('/formatos.subproceso',[MenuController::class, 'sub'])->name('Sub');
#          metodos para Maquetado          #
route::get('formatos.maquetado.new',[MaquetadoController::class, 'index'])->middleware('auth')->name('NuevaMaqueta');
route::post('formatos.maquetado.new',[MaquetadoController::class, 'create'])->name('NRegistro');
##  metodos para Comentarios ##
route::post('formatos.link',[PlaneacionController::class, 'update'])->name('ULink');
route::get('formatos.comentarios.{folio}',[MenuController::class, 'avance'])->middleware('auth')->name('Avance');
route::post('formatos.comentarios',[MenuController::class, 'comentar'])->name('Comentar');
##  metodos para Soporte ##
route::post('soporte.{folio}',[BuildController::class, 'soporte'])->middleware('auth')->name('Soporte');
route::post('soporte.ajustes',[BuildController::class, 'edit'])->name('SUser');
##  seg  ##
route::get('soporte.niveles',[BuildController::class, 'edit'])->middleware('auth')->name('Seg');
##  metodos para Usuario ##
route::get('formatos.ajustes',[PermissionsController::class, 'ajustes'])->middleware('auth')->name('Ajustes');
route::post('formatos.ajustes',[PermissionsController::class, 'edit'])->name('AjUser');
##  metodos para Usuario "Accesos" ##
route::post('accesos.{id_user}.{id_sistema}',[AccesoController::class, 'create'])->name('AcUser');
route::get('accesos.update.{id_user}.{id_sistema}',[AccesoController::class, 'update'])->name('DAcUser');

##  metodos para registro previo  ##
route::get(substr(Crypt::encryptString('preregistro'), 65, 5),[PreregistroController::class, 'index'])->name('PreRegistro');
route::post('preregistro.crear',[PreregistroController::class, 'create'])->name('ClienteSol');
route::get('preregistro.carga.{folio}',[PreregistroController::class, 'upload'])->name('Plus');
route::post('preregistro.archivos.{folio}',[PreregistroController::class,'data'])->name('Previsto');

route::get('listado',[ClienteController::class, 'store'])->name('Lista');
route::get(substr(Crypt::encryptString('prioridad'), 70, 5).'{id_sistema}',[ClienteController::class, 'priority'])->name('Prioridad')->middleware('auth');

route::get(substr(Crypt::encryptString('documentacion'), 75, 5).'{folio}',[ClienteController::class, 'document'])->name('Documentos')->middleware('auth');
route::get(substr(Crypt::encryptString('reportepdf'), 75, 5).'{folio}',[CorreoController::class, 'reportedoc'])->name('RD')->middleware('auth');
route::post('solicitud.prioridades',[ClienteController::class, 'request'])->name('CPrioridad');

route::get('clientes',[ClienteController::class, 'importance'])->name('Importancia')->middleware('auth');
route::post('clientes.prioridades',[ClienteController::class, 'updimp'])->name('CImportancia');

route::get('preregistro.listado',[PreregistroController::class, 'store'])->name('Admsol')->middleware('auth');
route::get(substr(Crypt::encryptString('preregistro.datos'), 80, 5).'{folio}',[PreregistroController::class, 'show'])->name('AA');
route::get(substr(Crypt::encryptString('requerimiento.nuevo'), 85, 5).'{folio}',[PreregistroController::class, 'edit'])->name('NR');
route::post('preregistro.rechazo.{folio}',[PreregistroController::class, 'destroy'])->name('RechazoP');
route::get('cliente.graficos',[PreregistroController::class, 'chart'])->name('Estadistico');