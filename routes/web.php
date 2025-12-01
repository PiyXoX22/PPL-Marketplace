<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProdukApiController;
// =======================
// API ROUTES
// =======================
use App\Http\Controllers\OtpController;


Route::prefix('api')->name('api.')->group(function () {
    Route::apiResource('produk', ProdukApiController::class);
});

// =======================
// CONTROLLERS
// =======================
use App\Http\Controllers\QtyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UpuiController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KategoriController;



use App\Http\Controllers\RajaOngkirController;


// =======================
// PUBLIC ROUTES
// =======================
Route::get('/', [SiteController::class, 'index'])->name('home');

// OTP
Route::get('/otp', [OtpController::class, 'form'])->name('otp.form');
Route::post('/otp/request', [OtpController::class, 'requestOtp'])->name('otp.request');
Route::post('/otp/login', [OtpController::class, 'login'])->name('otp.login');

// Produk PUBLIC
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/produk/detail', fn() => view('produk.detail'))->name('produk.detail');

// Filter Produk
Route::get('/filter', [FilterController::class, 'index'])->name('filter');

// Blog visitor
Route::get('/blog', [PostController::class, 'userIndex'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'userShow'])->name('posts.show');


// =======================
// RAJA ONGKIR AJAX ROUTES
// =======================
Route::get('/cities/{provinceId}', [RajaOngkirController::class, 'getCities']);
Route::get('/districts/{cityId}', [RajaOngkirController::class, 'getDistricts']);
Route::post('/check-ongkir', [RajaOngkirController::class, 'checkOngkir']);


// =======================
// CART & CHECKOUT (AUTH)
// =======================
Route::middleware('auth')->group(function () {
    
    // Cart System
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.destroy');

    // Checkout
    Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout.show');

    Route::get('/checkout-cart', [CheckoutController::class, 'cartCheckout'])
    ->name('checkout.cart');
    Route::post('/checkout-cart/pay', [CheckoutController::class, 'payCart'])->name('checkout.cart.pay');
    Route::get('rajaongkir/', [App\Http\Controllers\RajaOngkirController::class, 'index']);
    Route::get('/cities/{provinceId}', [App\Http\Controllers\RajaOngkirController::class, 'getCities']);
    Route::get('/districts/{cityId}', [App\Http\Controllers\RajaOngkirController::class, 'getDistricts']);
    Route::post('/check-ongkir', [App\Http\Controllers\RajaOngkirController::class, 'checkOngkir']);

    Route::get('/checkout-cart', [CheckoutController::class, 'cartCheckout'])->name('checkout.cart');

    // NEW — PROSES BAYAR (POST)
    Route::post('/checkout/pay', [CheckoutController::class, 'pay'])->name('checkout.pay');

});


// =======================
// AUTH ROUTES
// =======================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// =======================
// USER AREA (PROFILE & ADDRESS)
// =======================
Route::middleware(['auth', 'user'])
    ->prefix('profile')
    ->name('profile.')
    ->group(function () {

        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/update', [ProfileController::class, 'update'])->name('update');

        Route::resource('address', AddressController::class)
            ->except(['show'])
            ->names([
                'index' => 'address.index',
                'create' => 'address.create',
                'store' => 'address.store',
                'edit' => 'address.edit',
                'update' => 'address.update',
                'destroy' => 'address.destroy',
            ]);
    });


// =======================
// ADMIN AREA
// =======================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', fn() => view('home'))->name('dashboard');

        Route::resource('produk', ProdukController::class);
        Route::resource('qty', QtyController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('harga', HargaController::class);
        Route::resource('gambar', GambarController::class);
        Route::resource('upui', UpuiController::class);
        Route::resource('posts', PostController::class);

        Route::resource('coupons', CouponController::class)
            ->except(['show','edit','update','destroy']);

        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::post('/update', [ProfileController::class, 'update'])->name('update');
            Route::resource('address', AddressController::class)->except(['show']);
        });
    });


// =======================
// PAYMENT MIDTRANS
// =======================
Route::post('/payment', [PaymentController::class, 'generateSnapToken']);
Route::post('/payment/callback', [PaymentController::class, 'callback']);
