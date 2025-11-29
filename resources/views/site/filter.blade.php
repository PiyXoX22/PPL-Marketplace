<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Produk - E-Blox Store</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6f7;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: white;
            padding: 14px 20px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 20px;
            justify-content: center;
            position: relative;
        }

        .container {
            display: flex;
            padding: 20px;
            gap: 20px;
        }

        .sidebar {
            width: 260px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            height: fit-content;
        }

        .filter-item {
            margin-bottom: 20px;
        }

        .product-container {
            flex: 1;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
        }

        .card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e5e5e5;
            transition: 0.2s;
            cursor: pointer;
        }

        .card img {
            width: 100%;
            height: 170px;
            object-fit: cover;
        }

        .price {
            font-weight: bold;
            color: #333;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

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

        <strong style="font-size: 20px; color:#1a73e8; margin-right:20px;">
            E-Blox Store
        </strong>

        <!-- WRAPPER AGAR SEARCH & HISTORY TENGAH -->
        <div style="width:40%; position:relative;">

            <form method="GET" action="{{ route('filter') }}" style="width:100%;">
                <input
                    type="text"
                    name="search"
                    id="searchInput"
                    value="{{ request('search') }}"
                    placeholder="Cari produk..."
                    style="width:100%; padding:10px 14px; border:1px solid #ccc; border-radius:6px;"
                    autocomplete="off"
                >
            </form>

            <!-- RIWAYAT PENCARIAN -->
            @if(!empty($history))
                <ul id="historyBox" style="
                    position:absolute;
                    top:50px;
                    left:0;
                    width:100%;
                    background:white;
                    border:1px solid #ccc;
                    border-radius:6px;
                    margin-top:4px;
                    max-height:200px;
                    overflow:auto;
                    z-index:50;
                    list-style:none;
                    padding:0;
                    display:none;
                ">
                    @foreach($history as $item)
                        <li style="
                            padding:10px 14px;
                            cursor:pointer;
                            border-bottom:1px solid #eee;
                        ">
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
        input.addEventListener("input", function () {
            const value = input.value.trim();
            historyBox.style.display = value.length > 0 ? "block" : "none";
        });

        document.addEventListener("click", function(e) {
            if (!historyBox.contains(e.target) && e.target !== input) {
                historyBox.style.display = "none";
            }
        });
    }
</script>

<div class="container">

    <div class="sidebar">
        <h3>Filter</h3>

        <div class="filter-item">
            <strong>Kategori</strong>
            <form method="GET" action="">
                <select name="kategori" onchange="this.form.submit()"
                    style="width:100%; padding:8px; border-radius:6px;">
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
                        <button class="btn-view">Lihat Barang</button>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

</body>
<x-footersite/>
</html>
