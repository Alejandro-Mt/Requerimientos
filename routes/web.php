<?php

use App\Http\Controllers\BuildController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
Route::get('/profile', [HomeController::class, 'edit'])->name('profile');

Route::get('/formatos.requerimientos.new', [RecordController::class, 'index'])->name('Nuevo');
Route::post('/formatos.requerimientos.new', [RecordController::class, 'create'])->name('Crear');
Route::get('/formatos.requerimientos.edit', [MenuController::class, 'edit'])->name('Editar');
Route::get('/formatos.requerimientos.edit/{folio}', [MenuController::class,'pause'])->name('Pausa');
Route::get('/formatos.requerimientos/{folio}', [MenuController::class,'play'])->name('Play');

Route::get('/formatos.requerimientos.sub/{folioS}', [MenuController::class,'close'])->name('Concluir');
#Route::get('/formatos.requerimientos.levantamiento', [RecordController::class, 'levantamiento']);
Route::get('/formatos/requerimientos/formato/{id_registro}', [RecordController::class, 'formato'])->name('Formato');
Route::post('/formatos.requerimientos.formato', [RecordController::class, 'actualiza'])->name('Actualizar');
Route::get('/formatos/requerimientos/levantamiento/{id_registro}', [RecordController::class, 'edit'])->name('Levantamiento');
Route::post('/formatos.requerimientos.edit', [RecordController::class, 'levantamiento'])->name('Guardar');
#  Route::get('/menu.save', [Record::class, 'save'])->name('Guardar');
Route::get('/layouts/correo/{folio}',[MenuController::class, 'send'])->name('Enviar');
Route::post('/layouts/correo',[MenuController::class, 'sended'])->name('Enviado');

Route::get('/formatos.requerimientos.planeacion/{folio}',[BuildController::class, 'planeacion'])->name('Planeacion');
Route::post('/formatos.requerimientos.planeacion', [BuildController::class, 'plan'])->name('Plan');

Route::get('/formatos.requerimientos.analisis/{folio}',[BuildController::class, 'analisis'])->name('Analisis');
Route::post('/formatos.requerimientos.analisis', [BuildController::class, 'Propuesta'])->name('Propuesta');

Route::get('/formatos.requerimientos.construccion/{folio}',[BuildController::class, 'construccion'])->name('Construccion');
Route::post('/formatos.construccion',[BuildController::class, 'construir'])->name('Construir');

Route::get('/formatos.requerimientos.informacion',[BuildController::class, 'informacion'])->name('Informacion');

Route::get('/formatos.subproceso/{folio}',[MenuController::class, 'subproceso'])->name('Subproceso');
Route::post('/formatos.subproceso',[MenuController::class, 'sub'])->name('Sub');