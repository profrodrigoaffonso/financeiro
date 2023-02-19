<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\BancosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\FormaPagamentosController;
use App\Http\Controllers\PagamentosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     // return redirect(route('login.login'));
//     return view('links');
// });


// Route::get('/login', function () {
//     return view('auth.login');
// });

// Route::get('/register', function () {
//     return view('auth.register');
// });

Route::get('/app', function () {
    return view('app.index');
});

// sem autenticar
// Route::post('/login', 'Auth\LoginController@login')->name('login.login');
// Route::get('/logout', 'Auth\LoginController@logout')->name('login.logout');
Route::get('/inserir', [PagamentosController::class, 'inserir'])->name('pagamentos.inserir');
// Route::get('/upload', 'PagamentosController@upload')->name('pagamentos.upload');
// Route::post('/store-upload', 'PagamentosController@storeUpload')->name('pagamentos.upload.store');
Route::get('/saques', [SaquesController::class, 'inserir'])->name('saques.inserir');
// Route::post('/saques-salvar', 'SaquesController@salvar')->name('saques.salvar');
Route::post('/salvar', [PagamentosController::class, 'salvar'])->name('pagamentos.salvar');

// Route::prefix('home')->middleware('auth')->group(function () {
//     Route::get('/', function () {
//         return view('home');
//     })->name('admin.home');

// });

Route::get('/', [LoginController::class, 'login'])->name('login.login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

// autenticados
Route::prefix('admin')->middleware('auth')->group(function(){

    Route::get('/', function () {
        return view('home');
    })->name('admin.home');

    Route::prefix('bancos')->group(function () {
        Route::get('/', [BancosController::class, 'index'])->name('bancos.index');
        Route::get('/create', [BancosController::class, 'create'])->name('bancos.create');
        Route::post('/store', [BancosController::class, 'store'])->name('bancos.store');
        Route::get('/{id}/edit', [BancosController::class, 'edit'])->name('bancos.edit');
        Route::put('/update', [BancosController::class, 'update'])->name('bancos.update');
    });

    Route::prefix('categorias')->group(function () {
        Route::get('/', [CategoriasController::class, 'index'])->name('categorias.index');
        Route::get('/create', [CategoriasController::class, 'create'])->name('categorias.create');
        Route::post('/store', [CategoriasController::class, 'store'])->name('categorias.store');
        Route::get('/{id}/edit', [CategoriasController::class, 'edit'])->name('categorias.edit');
        Route::put('/update', [CategoriasController::class, 'update'])->name('categorias.update');
    });

    Route::prefix('forma-pagamentos')->group(function () {
        Route::get('/', [FormaPagamentosController::class, 'index'])->name('forma_pagamentos.index');
        Route::get('/create', [FormaPagamentosController::class, 'create'])->name('forma_pagamentos.create');
        Route::post('/store', [FormaPagamentosController::class, 'store'])->name('forma_pagamentos.store');
        Route::get('/{id}/edit', [FormaPagamentosController::class, 'edit'])->name('forma_pagamentos.edit');
        Route::put('/update', [FormaPagamentosController::class, 'update'])->name('forma_pagamentos.update');
    });

    Route::prefix('pagamentos')->group(function () {
        Route::get('/', [PagamentosController::class, 'index'])->name('pagamentos.index');
        Route::post('/filter', [PagamentosController::class, 'filter'])->name('pagamentos.filter');
        Route::get('/create', [PagamentosController::class, 'create'])->name('pagamentos.create');
        Route::post('/store', [PagamentosController::class, 'store'])->name('pagamentos.store');
        Route::get('/exportar', [PagamentosController::class, 'exportar'])->name('pagamentos.exportar');
        Route::post('/exec-exportar', [PagamentosController::class, 'execExportar'])->name('pagamentos.exec-exportar');
    });

});
