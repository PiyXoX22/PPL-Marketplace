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

        /* GRID BASE */
        .layout {
            max-width: 1200px;
            margin: 20px auto;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 25px;
        }

        /* CARD */
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

        /* ADDRESS */
        .address-box {
            line-height: 1.5;
            font-size: 14px;
        }

        /* PRODUCT BOX */
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

        .product-price {
            font-weight: bold;
            font-size: 15px;
            float: right;
        }

        /* SHIPPING OPTION */
        .shipping-option {
            border: 1px solid #dcdcdc;
            padding: 12px;
            border-radius: 8px;
            margin-top: 8px;
            font-size: 14px;
        }

        /* PAYMENT LIST */
        .payment-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #efefef;
            font-size: 14px;
        }

        .payment-item:last-child {
            border-bottom: none;
        }

        input[type="radio"] {
            width: 18px;
            height: 18px;
        }

        /* SIDEBAR */
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

    </style>
</head>
<body>

<div class="layout">

    <!-- LEFT SIDE -->
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

            <div class="shipping-option">
                <strong>Reguler</strong><br>
                Pos Indonesia (Rp17.000)<br>
                Estimasi tiba 23 - 26 Nov
            </div>
        </div>

        <!-- NOTE -->
        <div class="card">
            <div style="display:flex;align-items:center;gap:8px;font-size:14px;">
                📝 Kasih Catatan
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

    <!-- RIGHT SIDE -->
    <div>
        <div class="summary-box">
            <div class="card-title">Cek ringkasan transaksimu, yuk</div>

            <div class="row">
                <span>Total Harga (1 Barang)</span>
                <span>Rp{{ number_format($produk->harga->harga, 0, ',', '.') }}</span>
            </div>

            <div class="row">
                <span>Total Ongkos Kirim</span>
                <span>Rp17.000</span>
            </div>

            @php
                $total = $produk->harga->harga + 17000;
            @endphp

            <div class="total-label">
                Rp{{ number_format($total, 0, ',', '.') }}
            </div>

            <button class="btn-pay">💳 Bayar Sekarang</button>
        </div>
    </div>

</div>

</body>
</html>
