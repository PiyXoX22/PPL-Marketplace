<x-headersite/>

{{-- ISI HALAMAN --}}
<main class="container mx-auto px-4 py-12">

    <a href="{{ route('home') }}" class="text-blue-600 hover:underline mb-6 inline-block">← Kembali</a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

        {{-- GAMBAR PRODUK --}}
        <div class="bg-gray-200 rounded-lg w-full h-96 flex items-center justify-center overflow-hidden shadow">
            @if($produk->gambar && $produk->gambar->gambar)
                <img src="{{ asset($produk->gambar->gambar) }}" class="object-cover w-full h-full">
            @else
                <img src="https://via.placeholder.com/500x500" class="object-cover w-full h-full">
            @endif
        </div>

        {{-- INFORMASI PRODUK --}}
        <div>

            {{-- Nama Produk --}}
            <h1 class="text-3xl font-bold mb-2">{{ $produk->nama_produk }}</h1>

            {{-- Harga --}}
            <p class="text-2xl font-semibold mt-3 text-green-700">
                Rp {{ number_format($produk->harga->harga ?? 0, 0, ',', '.') }}
            </p>

            {{-- Review Box --}}
            <div class="mt-4 border rounded-lg p-4 shadow-sm bg-white w-64">
                <div class="flex text-yellow-400 text-xl space-x-1">
                    ★ ★ ★ ★ ☆
                </div>
                <p class="font-semibold mt-2 text-sm">Review Pembeli</p>
                <p class="text-gray-600 text-sm">Produk bagus dan cepat sampai!</p>
            </div>

            {{-- Deskripsi --}}
            <div class="mt-6">
                <h2 class="font-semibold text-xl mb-2">Deskripsi</h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $produk->deskripsi }}
                </p>
            </div>

            {{-- Tombol --}}
            <div class="mt-8 space-y-3 w-60">

                {{-- Tombol Checkout --}}
                <a href="{{ route('checkout.show', $produk->id) }}"
                    class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700 block text-center">
                     Beli Sekarang
                 </a>


                {{-- Tombol Kategori --}}
                <form action="{{ route('cart.add', $produk->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                        Tambah ke Keranjang
                    </button>
                </form>

            </div>

        </div>

    </div>

</main>

</body>
</html>
