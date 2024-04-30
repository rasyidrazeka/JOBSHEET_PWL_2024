<?php

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\BarangController;
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

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::group(['prefix'=>'administrasi'], function(){
    Route::get('/', [AdministrasiController::class, 'index']);
    Route::post('/list', [AdministrasiController::class, 'list']);
    Route::get('/create', [AdministrasiController::class, 'create']);
    Route::post('/', [AdministrasiController::class, 'store']);
    Route::get('/{id}', [AdministrasiController::class, 'show']);
    Route::get('/{id}/edit', [AdministrasiController::class, 'edit']);
    Route::put('/{id}', [AdministrasiController::class, 'update']);
    Route::delete('/{id}', [AdministrasiController::class, 'destroy']);
});

Route::group(['prefix'=>'barang'], function(){
    Route::get('/', [BarangController::class, 'index']);
    Route::post('/list', [BarangController::class, 'list']);
    Route::get('/create', [BarangController::class, 'create']);
    Route::post('/', [BarangController::class, 'store']);
    Route::get('/{id}', [BarangController::class, 'show']);
    Route::get('/{id}/edit', [BarangController::class, 'edit']);
    Route::put('/{id}', [BarangController::class, 'update']);
    Route::delete('/{id}', [BarangController::class, 'destroy']);
});

Route::group(['prefix'=>'transaksiMasuk'], function(){
    Route::get('/', [TransaksiMasukController::class, 'index']);
    Route::post('/list', [TransaksiMasukController::class, 'list']);
    Route::get('/create', [TransaksiMasukController::class, 'create']);
    Route::post('/', [TransaksiMasukController::class, 'store']);
    Route::get('/{id}', [TransaksiMasukController::class, 'show']);
    Route::get('/{id}/edit', [TransaksiMasukController::class, 'edit']);
    Route::put('/{id}', [TransaksiMasukController::class, 'update']);
    Route::delete('/{id}', [TransaksiMasukController::class, 'destroy']);
});