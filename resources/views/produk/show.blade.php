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

            {{-- RINGKASAN RATING --}}
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

    {{-- ================= ULASAN ================= --}}
    <div class="mt-16 max-w-xl">

        <h2 class="text-xl font-semibold mb-4">Ulasan Pembeli</h2>

        {{-- LIST REVIEW --}}
        @forelse($produk->reviews as $review)
            <div class="border rounded p-3 mb-3 bg-white shadow-sm">
                <div class="text-yellow-400 mb-1">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= $review->rating ? '★' : '☆' }}
                    @endfor
                </div>
                <p class="font-semibold text-sm">
                    {{ $review->user->name ?? 'User' }}
                </p>
                <p class="text-sm text-gray-600">
                    {{ $review->komentar }}
                </p>
            </div>
        @empty
            <p class="text-gray-500 text-sm">Belum ada ulasan.</p>
        @endforelse

        {{-- ================= FORM REVIEW ================= --}}
        <div class="mt-6">

            @guest
                <div class="border rounded p-4 bg-yellow-50 text-sm">
                    Silakan
                    <a href="{{ route('login') }}" class="text-blue-600 font-semibold">
                        login
                    </a>
                    untuk memberikan ulasan.
                </div>
            @endguest

            @auth
                @if(!$produk->reviews->where('user_id', auth()->id())->count())
                    <form action="{{ route('review.store', $produk->id) }}"
                          method="POST"
                          class="space-y-4 mt-6 border rounded p-4 bg-white shadow">
                        @csrf

                        <h3 class="font-semibold text-lg">Tulis Review</h3>

                        {{-- ⭐ STAR RATING --}}
                        <div class="flex flex-row-reverse justify-end rating">
                            @for($i = 5; $i >= 1; $i--)
                                <input
                                    type="radio"
                                    id="star{{ $i }}"
                                    name="rating"
                                    value="{{ $i }}"
                                    class="hidden"
                                    required
                                >
                                <label
                                    for="star{{ $i }}"
                                    class="text-3xl cursor-pointer text-gray-300 select-none"
                                >
                                    ★
                                </label>
                            @endfor
                        </div>

                        {{-- KOMENTAR --}}
                        <textarea
                            name="komentar"
                            rows="3"
                            class="w-full border rounded px-3 py-2"
                            placeholder="Tulis ulasan..."
                            required></textarea>

                        <button class="bg-blue-600 text-white px-4 py-2 rounded">
                            Kirim Review
                        </button>
                    </form>
                @else
                    <p class="text-sm text-gray-500 mt-4">
                        Anda sudah memberikan review.
                    </p>
                @endif
            @endauth

        </div>
    </div>

</main>

{{-- ⭐ STYLE STAR RATING --}}
<style>
.rating label:hover,
.rating label:hover ~ label {
    color: #facc15;
}
.rating input:checked ~ label {
    color: #facc15;
}
</style>

</body>
</html>
