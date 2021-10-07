<?php

use App\Http\Controllers\BuildController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaquetadoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\DB;


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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/principal',[HomeController::class, 'principal'])->middleware('auth')->name('principal');
#Route::get('/profile', [HomeController::class, 'edit'])->name('profile');

Route::get('/formatos.requerimientos.new', [RecordController::class, 'index'])->middleware('auth')->name('Nuevo');
Route::post('/formatos.requerimientos.new', [RecordController::class, 'create'])->name('Crear');
Route::get('/formatos.requerimientos.edit', [MenuController::class, 'edit'])->middleware('auth')->name('Editar');
Route::get('/formatos.requerimientos.edit/{folio}', [MenuController::class,'pause'])->name('Pausa');
Route::get('/formatos.requerimientos/{folio}', [MenuController::class,'play'])->name('Play');

Route::get('/formatos.requerimientos.sub/{folioS}', [MenuController::class,'close'])->middleware('auth')->name('Concluir');
#Route::get('/formatos.requerimientos.levantamiento', [RecordController::class, 'levantamiento']);
Route::get('/formatos/requerimientos/formato/{id_registro}', [RecordController::class, 'formato'])->middleware('auth')->name('Formato');
Route::post('/formatos.requerimientos.formato', [RecordController::class, 'actualiza'])->name('Actualizar');
Route::get('/formatos/requerimientos/levantamiento/{id_registro}', [RecordController::class, 'edit'])->middleware('auth')->name('Levantamiento');
Route::post('/formatos.requerimientos.edit', [RecordController::class, 'levantamiento'])->name('Guardar');
Route::get('/correos.Plantilla/{folio}', [RecordController::class, 'test'])->name('Test');
Route::get('/layouts/correo/{folio}',[MenuController::class, 'send'])->name('Enviar');
Route::post('/layouts/correo',[MenuController::class, 'sended'])->name('Enviado');

Route::get('/formatos.requerimientos.planeacion/{folio}',[BuildController::class, 'planeacion'])->middleware('auth')->name('Planeacion');
Route::post('/formatos.requerimientos.planeacion', [BuildController::class, 'plan'])->name('Plan');

Route::get('/formatos.requerimientos.analisis/{folio}',[BuildController::class, 'analisis'])->middleware('auth')->name('Analisis');
Route::post('/formatos.requerimientos.analisis', [BuildController::class, 'Propuesta'])->name('Propuesta');

Route::get('/formatos.requerimientos.construccion/{folio}',[BuildController::class, 'construccion'])->middleware('auth')->name('Construccion');
Route::post('/formatos.construccion',[BuildController::class, 'construir'])->name('Construir');

Route::get('/formatos.requerimientos.liberacion/{folio}',[BuildController::class, 'liberacion'])->name('Liberacion');
Route::post('/formatos.requerimientos.liberacion',[BuildController::class, 'liberar'])->name('Liberar');

Route::get('/formatos.requerimientos.implementacion/{folio}',[BuildController::class, 'implementacion'])->name('Implementacion');
Route::post('/formatos.requerimientos.implementacion',[BuildController::class, 'implementar'])->name('Implementar');

Route::get('/formatos.requerimientos.informacion/{folio}',[BuildController::class, 'informacion'])->name('Informacion');

Route::get('/formatos.subproceso/{folio}',[MenuController::class, 'subproceso'])->middleware('auth')->name('Subproceso');
Route::post('/formatos.subproceso',[MenuController::class, 'sub'])->name('Sub');


route::get('formatos.maquetado.new',[MaquetadoController::class, 'index'])->middleware('auth')->name('NuevaMaqueta');
route::post('formatos.maquetado.new',[MaquetadoController::class, 'create'])->name('NRegistro');

route::get('formatos.comentarios/{folio}',[MenuController::class, 'avance'])->middleware('auth')->name('Avance');