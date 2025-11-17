<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Blox Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

{{-- Navbar --}}
<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <span class="text-2xl font-extrabold text-blue-600">E-Blox Store</span>
        </a>
        <nav class="hidden md:flex space-x-6 font-medium">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition">Home</a>
            <a href="{{ route('produk.index') }}" class="text-gray-700 hover:text-blue-600 transition">Produk</a>
            <a href="{{ route('kategori.index') }}" class="text-gray-700 hover:text-blue-600 transition">Kategori</a>
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">Login</a>
        </nav>
        <button id="menu-toggle" class="md:hidden text-gray-700 hover:text-blue-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200">
        <nav class="flex flex-col space-y-2 p-4 font-medium">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Home</a>
            <a href="{{ route('produk.index') }}" class="text-gray-700 hover:text-blue-600">Produk</a>
            <a href="{{ route('kategori.index') }}" class="text-gray-700 hover:text-blue-600">Kategori</a>
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
        </nav>
    </div>
</header>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>

{{-- Hero Section --}}
<section class="bg-blue-600 text-white py-12 text-center relative">
    <h2 class="text-3xl font-bold mb-2">Selamat Datang di E-Blox Store</h2>
    <p class="mt-2 text-lg mb-6">Belanja produk favoritmu dengan mudah & cepat</p>

    {{-- Slider Gambar --}}
    <div class="relative w-full max-w-3xl mx-auto overflow-hidden rounded-lg shadow-lg mb-6">
        <div id="slider" class="flex transition-transform duration-700">
            <img src="https://via.placeholder.com/900x300/2563EB/FFFFFF?text=Promo+1" class="w-full flex-shrink-0">
            <img src="https://via.placeholder.com/900x300/059669/FFFFFF?text=Promo+2" class="w-full flex-shrink-0">
            <img src="https://via.placeholder.com/900x300/DC2626/FFFFFF?text=Promo+3" class="w-full flex-shrink-0">
        </div>
        <!-- Tombol Navigasi -->
        <button onclick="prevSlide()" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white text-blue-600 px-2 py-1 rounded-full shadow">‹</button>
        <button onclick="nextSlide()" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white text-blue-600 px-2 py-1 rounded-full shadow">›</button>
    </div>

    <a href="#produk" class="inline-block px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow hover:bg-gray-100">Belanja Sekarang</a>
</section>

{{-- Search Produk --}}
<div class="container mx-auto px-4 mt-8">
    <form action="{{ route('produk.index') }}" method="GET" class="flex items-center max-w-md mx-auto">
        <input type="text" name="search" placeholder="Cari produk..." class="w-full p-2 border rounded-l-md focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">Cari</button>
    </form>
</div>

{{-- Daftar Produk --}}
<main class="container mx-auto px-4 py-12" id="produk">
    <h3 class="text-2xl font-bold mb-6">Produk Terbaru</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ([
            ['nama' => 'Sepatu Sport', 'harga' => 250000, 'gambar' => 'https://via.placeholder.com/300x200'],
            ['nama' => 'Tas Ransel', 'harga' => 180000, 'gambar' => 'https://via.placeholder.com/300x200'],
            ['nama' => 'Headphone', 'harga' => 320000, 'gambar' => 'https://via.placeholder.com/300x200'],
            ['nama' => 'Kemeja Casual', 'harga' => 150000, 'gambar' => 'https://via.placeholder.com/300x200'],
        ] as $produk)
        <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition">
            <img src="{{ $produk['gambar'] }}" alt="{{ $produk['nama'] }}" class="w-full h-40 object-cover">
            <div class="p-4">
                <h4 class="font-semibold text-lg">{{ $produk['nama'] }}</h4>
                <p class="text-gray-600">Rp {{ number_format($produk['harga'], 0, ',', '.') }}</p>
                <button class="mt-3 w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Beli</button>
            </div>
        </div>
        @endforeach
    </div>
</main>

{{-- Footer --}}
<footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="container mx-auto px-4 text-center">

        <p class="mb-4">&copy; {{ date('Y') }} E-Blox Store. Semua Hak Dilindungi.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
           {{-- Metode Pembayaran --}}
<div>
    <h3 class="font-semibold text-lg mb-2">Metode Pembayaran</h3>
    <div class="flex justify-center gap-4">
      <img src="https://www.vectorlogo.zone/logos/visa/visa-icon.svg" alt="Visa" class="h-6">
      <img src="https://www.vectorlogo.zone/logos/mastercard/mastercard-icon.svg" alt="MasterCard" class="h-6">
      <img src="https://www.vectorlogo.zone/logos/paypal/paypal-icon.svg" alt="PayPal" class="h-6">
      <img src="https://seeklogo.com/images/D/dana-logo-33C9D7C056-seeklogo.com.png" alt="DANA" class="h-6">
      <img src="https://seeklogo.com/images/O/ovo-logo-14D4D3B6E7-seeklogo.com.png" alt="OVO" class="h-6">
    </div>
  </div>

  {{-- Jasa Pengiriman --}}
  <div>
    <h3 class="font-semibold text-lg mb-2">Jasa Pengiriman</h3>
    <div class="flex justify-center gap-4">
      <img src="https://upload.wikimedia.org/wikipedia/id/1/1e/JNE_logo.png" alt="JNE" class="h-8">
      <img src="https://upload.wikimedia.org/wikipedia/commons/0/0d/Pos_Indonesia_logo.svg" alt="POS Indonesia" class="h-8">
      <img src="https://1000logos.net/wp-content/uploads/2021/04/JT-Express-logo.png" alt="J&T" class="h-8">
      <img src="https://seeklogo.com/images/S/si-cepat-ekspres-logo-0C74E0D0F6-seeklogo.com.png" alt="SiCepat" class="h-8">
      <img src="https://seeklogo.com/images/G/gosend-logo-6C9411F245-seeklogo.com.png" alt="GoSend" class="h-8">
    </div>
  </div>
        </div>

    </div>
</footer>


{{-- Slider Script --}}
<script>
    let index = 0;
    const slider = document.getElementById('slider');
    const slides = slider.children;
    function showSlide(i) {
        index = (i + slides.length) % slides.length;
        slider.style.transform = `translateX(${-index * 100}%)`;
    }
    function nextSlide() { showSlide(index + 1); }
    function prevSlide() { showSlide(index - 1); }
    setInterval(nextSlide, 4000);
</script>

</body>
</html>
