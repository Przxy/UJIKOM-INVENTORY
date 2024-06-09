<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangMasukGudangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KategoriBarangController;

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

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('barangs_masuk', BarangMasukController::class);
    Route::resource('barangs', BarangController::class);
    Route::resource('users', UserController::class);
    Route::resource('barang_keluars', BarangKeluarController::class);
    Route::resource('kategoris', KategoriBarangController::class);
});

Route::group(['middleware' => ['auth', 'role:gudang'], 'prefix' => 'gudang', 'as' => 'gudang.'], function () {
    Route::get('/dashboard', [GudangController::class, 'index'])->name('dashboard');
    Route::resource('gudang_barangs_masuk', BarangMasukGudangController::class);
});



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
