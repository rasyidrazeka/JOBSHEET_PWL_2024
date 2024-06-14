<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CatatanInventarisController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RiwayatPenjualanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::group(['prefix'=>'produk'], function(){
    Route::get('/', [ProdukController::class, 'index'])->middleware('auth');
    Route::post('/list', [ProdukController::class, 'list'])->middleware('auth');
    Route::get('/create', [ProdukController::class, 'create'])->middleware('auth');
    Route::post('/', [ProdukController::class, 'store'])->middleware('auth');
    Route::get('/{id}', [ProdukController::class, 'show'])->middleware('auth');
    Route::get('/{id}/edit', [ProdukController::class, 'edit'])->middleware('auth');
    Route::put('/{id}', [ProdukController::class, 'update'])->middleware('auth');
    Route::delete('/{id}', [ProdukController::class, 'destroy'])->middleware('auth');
});

Route::group(['prefix'=>'kategori'], function(){
    Route::get('/', [KategoriController::class, 'index'])->middleware('auth');
    Route::post('/list', [KategoriController::class, 'list'])->middleware('auth');
    Route::get('/create', [KategoriController::class, 'create'])->middleware('auth');
    Route::post('/', [KategoriController::class, 'store'])->middleware('auth');
    Route::get('/{id}/edit', [KategoriController::class, 'edit'])->middleware('auth');
    Route::put('/{id}', [KategoriController::class, 'update'])->middleware('auth');
    Route::delete('/{id}', [KategoriController::class, 'destroy'])->middleware('auth');
});

Route::group(['prefix'=>'stok'], function(){
    Route::get('/', [CatatanInventarisController::class, 'index'])->middleware('auth');
    Route::post('/list', [CatatanInventarisController::class, 'list'])->middleware('auth');
    Route::get('/create', [CatatanInventarisController::class, 'create'])->middleware('auth');
    Route::post('/', [CatatanInventarisController::class, 'store'])->middleware('auth');
    Route::delete('/{id}', [CatatanInventarisController::class, 'destroy'])->middleware('auth');
});

Route::group(['prefix'=>'customer'], function(){
    Route::get('/', [CustomerController::class, 'index'])->middleware('auth');
    Route::post('/list', [CustomerController::class, 'list'])->middleware('auth');
    Route::get('/create', [CustomerController::class, 'create'])->middleware('auth');
    Route::post('/', [CustomerController::class, 'store'])->middleware('auth');
    Route::get('/{id}/edit', [CustomerController::class, 'edit'])->middleware('auth');
    Route::put('/{id}', [CustomerController::class, 'update'])->middleware('auth');
    Route::delete('/{id}', [CustomerController::class, 'destroy'])->middleware('auth');
});

Route::group(['prefix'=>'user'], function(){
    Route::get('/', [UserController::class, 'index'])->middleware('auth');
    Route::post('/list', [UserController::class, 'list'])->middleware('auth');
    Route::get('/create', [UserController::class, 'create'])->middleware('auth');
    Route::post('/', [UserController::class, 'store'])->middleware('auth');
    Route::get('/{id}', [UserController::class, 'show'])->middleware('auth');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->middleware('auth');
    Route::put('/{id}', [UserController::class, 'update'])->middleware('auth');
    Route::delete('/{id}', [UserController::class, 'destroy'])->middleware('auth');
});

Route::group(['prefix'=>'role'], function(){
    Route::get('/', [LevelController::class, 'index'])->middleware('auth');
    Route::post('/list', [LevelController::class, 'list'])->middleware('auth');
    Route::get('/create', [LevelController::class, 'create'])->middleware('auth');
    Route::post('/', [LevelController::class, 'store'])->middleware('auth');
    Route::get('/{id}/edit', [LevelController::class, 'edit'])->middleware('auth');
    Route::put('/{id}', [LevelController::class, 'update'])->middleware('auth');
    Route::delete('/{id}', [LevelController::class, 'destroy'])->middleware('auth');
});

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('loginProses');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

Route::group(['prefix'=>'penjualan'], function(){
    Route::get('/create', [PenjualanController::class, 'create'])->middleware('auth');
    Route::post('/', [PenjualanController::class, 'store'])->middleware('auth');
});

Route::group(['prefix'=>'riwayatPenjualan'], function(){
    Route::get('/', [RiwayatPenjualanController::class, 'index'])->middleware('auth');
    Route::post('/list', [RiwayatPenjualanController::class, 'list'])->middleware('auth');
    Route::get('/{id}', [RiwayatPenjualanController::class, 'show'])->middleware('auth');
});