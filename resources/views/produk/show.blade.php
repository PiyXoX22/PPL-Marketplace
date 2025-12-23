<x-headersite/>

<main class="container mx-auto px-4 py-12">

    {{-- KEMBALI --}}
    <a href="{{ route('home') }}"
       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition mb-10">
        ← Kembali
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

        {{-- GAMBAR PRODUK --}}
        <div class="bg-gray-200 rounded-lg w-full h-96 flex items-center justify-center overflow-hidden shadow">
            @if($produk->gambar && $produk->gambar->gambar)
                <img src="{{ asset($produk->gambar->gambar) }}" class="object-cover w-full h-full">
            @else
                <img src="https://via.placeholder.com/500x500" class="object-cover w-full h-full">
            @endif
        </div>

        {{-- INFO PRODUK --}}
        <div>

            <h1 class="text-3xl font-bold mb-2">{{ $produk->nama_produk }}</h1>

            <p class="text-2xl font-semibold mt-3 text-green-700">
                Rp {{ number_format($produk->harga->harga ?? 0, 0, ',', '.') }}
            </p>

            {{-- REVIEW BOX --}}
            @php
                $totalReview = $produk->reviews->count();
                $avgRating = $totalReview > 0 ? round($produk->reviews->avg('rating')) : 0;
            @endphp

            <div class="mt-4 border rounded-lg p-4 shadow-sm bg-white w-64">
                <div class="flex text-yellow-400 text-xl space-x-1">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= $avgRating ? '★' : '☆' }}
                    @endfor
                </div>
                <p class="font-semibold mt-2 text-sm">Review Pembeli</p>
                <p class="text-gray-600 text-sm">{{ $totalReview }} ulasan</p>
            </div>

            {{-- DESKRIPSI --}}
            <div class="mt-6">
                <h2 class="font-semibold text-xl mb-2">Deskripsi</h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $produk->deskripsi }}
                </p>
            </div>

            {{-- TOMBOL --}}
            <div class="mt-8 space-y-3 w-60">
                <a href="{{ route('checkout.show', $produk->id) }}"
                   class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700 block text-center">
                    Beli Sekarang
                </a>

                <form action="{{ route('cart.add', $produk->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                        Tambah ke Keranjang
                    </button>
                </form>
            </div>

        </div>
    </div>

    {{-- ================= ULASAN PEMBELI ================= --}}
<div class="mt-16 max-w-xl">

    {{-- LIST REVIEW --}}
    @foreach($produk->reviews as $review)
        <div class="border rounded p-3 mb-3">
            <div class="text-yellow-400">
                @for($i = 1; $i <= 5; $i++)
                    {{ $i <= $review->rating ? '★' : '☆' }}
                @endfor
            </div>
            <p class="font-semibold text-sm">{{ $review->nama }}</p>
            <p class="text-sm text-gray-600">{{ $review->komentar }}</p>
        </div>
    @endforeach

    {{-- FORM REVIEW (HANYA SETELAH CHECKOUT) --}}
    @auth
        @if(
            $produk->sudahDibeliOleh(auth()->id()) &&
            !$produk->reviews->where('user_id', auth()->id())->count()
        )
            <form action="{{ route('review.store', $produk->id) }}"
                  method="POST"
                  class="space-y-3 mt-6 border rounded p-4 bg-white shadow">
                @csrf

                <h3 class="font-semibold text-lg">Tulis Review</h3>

                <select name="rating" class="w-full border rounded px-3 py-2" required>
                    <option value="">Pilih Rating</option>
                    <option value="5">★★★★★</option>
                    <option value="4">★★★★☆</option>
                    <option value="3">★★★☆☆</option>
                    <option value="2">★★☆☆☆</option>
                    <option value="1">★☆☆☆☆</option>
                </select>

                <textarea name="komentar"
                          rows="3"
                          class="w-full border rounded px-3 py-2"
                          placeholder="Tulis ulasan..."
                          required></textarea>

                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Kirim Review
                </button>
            </form>
        @endif
    @endauth

</div>


</main>

</body>
</html>
