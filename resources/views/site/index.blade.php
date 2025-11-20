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
            <a href="#produk" class="text-gray-700 hover:text-blue-600 transition">Produk</a>
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
            <a href="#produk" class="text-gray-700 hover:text-blue-600">Produk</a>
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
{{-- <section class="bg-blue-600 text-white py-12 text-center relative">
    <h2 class="text-3xl font-bold mb-2">Selamat Datang di E-Blox Store</h2>
    <p class="mt-2 text-lg mb-6">Belanja produk favoritmu dengan mudah & cepat</p> --}}

    {{-- Hero Banner Slider (TOKOPEDIA STYLE) --}}
    <section class="py-10">

        <style>
            .banner-slider {
                position: relative;
                width: 100%;
                max-width: 1200px;
                margin: auto;
                overflow: hidden;
                border-radius: 18px;
            }
            .banner-track {
                display: flex;
                transition: transform 0.5s ease-in-out;
            }
            .banner-slide {
                min-width: 100%;
                background: #ffefbf; /* warna kuning soft tokopedia */
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 40px;
            }
            .banner-left h2 {
                font-size: 32px;
                font-weight: 800;
                color: #000;
            }
            .banner-left p {
                font-size: 22px;
                font-weight: 600;
                color: #333;
                line-height: 1.3;
            }
            .banner-left span {
                font-size: 42px;
                font-weight: 900;
                color: #000;
            }
            .banner-right img {
                width: 260px;
                height: auto;
            }
            .banner-nav {
                position: absolute;
                bottom: 15px;
                left: 50%;
                transform: translateX(-50%);
                display: flex;
                gap: 8px;
            }
            .dot {
                width: 10px;
                height: 10px;
                background: #ccc;
                border-radius: 50%;
                transition: 0.3s;
            }
            .dot.active {
                background: #1abc60;
            }
        </style>

        <div class="banner-slider">
            <div id="bannerTrack" class="banner-track">

                {{-- SLIDE 1 --}}
                <div class="banner-slide">
                    <div class="banner-left">
                        <h2>NYAM!</h2>
                        <p>Belanja Bulanan Hemat <br>
                            Diskon s.d. <span>50%</span>
                        </p>
                    </div>
                    <div class="banner-right">
                        <img src="https://i.ibb.co/0fSzF5F/muesli.png" alt="Produk 1">
                    </div>
                </div>

                {{-- SLIDE 2 --}}
                <div class="banner-slide">
                    <div class="banner-left">
                        <h2>Promo Spesial</h2>
                        <p>Dapatkan Produk Terbaik <br>
                            Mulai dari <span>Rp 10Rb</span>
                        </p>
                    </div>
                    <div class="banner-right">
                        <img src="https://i.ibb.co/ZV3BsCS/snack.png" alt="Produk 2">
                    </div>
                </div>

                {{-- SLIDE 3 --}}
                <div class="banner-slide">
                    <div class="banner-left">
                        <h2>Belanja Hemat</h2>
                        <p>Gratis Ongkir <br>
                            s.d. <span>Rp 20.000</span>
                        </p>
                    </div>
                    <div class="banner-right">
                        <img src="https://i.ibb.co/6qwWfNH/choco.png" alt="Produk 3">
                    </div>
                </div>

            </div>

            {{-- DOT NAV --}}
            <div class="banner-nav">
                <div class="dot active"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>

    </section>

    <!-- Tombol Navigasi Berfungsi -->
    <button class="nav-btn prev" onclick="prevSlide()">‹</button>
    <button class="nav-btn next" onclick="nextSlide()">›</button>
</div>

<script>
let index = 0;
const slider = document.getElementById("slider");
const totalSlides = slider.children.length;

function showSlide() {
    slider.style.transform = "translateX(" + (-index * 100) + "%)";
}

function nextSlide() {
    index = (index + 1) % totalSlides;
    showSlide();
}

function prevSlide() {
    index = (index - 1 + totalSlides) % totalSlides;
    showSlide();
}

