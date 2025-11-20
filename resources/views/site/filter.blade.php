<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Produk - E-Blox Store</title>

    <style>
        body { font-family: Arial, sans-serif; background: #f5f6f7; margin: 0; padding: 0; }

        .navbar {
            background: white; padding: 14px 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);
            display: flex; align-items: center; gap: 20px;
        }
        .navbar input {
            width: 40%; padding: 10px 14px; border: 1px solid #ccc; border-radius: 6px;
        }

        .container { display: flex; padding: 20px; gap: 20px; }
        .sidebar {
            width: 260px; background: white; padding: 20px; border-radius: 8px; height: fit-content;
        }
        .filter-item { margin-bottom: 20px; }

        .product-container { flex: 1; }
        .product-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 15px;
        }

        .card {
            background: white; border-radius: 8px; overflow: hidden; border: 1px solid #e5e5e5;
            transition: 0.2s; cursor: pointer;
        }
        .card img { width: 100%; height: 170px; object-fit: cover; }
        .price { font-weight: bold; color: #333; }
        .title { font-size: 14px; font-weight: bold; margin-bottom: 5px; }

        /* TOMBOL BIRU */
        .btn-view {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.2s ease-in-out;
        }
        .btn-view:hover {
            background: #1558b0;
        }
    </style>
</head>
<body>

<div class="navbar">
    <strong style="font-size: 20px; color:#1a73e8;">E-Blox Store</strong>
    <input type="text" placeholder="Cari produk...">
</div>

<div class="container">

    <div class="sidebar">
        <h3>Filter</h3>

        {{-- FILTER KATEGORI --}}
        <div class="filter-item">
            <strong>Kategori</strong>
            <form method="GET" action="">
                <select name="kategori" onchange="this.form.submit()"
                    style="width:100%;padding:8px;border-radius:6px;">
                    <option value="">-- Semua Kategori --</option>

                    @foreach ($kategoriList as $k)
                        <option value="{{ $k->kategori }}"
                            {{ request('kategori') == $k->kategori ? 'selected' : '' }}>
                            {{ $k->kategori }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <div class="product-container">
        <h2>Daftar Produk</h2>
        <p>Menampilkan {{ count($produk) }} produk</p>

        <div class="product-grid">
            @foreach ($produk as $p)
            <div class="card">
                <img src="{{ $p->gambar ? asset($p->gambar->gambar) : 'https://via.placeholder.com/300x200' }}">
                <div class="card-body">
                    <div class="title">{{ $p->nama_produk }}</div>
                    <div class="price">Rp {{ number_format($p->harga->harga ?? 0, 0, ',', '.') }}</div>

                    <a href="{{ route('produk.show', $p->id) }}">
                        <button class="btn-view">
                            Lihat Barang
                        </button>
                    </a>

                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

</body>
</html>
