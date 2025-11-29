{{-- Header --}}
<x-headersite/>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>

{{-- Hero Banner Slider --}}
<section style="padding: 40px 0;">

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
    height: 380px; /* BESAR & PROPORISONAL */
    display: flex;
    justify-content: flex-start;
    align-items: center;
    padding: 50px;
    position: relative;
    }

    .banner-left h2 {
        font-size: 32px;
        font-weight: 800;
    }
    .banner-left p {
        font-size: 22px;
        font-weight: 600;
        line-height: 1.3;
    }
    .banner-left span {
        font-size: 42px;
        font-weight: 900;
    }
    .banner-right img {
        width: 260px;
        height: auto;
    }

    /* DOT */
    .banner-nav {
        position: absolute;
        bottom: 15px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
    }
    .dot {
        width: 12px;
        height: 12px;
        background: #ccc;
        border-radius: 50%;
        cursor: pointer;
        transition: 0.3s;
    }
    .dot.active {
        background: #1abc60;
    }

    /* PANAH */
    .arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        padding: 12px 16px;
        font-size: 22px;
        cursor: pointer;
        background: rgba(0,0,0,0.3);
        color: white;
        border-radius: 50%;
        user-select: none;
    }
    .arrow:hover {
        background: rgba(0,0,0,0.5);
    }
    .arrow-left { left: 15px; }
    .arrow-right { right: 15px; }

   /* ===== BACKGROUND SLIDE 1 ===== */
.banner-bg-1 {
    position: relative;
    background-image: url('{{ asset("uploads/buku.jpg") }}');
    background-size: cover;
    background-position: center;
    color: white;
}

/* ===== BACKGROUND SLIDE 2 ===== */
.banner-bg-2 {
    position: relative;
    background-image: url('{{ asset("uploads/hp.jpg") }}');
    background-size: cover;
    background-position: center;
    color: white;
}

/* ===== BACKGROUND SLIDE 3 ===== */
.banner-bg-3 {
    position: relative;
    background-image: url('{{ asset("uploads/fashion.jpg") }}');
    background-size: cover;
    background-position: center;
    color: white;
}

/* Overlay untuk semua background slide */
.banner-overlay {
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0.1); /* mencerahkan */
    z-index: 1;
}

.banner-overlay {
    background: rgba(0,0,0,0.08);
}

.banner-left h2,
.banner-left p,
.banner-left span {
    text-shadow: 0 2px 6px rgba(0,0,0,0.55);
}


/* Teks putih pada slide background */
.banner-bg-1 .banner-left h2,
.banner-bg-1 .banner-left p,
.banner-bg-1 .banner-left span,
.banner-bg-2 .banner-left h2,
.banner-bg-2 .banner-left p,
.banner-bg-2 .banner-left span,
.banner-bg-3 .banner-left h2,
.banner-bg-3 .banner-left p,
.banner-bg-3 .banner-left span {
    color: white !important;
}

</style>


    <div class="banner-slider">

        <!-- Panah -->
        <div class="arrow arrow-left" onclick="prevBanner()">&#10094;</div>
        <div class="arrow arrow-right" onclick="nextBanner()">&#10095;</div>

       <div id="bannerTrack" class="banner-track">

            <!-- SLIDE 1 — BOOKS -->
            <div class="banner-slide banner-bg-1">
                <div class="banner-overlay"></div>

                {{-- <div class="banner-left" style="position: relative; z-index: 2;">
                    <h2>Luaskan Wawasanmu!</h2>
                    <p>Diskon Spesial <br> s.d. <span>90%</span></p>
                </div> --}}
            </div>

            <!-- SLIDE 2 — ELEKTRONIK (BACKGROUND GAMBAR) -->
            <div class="banner-slide banner-bg-2">
                <div class="banner-overlay"></div>

                {{-- <div class="banner-left" style="position: relative; z-index: 2;">
                    <h2>Elektronik Terbaru</h2>
                    <p>Harga Mulai <span>Rp 99Rb</span></p>
                </div> --}}
            </div>

            <!-- SLIDE 3 — PAKAIAN -->
            <div class="banner-slide banner-bg-3">
                <div class="banner-overlay"></div>

                <div class="banner-left" style="position: relative; z-index: 2;">
                    <h2>Fashion Keren</h2>
                    <p>Promo Menarik <br> Diskon <span>50%</span></p>
                </div>
            </div>

        </div>

        <!-- DOT -->
        <div class="banner-nav">
            <div class="dot active" onclick="goToBanner(0)"></div>
            <div class="dot" onclick="goToBanner(1)"></div>
            <div class="dot" onclick="goToBanner(2)"></div>
        </div>

    </div>

