<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - E-Blox Store</title>

    <style>
        body {
            background: #f3f3f3;
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* NAVBAR */
        header {
            background: #d3d3d3;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header nav a {
            margin-left: 20px;
            color: #000;
            text-decoration: none;
            font-size: 14px;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            height: 30px;
            background: #d3d3d3;
            border: none;
            border-radius: 3px;
            margin-bottom: 15px;
            padding: 5px;
        }

        .qr-title {
            width: 200px;
            height: 10px;
            background: #d3d3d3;
            margin: 30px 0 10px 0;
        }

        .qr-box {
            width: 100%;
            height: 250px;
            background: #d3d3d3;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .btn {
            width: 100%;
            background: #d3d3d3;
            padding: 10px;
            border: none;
            margin-top: 15px;
            cursor: pointer;
            text-align: center;
            font-weight: bold;
        }

        .summary-box {
            background: #d3d3d3;
            padding: 20px;
            border-radius: 3px;
        }

        .summary-box p {
            margin: 8px 0;
            font-size: 14px;
        }

        .summary-box .total {
            font-weight: bold;
            margin-top: 20px;
            font-size: 16px;
        }

        @media(max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }
        }
    </style>

</head>
<body>

{{-- NAVBAR --}}
<header>
    <div>E-Blox Store</div>
    <nav>
        <a href="#">Home</a>
        <a href="#">Produk</a>
        <a href="#">Kategori</a>
        <a href="#">Login</a>
        <span style="font-size:18px;">🛒</span>
    </nav>
</header>

{{-- CONTENT --}}
<div class="container">

    {{-- KIRI --}}
    <div>

        <label>Alamat Pengiriman</label>
        <input type="text">

        <label>Metode Pembayaran</label>
        <input type="text">

        <label>Metode Pengiriman</label>
        <input type="text">

        <div class="qr-title"></div>

        <div class="qr-box">
            KODE QRIS
        </div>

        <button class="btn">Konfirmasi Belajar</button>

    </div>

    {{-- RINGKASAN --}}
    <div class="summary-box">

        <h3>Ringkasan Pesanan</h3>

        <p>SubTotal</p>
        <p>Ongkir</p>
        <p>Pajak</p>

        <p class="total">TOTAL</p>

    </div>

</div>

</body>
</html>
