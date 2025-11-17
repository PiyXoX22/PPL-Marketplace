<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QtyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UpuiController;

// Tampilan User
Route::get('/', function () {
    return view('site.index');
})->name('home');

// Tampilan & CRUD Admin
Route::get('/dashboard', function () {
    return view('home');
})->middleware('auth')->name('home');
Route::resource('produk', ProdukController::class);
Route::resource('qty', QtyController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('harga', HargaController::class);
Route::resource('gambar', GambarController::class);
Route::resource('upui', UpuiController::class);

// Bagian Middlewarenya

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

