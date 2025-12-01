<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Produk - E-Blox Store</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        /* NAVBAR */
        .navbar {
            background: white;
            padding: 14px 24px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .navbar-title {
            font-size: 22px;
            font-weight: bold;
            color: #1a73e8;
            margin-right: 20px;
        }

        /* SEARCH AREA */
        .search-wrapper {
            width: 40%;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            transition: 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: #1a73e8;
            box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.2);
        }

        /* HISTORY BOX */
        #historyBox {
            position: absolute;
            top: 48px;
            left: 0;
            width: 100%;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            display: none;
            max-height: 220px;
            overflow-y: auto;
            z-index: 100;
        }

        #historyBox li {
            padding: 10px 16px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            transition: 0.2s;
        }
        #historyBox li:hover {
            background: #f5f5f5;
        }

        /* MAIN LAYOUT */
        .container {
            display: flex;
            padding: 20px;
            gap: 22px;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            height: fit-content;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }

        .sidebar h3 {
            margin-top: 0;
            color: #1a73e8;
        }

        select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 15px;
        }

        /* PRODUCTS */
        .product-container {
            flex: 1;
        }

        .product-container h2 {
            margin-top: 0;
            color: #333;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
            gap: 18px;
        }

        .card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            transition: 0.2s;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 5px 14px rgba(0,0,0,0.12);
        }

        .card img {
            width: 100%;
            height: 170px;
            object-fit: cover;
            background: #f0f0f0;
        }

        .card-body {
            padding: 12px;
        }

        .title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 6px;
            color: #333;
        }

        .price {
            color: #1a73e8;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* BUTTON */
        .btn-view {
            width: 100%;
            padding: 10px;
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-view:hover {
            background: #1558b0;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
            }
            .search-wrapper {
                width: 70%;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <strong class="navbar-title">E-Blox Store</strong>

        <div class="search-wrapper">
            <form method="GET" action="{{ route('filter') }}">
                <input type="text" name="search" id="searchInput"
                    class="search-input"
                    placeholder="Cari produk..."
                    value="{{ request('search') }}"
                    autocomplete="off">
            </form>

            @if(!empty($history))
                <ul id="historyBox">
                    @foreach($history as $item)
                    <li>
                        <a href="{{ route('filter', ['search' => $item]) }}"
                           style="text-decoration:none; color:#333; display:block;">
                           {{ $item }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

<script>
    const input = document.getElementById("searchInput");
    const historyBox = document.getElementById("historyBox");

    if (input && historyBox) {
        input.addEventListener("input", () => {
            historyBox.style.display = input.value.trim().length > 0 ? "block" : "none";
        });

        document.addEventListener("click", (e) => {
            if (!historyBox.contains(e.target) && e.target !== input) {
                historyBox.style.display = "none";
            }
        });
    }
</script>

<!-- MAIN -->
<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h3>Filter</h3>

        <div class="filter-item">
            <strong>Kategori</strong>
            <form method="GET">
                <select name="kategori" onchange="this.form.submit()">
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

    <!-- PRODUCTS -->
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
                            <button class="btn-view">Lihat Barang</button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

</body>
</html>
