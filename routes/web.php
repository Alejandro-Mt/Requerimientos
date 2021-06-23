<?php

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

Route::get('/formatos.requerimientos.edit', [MenuController::class, 'edit'])->name('Editar');
Route::get('/formatos.requerimientos.new', [RecordController::class, 'index'])->name('Nuevo');
Route::post('/formatos.requerimientos.new', [RecordController::class, 'create'])->name('Guardar');
Route::get('/formatos.requerimientos.levantamiento', [RecordController::class, 'levantamiento'])->name('Levantamiento');
#  Route::get('/menu.save', [Record::class, 'save'])->name('Guardar');
