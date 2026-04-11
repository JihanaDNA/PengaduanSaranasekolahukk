<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\RiwayatAspirasiController;
use App\Http\Controllers\Siswa\AspirasiController;
use App\Http\Controllers\Siswa\ProfileController;


// LOGIN
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// ADMIN
Route::middleware('admin')->group(function () {

    Route::get('/admin/dashboard', [AdminDashboard::class, 'index']);

    // kategori
    Route::get('/admin/kategori', [KategoriController::class, 'index']);
    Route::get('/admin/kategori/create', [KategoriController::class, 'create']);
    Route::post('/admin/kategori/store', [KategoriController::class, 'store']);
    Route::get('/admin/kategori/edit/{id}', [KategoriController::class, 'edit']);
    Route::post('/admin/kategori/update/{id}', [KategoriController::class, 'update']);
    Route::get('/admin/kategori/delete/{id}', [KategoriController::class, 'destroy']);

    // siswa
    Route::get('/admin/siswa', [SiswaController::class, 'index']);
    Route::get('/admin/siswa/create', [SiswaController::class, 'create']);
    Route::post('/admin/siswa/store', [SiswaController::class, 'store']);

    // riwayat aspirasi
    Route::get('/admin/riwayat-aspirasi', [RiwayatAspirasiController::class, 'index']);
    Route::post('/admin/riwayat-aspirasi/update-status/{id}', [RiwayatAspirasiController::class, 'updateStatus']);

});


// SISWA
Route::middleware('siswa')->group(function () {

    Route::get('/siswa/dashboard', [SiswaDashboard::class, 'index']);

    // aspirasi
    Route::get('/siswa/aspirasi', [AspirasiController::class, 'index']);
    Route::get('/siswa/aspirasi/create', [AspirasiController::class, 'create']);
    Route::post('/siswa/aspirasi/store', [AspirasiController::class, 'store']);

    // profile
    Route::get('/siswa/profile', [ProfileController::class, 'index']);

});