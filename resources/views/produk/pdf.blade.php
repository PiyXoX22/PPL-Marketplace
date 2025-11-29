<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Produk</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 11px;
        }
        th { background: #f2f2f2; }
        h2 { text-align: center; margin: 0; }
        img { width: 60px; height: auto; }
    </style>
</head>
<body>

<h2>LAPORAN DATA PRODUK</h2>
<p>Tanggal: {{ date('d-m-Y') }}</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Gambar</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($produk as $i => $p)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $p->nama_produk }}</td>
            <td>{{ $p->deskripsi }}</td>
            <td>{{ $p->kategori->kategori ?? '-' }}</td>
            <td>{{ $p->stok->qty ?? 0 }}</td>
            <td>
                @if ($p->harga)
                    Rp {{ number_format($p->harga->harga, 0, ',', '.') }}
                @else
                    -
                @endif
            </td>

            <td>
                @if ($p->gambar_path && file_exists($p->gambar_path))
                    <img src="{{ $p->gambar_path }}">
                @else
                    Tidak Ada
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