// Auto slide
setInterval(nextSlide, 4000);
</script>


    <a href="#produk" class="inline-block px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow hover:bg-gray-100">  </a>
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

        @forelse ($produk as $item)
        <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition">

            {{-- GAMBAR PRODUK --}}
            <img src="{{ $item->gambar ?? 'https://via.placeholder.com/300x200' }}"
                 alt="{{ $item->nama_produk }}"
                 class="w-full h-40 object-cover">

            <div class="p-4">
                {{-- NAMA PRODUK --}}
                <h4 class="font-semibold text-lg">{{ $item->nama_produk }}</h4>

                {{-- HARGA PRODUK --}}
                <p class="text-gray-600">
                    Rp {{ number_format($item->harga->harga ?? 0, 0, ',', '.') }}
                </p>

                {{-- BUTTON BELI --}}
                <a href="{{ route('produk.show', $item->id) }}">
                    <button class="mt-3 w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Lihat Barang
                    </button>
                </a>

            </div>

        </div>
        @empty
            <p class="text-gray-500">Tidak ada produk tersedia.</p>
        @endforelse

    </div>
</main>
<x-chat />

{{-- Footer --}}
<footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="container mx-auto px-4 text-center">

        <p class="mb-4">&copy; {{ date('Y') }} E-Blox Store. Semua Hak Dilindungi.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
           {{-- Metode Pembayaran --}}
<div>
    <h3 class="font-semibold text-lg mb-2">Metode Pembayaran</h3>
    <div class="flex justify-center gap-4">
      <img src="https://1000logos.net/wp-content/uploads/2017/06/VISA-Logo-2006.png" alt="Visa" class="h-8">
      <img src="https://w7.pngwing.com/pngs/169/96/png-transparent-logo-mastercard-graphics-font-visa-mastercard-text-label-logo.png" alt="MasterCard" class="h-8">
      <img src="https://www.vectorlogo.zone/logos/paypal/paypal-icon.svg" alt="PayPal" class="h-6">
      <img src="https://i.pinimg.com/474x/06/bd/ea/06bdea70eb048176056881cad078453a.jpg" alt="DANA" class="h-8">
      <img src="https://i.pinimg.com/1200x/02/2e/98/022e9877180fdc3ef50f973e7620547d.jpg" alt="OVO" class="h-8">
    </div>
    <br>
    <br>
    <h3 class="font-semibold text-lg mb-2">Jelajahi Kami</h3>
    <a href="asd" class="text-decoration-none hover-underline">Tentang Kami</a><br>
    <a href="asd" class="text-decoration-none hover-underline">Kebijakan Dan Privasi</a><br>
    <a href="asd" class="text-decoration-none hover-underline">Tim Pengembang</a>

    <style>
    .hover-underline:hover {
        text-decoration: underline;
    }
    </style>

  </div>

  {{-- Jasa Pengiriman --}}
  <div>
    <h3 class="font-semibold text-lg mb-2">Jasa Pengiriman</h3>
    <div class="flex justify-center gap-4">
      <img src="https://p7.hiclipart.com/preview/963/726/406/jne-margonda-jalur-nugraha-ekakurir-business-jne-bale-endah-courier-business.jpg" alt="JNE" class="h-8">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUde2rd0WVTmwMAf-PJk-BrxsOdz-DzQCaGw&s" alt="POS Indonesia" class="h-8">
      <img src="https://1000logos.net/wp-content/uploads/2022/08/JT-Express-Logo.png" alt="J&T" class="h-8">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtsKUl2eXFCxNAra3HPdvMZuItRBg7vksbUQ&s" alt="SiCepat" class="h-8">
      <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhyQDuujSmDAkPW3GoCII4rd9zIq7bC-BD1RB4xOVdj-HGXQCaxnJdI63n6YbsTYpE9QxQ5EsWWCSrotHoxGXBqOXfEbjHGMaflvceUxue7jqH9rRl6evQSoXn2dYPBH8VHmrwqo_TsKCC7odhZkIXn9F6D7FWSE0cqhXJIwAyvR6a6RijBepjAfbJR/s320/GKL24_GoSend%20-%20Koleksilogo.com.jpg" alt="GoSend" class="h-8">
    </div>
    <br>
    <br>
    <h3 class="font-semibold text-lg mb-2">Sosial Media</h3>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <div class="d-flex gap-3" style="font-size: 40px;">
        <a href="https://facebook.com" class="text-primary">
            <i class="bi bi-facebook"></i>
        </a>
        <a href="https://instagram.com" class="text-danger">
            <i class="bi bi-instagram"></i>
        </a>
        <a href="https://twitter.com" class="text-info">
            <i class="bi bi-twitter"></i>
        </a>
        <a href="https://youtube.com" class="text-danger">
            <i class="bi bi-youtube"></i>
        </a>
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
