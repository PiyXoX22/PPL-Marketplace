<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QtyController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UpuiController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;


// ===========================
// Tampilan Untuk User (Public)
// ===========================

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CheckoutController;

// Tampilan User

Route::get('/', [SiteController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


Route::get('/cart', fn() => view('cart.index'))->name('cart.index');
Route::get('/produk/detail', fn() => view('produk.detail'))->name('produk.detail');
Route::get('/checkout', fn() => view('checkout.index'))->name('checkout.index');

// ===========================
// Auth Routes
// ===========================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ===========================
// ADMIN AREA (Hanya Admin)
// ===========================
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', fn() => view('home'))->name('dashboard');

    // Semua CRUD Admin

// Profile User (harus login)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Cart
Route::get('/cart', function () {
    return view('cart.index');
})->name('cart.index');

// Produk Detail
Route::get('/produk/detail', function () {
    return view('produk.detail');
})->name('produk.detail');


// ==========================================
// ✔ CHECKOUT DINAMIS (PENTING)
// ==========================================
Route::get('/checkout/{id}', [CheckoutController::class, 'index'])
    ->name('checkout.show');


// ==========================================
// CRUD Admin
// ==========================================
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');

    Route::resource('produk', ProdukController::class);
    Route::resource('qty', QtyController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('harga', HargaController::class); // cukup resource
    Route::resource('gambar', GambarController::class);
    Route::resource('upui', UpuiController::class);
});


});

// ===========================
// USER AREA (Hanya User)
// ===========================
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/home', fn() => view('site.index'));
});



// ==========================================
// AUTH
// ==========================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Role Middleware
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    });
});

Route::middleware(['user'])->group(function () {
    Route::get('/home', function () {
        return view('site.index');
    });
});
