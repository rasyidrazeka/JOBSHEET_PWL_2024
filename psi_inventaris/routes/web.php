<?php

use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdministrasiController;

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