<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <style>
        body {
            background: #f3f5f7;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .layout {
            max-width: 1200px;
            margin: 20px auto;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 25px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e3e3e3;
            padding: 18px 20px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .address-box {
            line-height: 1.5;
            font-size: 14px;
        }

        .product {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .product img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #ddd;
        }

        .summary-box {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e3e3e3;
            position: sticky;
            top: 20px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .total-label {
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
            color: #03ac0e;
        }

        .btn-pay {
            width: 100%;
            background: #03ac0e;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 18px;
            font-weight: bold;
        }

        .btn-pay:hover {
            background: #02940c;
        }

        select {
            width: 100%;
            padding: 10px;
            border-radius: 7px;
            border: 1px solid #ccc;
            margin-top: 10px;
            font-size: 14px;
        }

        .payment-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #efefef;
            font-size: 14px;
        }

        input[type="radio"] {
            width: 18px;
            height: 18px;
        }
    </style>
</head>
<body>

@php
    // Opsi ongkir berdasarkan kurir
    $ongkirList = [
        'jne'     => 18000,
        'pos'     => 17000,
        'jnt'     => 19000,
        'sicepat' => 16000,
        'gosend'  => 20000,
    ];

    // Ambil pilihan kurir dari query string (?kurir=jne)
    $kurirDipilih = request('kurir') ?? 'pos';

    // Tentukan ongkir berdasar pilihan
    $ongkir = $ongkirList[$kurirDipilih] ?? 17000;

    // Hitung total
    $total = $produk->harga->harga + $ongkir;
@endphp

<div class="layout">

    <!-- LEFT -->
    <div>

        <!-- ADDRESS -->
        <div class="card">
            <div class="card-title">📍 ALAMAT PENGIRIMAN</div>

            <div class="address-box">
                <strong>{{ auth()->user()->name ?? 'Nama User' }}</strong><br>
                {{ auth()->user()->alamat ?? 'Alamat belum diisi' }}<br>
                {{ auth()->user()->nomor ?? '' }}
            </div>
        </div>

        <!-- PRODUCT -->
        <div class="card">
            <div class="product">
                <img src="{{ asset($produk->gambar->gambar) }}" alt="produk">

                <div style="width:100%;">
                    <div style="font-weight:bold; font-size:14px;">
                        {{ $produk->nama_produk }}
                    </div>

                    <div class="product-price">
                        Rp{{ number_format($produk->harga->harga, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            {{-- SELECT PENGIRIMAN --}}
            <div class="mt-3">
                <label class="card-title">Metode Pengiriman</label>

                <form method="GET">
                    <select name="kurir" onchange="this.form.submit()">
                        <option value="jne"     {{ $kurirDipilih == 'jne'     ? 'selected' : '' }}>JNE - Rp18.000</option>
                        <option value="pos"     {{ $kurirDipilih == 'pos'     ? 'selected' : '' }}>Pos Indonesia - Rp17.000</option>
                        <option value="jnt"     {{ $kurirDipilih == 'jnt'     ? 'selected' : '' }}>J&T - Rp19.000</option>
                        <option value="sicepat" {{ $kurirDipilih == 'sicepat' ? 'selected' : '' }}>SiCepat - Rp16.000</option>
                        <option value="gosend"  {{ $kurirDipilih == 'gosend'  ? 'selected' : '' }}>GoSend - Rp20.000</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- PAYMENT METHOD -->
        <div class="card">
            <div class="card-title">Metode Pembayaran</div>

            @foreach(['OVO','DANA','Mastercard','Visa','PayPal'] as $pay)
                <label class="payment-item">
                    <span>{{ $pay }}</span>
                    <input type="radio" name="pay" value="{{ $pay }}">
                </label>
            @endforeach

        </div>

    </div>

    <!-- RIGHT -->
    <div>
        <div class="summary-box">
            <div class="card-title">Cek ringkasan transaksimu</div>

            <div class="row">
                <span>Total Harga (1 Barang)</span>
                <span>Rp{{ number_format($produk->harga->harga, 0, ',', '.') }}</span>
            </div>

            <div class="row">
                <span>Ongkir ({{ strtoupper($kurirDipilih) }})</span>
                <span>Rp{{ number_format($ongkir, 0, ',', '.') }}</span>
            </div>

            <div class="total-label">
                Rp{{ number_format($total, 0, ',', '.') }}
            </div>

            <button class="btn-pay">💳 Bayar Sekarang</button>
        </div>
    </div>

</div>

</body>
</html>
