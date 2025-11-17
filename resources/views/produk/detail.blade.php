<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - E-Blox Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">

{{-- NAVBAR --}}
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
        <button id="menu-toggle" class="md:hidden text-gray-700 hover:text-blue-600">
            ☰
        </button>
    </div>
</header>

{{-- ISI HALAMAN (DETAIL PRODUK) --}}
<main class="container mx-auto px-4 py-12">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

        {{-- GAMBAR PRODUK (kiri seperti gambar contoh) --}}
        <div class="bg-gray-300 rounded-lg w-full h-96"></div>

        {{-- INFORMASI PRODUK --}}
        <div>

            {{-- Nama Produk --}}
            <h1 class="text-3xl font-bold mb-2">Nama Produk</h1>

            {{-- Harga --}}
            <p class="text-2xl font-semibold mt-3">Rp. 0.000</p>

            {{-- Review Box --}}
            <div class="mt-4 border rounded-lg p-4 shadow-sm bg-white w-64">

                {{-- Bintang --}}
                <div class="flex text-yellow-400 text-xl space-x-1">
                    ★ ★ ★ ★ ☆
                </div>

                <p class="font-semibold mt-2 text-sm">Review title</p>
                <p class="text-gray-600 text-sm">Review body</p>

            </div>

            {{-- Deskripsi --}}
            <div class="mt-6">
                <h2 class="font-semibold text-xl mb-2">Deskripsi</h2>
                <p class="text-gray-700 leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                    Accusamus aperiam libero veniam harum.
                </p>
            </div>

            {{-- Tombol --}}
            <div class="mt-8 space-y-3 w-60">

                <button class="w-full py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                    Keranjang
                </button>

                <button class="w-full py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Kategori
                </button>

            </div>

        </div>

    </div>

</main>

</body>
</html>
