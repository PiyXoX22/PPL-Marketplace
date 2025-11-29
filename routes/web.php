<?php

use Illuminate\Support\Facades\Route;

// =======================
// ROUTE API
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
use App\Http\Controllers\Api\ProdukApiController;


// =======================
// PUBLIC ROUTES
// =======================

// Home
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


// Public routes (visitor) -> view di /posts/user
Route::get('/blog', [PostController::class, 'userIndex'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'userShow'])->name('posts.show');


// =======================
// CART & CHECKOUT (AUTH)
// =======================
Route::middleware('auth')->group(function () {

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.destroy');

    // Checkout
    Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout.show');
    Route::get('/checkout-cart', [CheckoutController::class, 'cartCheckout'])
    ->name('checkout.cart');
    Route::get('rajaongkir/', [App\Http\Controllers\RajaOngkirController::class, 'index']);
    Route::get('/cities/{provinceId}', [App\Http\Controllers\RajaOngkirController::class, 'getCities']);
    Route::get('/districts/{cityId}', [App\Http\Controllers\RajaOngkirController::class, 'getDistricts']);
    Route::post('/check-ongkir', [App\Http\Controllers\RajaOngkirController::class, 'checkOngkir']);
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
// USER AREA (PROFILE + ADDRESS)
// =======================
Route::middleware(['auth', 'user'])
    ->prefix('profile')
    ->name('profile.')
    ->group(function () {

    // user profile
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::post('/update', [ProfileController::class, 'update'])->name('update');

    // user address
    Route::resource('address', AddressController::class)->names([
        'index'   => 'address.index',
        'create'  => 'address.create',
        'store'   => 'address.store',
        'show'    => 'address.show',
        'edit'    => 'address.edit',
        'update'  => 'address.update',
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

        Route::middleware(['auth'])
        ->get('/dashboard', fn() => view('home'))
        ->name('dashboard');


    // Produk Manual Form
    Route::get('/produk/buat', [ProdukController::class, 'buat'])->name('produk.buat');
    Route::post('/produk/buat', [ProdukController::class, 'simpanBuat'])->name('produk.simpanBuat');

    // Resource Produk ADMIN
    Route::resource('produk', ProdukController::class)->names([
        'index'   => 'produk.index',
        'create'  => 'produk.create',
        'store'   => 'produk.store',
        'show'    => 'produk.show',
        'edit'    => 'produk.edit',
        'update'  => 'produk.update',
        'destroy' => 'produk.destroy',
    ]);

    // CRUD Admin lainnya
    Route::resource('qty', QtyController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('harga', HargaController::class);
    Route::resource('gambar', GambarController::class);
    Route::resource('upui', UpuiController::class);
    Route::get('/blog', function () {
        return redirect()->route('posts.index');
    });

    Route::resource('posts', PostController::class);
// Admin CRUD kupon
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('coupons', CouponController::class)->except(['show','edit','update','destroy']);
});

    // Export PDF
    Route::get('/produk/export/pdf', [ProdukController::class, 'exportPdf'])
        ->name('produk.export.pdf');

    // Profile + Address Admin
    Route::prefix('profile')->name('profile.')->group(function () {

        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/update', [ProfileController::class, 'update'])->name('update');

        Route::resource('address', AddressController::class)->names([
            'index'   => 'address.index',
            'create'  => 'address.create',
            'store'   => 'address.store',
            'show'    => 'address.show',
            'edit'    => 'address.edit',
            'update'  => 'address.update',
            'destroy' => 'address.destroy',
        ]);
    });
});


// =======================
// PAYMENT MIDTRANS
// =======================
Route::post('/payment', [PaymentController::class, 'generateSnapToken']);
Route::post('/payment/callback', [PaymentController::class, 'callback']);
