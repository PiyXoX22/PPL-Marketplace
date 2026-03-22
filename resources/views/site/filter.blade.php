<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Filter Produk - E-Blox Store</title>

<style>

/* ================= GLOBAL ================= */
body {
    font-family: Arial, sans-serif;
    background: #f3f4f6;
    margin: 0;
    padding: 0;
    padding-top: 0px;
    transition: .3s;
}

/* DARK MODE GLOBAL */
.dark body {
    background: #0f172a;
    color: #e2e8f0;
}

/* ================= CONTAINER ================= */
.utama-container {
    max-width: 1200px;
    margin: auto;
    display: flex;
    gap: 24px;
    padding: 20px;
}

/* ================= SIDEBAR ================= */
.sidebar {
    width: 260px;
    min-width: 240px;
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    /* position: sticky; */
    top: 100px;
    align-self: flex-start; /* 🔥 biar gak stretch */
}

/* 🔥 DARK SIDEBAR */
.dark .sidebar {
    background: #1e293b;
    box-shadow: 0 2px 10px rgba(0,0,0,0.5);
}

.sidebar h3 {
    margin-top: 0;
    color: #1a73e8;
}

/* ================= DROPDOWN ================= */
.select-box {
    position: relative;
    margin-top: 6px;
}

.select-box select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #ddd;
    appearance: none;
    background: #f9fafb;
    cursor: pointer;
    font-size: 14px;
}

/* 🔥 DARK DROPDOWN */
.dark .select-box select {
    background: #0f172a;
    border: 1px solid #334155;
    color: white;
}

.select-box::after {
    content: "▼";
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 12px;
    color: #666;
}

/* ================= PRODUK ================= */
.product-container {
    flex: 1;
}

.product-container h2 {
    margin-bottom: 4px;
}

/* 🔥 DARK TEXT */
.dark .product-container p {
    color: #94a3b8;
}

.product-container p {
    color: #666;
    margin-bottom: 20px;
}

/* ================= GRID ================= */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
}

/* ================= CARD ================= */
.card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #eee;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    transition: 0.25s;
    position: relative;
}

/* 🔥 DARK CARD */
.dark .card {
    background: #1e293b;
    border: 1px solid #334155;
    box-shadow: 0 4px 12px rgba(0,0,0,0.5);
}

.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.12);
}

/* 🔥 DARK HOVER */
.dark .card:hover {
    box-shadow: 0 12px 25px rgba(0,0,0,0.8);
}

.card img {
    width: 100%;
    height: 170px;
    object-fit: cover;
}

.card-body {
    padding: 12px;
}

/* TEXT */
.title {
    font-size: 15px;
    font-weight: bold;
}

/* 🔥 DARK TEXT */
.dark .title {
    color: #e2e8f0;
}

/* ================= PRICE ================= */
.price-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 6px;
}

.price {
    color: #1a73e8;
    font-weight: bold;
}

/* ================= STOK ================= */
.stok-aman { color: #22c55e; font-size: 13px; }
.stok-warning { color: #f59e0b; font-weight: bold; font-size: 13px; }
.stok-habis { color: #ef4444; font-weight: bold; font-size: 13px; }

/* ================= BUTTON ================= */
.btn-view {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background: #1a73e8;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.2s;
}

.btn-view:hover {
    background: #155acb;
}

.btn-disabled {
    background: gray;
    cursor: not-allowed;
}

/* ================= STATUS ================= */
.card-disabled {
    opacity: 0.6;
}

/* 🔥 DARK SOLD OUT */
.sold-out {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(0,0,0,0.6);
    color: white;
    padding: 4px 8px;
    font-size: 12px;
    border-radius: 6px;
}

/* ================= RESPONSIVE ================= */

/* Tablet */
@media (max-width: 1024px) {
    .utama-container {
        max-width: 95%;
    }
}

/* Mobile */
@media (max-width: 768px) {

    .utama-container {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        position: static;
    }

    .product-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* HP */
@media (max-width: 480px) {
    .product-grid {
        grid-template-columns: 1fr;
    }
}

</style>
</head>

<body>

<x-headersite/>

<div class="utama-container">

<!-- SIDEBAR -->
<div class="sidebar">
    <h3>Filter</h3>

    <form method="GET" action="{{ route('filter') }}">
        <input type="hidden" name="search" value="{{ request('search') }}">

        <strong>Kategori</strong>
        <div class="select-box">
            <select name="kategori">
                <option value="">Semua Kategori</option>
                @foreach ($kategoriList as $k)
                <option value="{{ $k->kategori }}"
                {{ request('kategori') == $k->kategori ? 'selected' : '' }}>
                {{ $k->kategori }}
                </option>
                @endforeach
            </select>
        </div>

        <br>

        <strong>Harga</strong>
        <div class="select-box">
            <select name="harga">
                <option value="">Semua Harga</option>
                <option value="0-50000">0 - 50rb</option>
                <option value="50000-100000">50rb - 100rb</option>
                <option value="100000-500000">100rb - 500rb</option>
                <option value="500000-999999999">> 500rb</option>
            </select>
        </div>

        <br>

        <strong>Urutkan</strong>
        <div class="select-box">
            <select name="sort">
                <option value="">Default</option>
                <option value="termurah">Termurah</option>
                <option value="termahal">Termahal</option>
                <option value="terbaru">Terbaru</option>
            </select>
        </div>

        <br>

        <button type="submit" class="btn-view">Terapkan Filter</button>
    </form>
</div>

<!-- PRODUK -->
<div class="product-container">
    <h2>Daftar Produk</h2>
    <p>Menampilkan {{ count($produk) }} produk</p>

    <div class="product-grid">
        @foreach ($produk as $p)

        @php $stok = $p->stok->qty ?? 0; @endphp

        <div class="card {{ $stok == 0 ? 'card-disabled' : '' }}">

            <img src="{{ $p->gambar ? asset($p->gambar->gambar) : 'https://via.placeholder.com/300x200' }}">

            @if($stok == 0)
                <div class="sold-out">SOLD OUT</div>
            @endif

            <div class="card-body">

                <div class="title">{{ $p->nama_produk }}</div>

                <div class="price-row">
                    <div class="price">
                        Rp {{ number_format($p->harga->harga ?? 0, 0, ',', '.') }}
                    </div>

                    @if($stok > 0 && $stok <= 5)
                        <span class="stok-warning">Sisa {{ $stok }}</span>
                    @elseif($stok > 5)
                        <span class="stok-aman">Stok {{ $stok }}</span>
                    @else
                        <span class="stok-habis">Habis</span>
                    @endif
                </div>

                @if($stok > 0)
                    <a href="{{ route('produk.show', $p->id) }}">
                        <button class="btn-view">Lihat Barang</button>
                    </a>
                @else
                    <button class="btn-view btn-disabled">Stok Habis</button>
                @endif

            </div>
        </div>

        @endforeach
    </div>
</div>
<x-scroll/>
</div>
<x-footersite/>
</body>
</html>