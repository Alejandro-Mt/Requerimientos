<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('layouts.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index']);

Route::get('/profile', [HomeController::class, 'index']) -> middleware('auth')->name('cuenta');

Route::group(['prefix'=> 'user','middleware' => ['auth', 'user',]],function(){
 /*Rutas*/
    Route::get('menu', [HomeController::class, 'index'])->name('menu');
    Route::get('menu/create', [HomeController::class, 'create'])->name('create');
    Route::get('menu/{id}/edit', [HomeController::class, 'edit'])->name('edit');
    Route::post('menu', [HomeController::class, 'save'])->name('menu.save');
});