</section>

<script>
    let bIndex = 0;
    const track = document.getElementById("bannerTrack");
    const total = track.children.length;
    const dots = document.querySelectorAll(".dot");
    let autoSlide;

    function updateBanner() {
        track.style.transform = "translateX(" + (-bIndex * 100) + "%)";
        dots.forEach((d, i) => d.classList.toggle("active", i === bIndex));
    }

    function nextBanner() {
        bIndex = (bIndex + 1) % total;
        updateBanner();
        resetAutoSlide();
    }

    function prevBanner() {
        bIndex = (bIndex - 1 + total) % total;
        updateBanner();
        resetAutoSlide();
    }

    function goToBanner(i) {
        bIndex = i;
        updateBanner();
        resetAutoSlide();
    }

    function resetAutoSlide() {
        clearInterval(autoSlide);
        autoSlide = setInterval(nextBanner, 4000);
    }

    autoSlide = setInterval(nextBanner, 4000);
</script>


<script>
    let bIndex = 0;
    const track = document.getElementById("bannerTrack");
    const totalBanner = track.children.length;
    const dots = document.querySelectorAll(".dot");

    function updateBanner() {
        track.style.transform = "translateX(" + (-bIndex * 100) + "%)";
        dots.forEach((d, i) => d.classList.toggle("active", i === bIndex));
    }

    function nextBanner() {
        bIndex = (bIndex + 1) % totalBanner;
        updateBanner();
    }

    setInterval(nextBanner, 4000);
</script>


<script>
    let bIndex = 0;
    const track = document.getElementById("bannerTrack");
    const total = track.children.length;
    const dots = document.querySelectorAll(".dot");
    let autoSlide;

    function updateBanner() {
        track.style.transform = "translateX(" + (-bIndex * 100) + "%)";
        dots.forEach((d, i) => d.classList.toggle("active", i === bIndex));
    }

    function nextBanner() {
        bIndex = (bIndex + 1) % total;
        updateBanner();
        resetAutoSlide();
    }

    function prevBanner() {
        bIndex = (bIndex - 1 + total) % total;
        updateBanner();
        resetAutoSlide();
    }

    function goToBanner(i) {
        bIndex = i;
        updateBanner();
        resetAutoSlide();
    }

    function resetAutoSlide() {
        clearInterval(autoSlide);
        autoSlide = setInterval(nextBanner, 4000);
    }

    autoSlide = setInterval(nextBanner, 4000);
</script>

<script>
    let bIndex = 0;
    const track = document.getElementById("bannerTrack");
    const totalBanner = track.children.length;
    const dots = document.querySelectorAll(".dot");

    function updateBanner() {
        track.style.transform = "translateX(" + (-bIndex * 100) + "%)";
        dots.forEach((d, i) => d.classList.toggle("active", i === bIndex));
    }

    function nextBanner() {
        bIndex = (bIndex + 1) % totalBanner;
        updateBanner();
    }

    setInterval(nextBanner, 4000);
</script>


{{-- Search Produk --}}
<div class="container mx-auto px-4 mt-8">
    <form action="{{ route('filter') }}" method="GET" class="flex items-center max-w-md mx-auto">
        <input type="text" name="search" placeholder="Cari produk..." class="w-full p-2 border rounded-l-md focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">Cari</button>
    </form>
</div>

{{-- Daftar Produk --}}
<main class="container mx-auto px-4 py-12" id="produk">
    <h3 class="text-2xl font-bold mb-6">Produk Terbaru</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-0">

        @forelse ($produk as $item)
        <div class="bg-white shadow-md shadow-gray-400 rounded-lg overflow-hidden
            hover:shadow-xl hover:shadow-gray-500 transition
            mb-6 mx-auto w-[300px]">

            {{-- GAMBAR PRODUK --}}
            <img src="{{ $item->gambar ? asset($item->gambar->gambar) : 'https://via.placeholder.com/300x200' }}"
     class="w-full h-60 object-cover">


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
{{-- Floating chat nya --}}
<x-chat />


{{-- Footer --}}
<x-footersite />


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
