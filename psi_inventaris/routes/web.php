<?php

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransaksiKeluarController;
use App\Http\Controllers\TransaksiMasukController;

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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::group(['prefix'=>'administrasi'], function(){
    Route::get('/', [AdministrasiController::class, 'index'])->middleware('auth');
    Route::post('/list', [AdministrasiController::class, 'list'])->middleware('auth');
    Route::get('/create', [AdministrasiController::class, 'create'])->middleware('auth');
    Route::post('/', [AdministrasiController::class, 'store'])->middleware('auth');
    Route::get('/{id}', [AdministrasiController::class, 'show'])->middleware('auth');
    Route::get('/{id}/edit', [AdministrasiController::class, 'edit'])->middleware('auth');
    Route::put('/{id}', [AdministrasiController::class, 'update'])->middleware('auth');
    Route::delete('/{id}', [AdministrasiController::class, 'destroy'])->middleware('auth');
});

Route::group(['prefix'=>'barang'], function(){
    Route::get('/', [BarangController::class, 'index'])->middleware('auth');
    Route::post('/list', [BarangController::class, 'list'])->middleware('auth');
    Route::get('/create', [BarangController::class, 'create'])->middleware('auth');
    Route::post('/', [BarangController::class, 'store'])->middleware('auth');
    Route::get('/{id}', [BarangController::class, 'show'])->middleware('auth');
    Route::get('/{id}/edit', [BarangController::class, 'edit'])->middleware('auth');
    Route::put('/{id}', [BarangController::class, 'update'])->middleware('auth');
    Route::delete('/{id}', [BarangController::class, 'destroy'])->middleware('auth');
});

Route::group(['prefix'=>'transaksiMasuk'], function(){
    Route::get('/', [TransaksiMasukController::class, 'index'])->middleware('auth');
    Route::post('/list', [TransaksiMasukController::class, 'list'])->middleware('auth');
    Route::get('/create', [TransaksiMasukController::class, 'create'])->middleware('auth');
    Route::post('/', [TransaksiMasukController::class, 'store'])->middleware('auth');
    Route::get('/{id}', [TransaksiMasukController::class, 'show'])->middleware('auth');
    Route::get('/{id}/edit', [TransaksiMasukController::class, 'edit'])->middleware('auth');
    Route::put('/{id}', [TransaksiMasukController::class, 'update'])->middleware('auth');
    Route::delete('/{id}', [TransaksiMasukController::class, 'destroy'])->middleware('auth');
});

Route::group(['prefix'=>'transaksiKeluar'], function(){
    Route::get('/', [TransaksiKeluarController::class, 'index'])->middleware('auth');
    Route::post('/list', [TransaksiKeluarController::class, 'list'])->middleware('auth');
    Route::get('/create', [TransaksiKeluarController::class, 'create'])->middleware('auth');
    Route::post('/', [TransaksiKeluarController::class, 'store'])->middleware('auth');
    Route::get('/{id}', [TransaksiKeluarController::class, 'show'])->middleware('auth');
    Route::get('/{id}/edit', [TransaksiKeluarController::class, 'edit'])->middleware('auth');
    Route::put('/{id}', [TransaksiKeluarController::class, 'update'])->middleware('auth');
    Route::delete('/{id}', [TransaksiKeluarController::class, 'destroy'])->middleware('auth');
});