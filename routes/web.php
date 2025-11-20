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
    use App\Http\Controllers\RegisterController;

    // Tampilan User
    Route::get('/', [SiteController::class, 'index'])->name('home');



    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::get('/cart', function () {
        return view('cart.index');
    })->name('cart.index');

    Route::get('/produk/detail', function () {
        return view('produk.detail');
    })->name('produk.detail');

    Route::get('/checkout', function () {
        return view('checkout.index');
    })->name('checkout.index');

//Harga
Route::get('/harga', [HargaController::class, 'index'])->name('harga.index');
Route::post('/harga', [HargaController::class, 'store'])->name('harga.store');
Route::delete('/harga/{id}', [HargaController::class, 'destroy'])->name('harga.destroy');
Route::get('/harga/{id}/edit', [HargaController::class, 'edit'])->name('harga.edit');
Route::put('/harga/{id}', [HargaController::class, 'update'])->name('harga.update');


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

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('home');
        });
    });
    Route::middleware(['user'])->group(function () {
        Route::get('/home', action: function () {
            return view('site.index');
        });
    });

