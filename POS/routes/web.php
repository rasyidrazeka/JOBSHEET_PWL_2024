<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Routing\Router;
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

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/sell', [SellController::class, 'sell']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/list', [UserController::class, 'list']);
    Route::get('/create', [UserController::class, 'create']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::get('/{id}/edit', [UserController::class, 'edit']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::group(['prefix'=>'level'], function(){
    Route::get('/', [LevelController::class, 'index']);
    Route::post('/list', [LevelController::class, 'list']);
    Route::get('/create', [LevelController::class, 'create']);
    Route::post('/', [LevelController::class, 'store']);
    Route::get('/{id}', [LevelController::class, 'show']);
    Route::get('/{id}/edit', [LevelController::class, 'edit']);
    Route::put('/{id}', [LevelController::class, 'update']);
    Route::delete('/{id}', [LevelController::class, 'destroy']);
});

// Route::get('/user', [UserController::class, 'index']);

// Route::get('/user/tambah', [UserController::class, 'tambah']);

// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

// Route::post('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::prefix('product')->group(function () {
    Route::get('/category/food-beverage', [ProductController::class, 'foodBaverage']);
    Route::get('/category/beauty-health', [ProductController::class, 'beautyHealth']);
    Route::get('/category/home-care', [ProductController::class, 'homeCare']);
    Route::get('/category/baby-kid', [ProductController::class, 'babyKid']);
});

// Route::get('/level', [LevelController::class, 'index']);

Route::get('/kategori', [KategoriController::class, 'index']);

Route::get('/kategori/create', [KategoriController::class, 'create']);

Route::get('/kategori/edit', [KategoriController::class, 'edit']);

Route::post('/kategori', [KategoriController::class, 'store']);

Route::get('/kategori/ubah/{id}', [KategoriController::class, 'ubah']);

Route::post('/kategori/ubah_simpan/{id}', [KategoriController::class, 'ubah_simpan']);

Route::get('/kategori/hapus/{id}', [KategoriController::class, 'hapus']);
