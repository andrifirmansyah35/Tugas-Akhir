<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriLayananController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\KategoriOperasiController;


Route::get('/login', [LoginController::class,'index']);

Route::get('/', [DashboardController::class,'index']);
// Route::get('/kategori_layanan', [KategoriLayananController::class,'index']);


Route::get('/kategori_layanan/checkSlug',[KategoriLayananController::class,'checkSlug']);
Route::resource('/kategori_layanan', KategoriLayananController::class);

// Route::get('/layanan/checkSlug',[LayananController::class,'checkSlug']);
Route::get('/layanan/status/{layanan:slug}',[LayananController::class,'updateStatus']);
Route::get('/layanan/status2/{layanan:slug}',[LayananController::class,'updateStatus2']);
Route::resource('/layanan', LayananController::class);

Route::resource('/kategori_operasi', KategoriOperasiController::class);