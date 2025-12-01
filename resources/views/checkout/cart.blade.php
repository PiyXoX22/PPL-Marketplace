<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Keranjang</title>

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
            margin-bottom: 15px;
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
            margin-bottom: 8px;
            font-size: 14px;
        }

        .total-label {
            font-weight: bold;
            font-size: 18px;
            margin-top: 12px;
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
    </style>
</head>
<body>

@php
    $ongkirList = [
        'jne'     => 18000,
        'pos'     => 17000,
        'jnt'     => 19000,
        'sicepat' => 16000,
        'gosend'  => 20000,
    ];

    $kurirDipilih = request('kurir') ?? 'pos';
    $ongkir = $ongkirList[$kurirDipilih] ?? 17000;

    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item->product->harga->harga * $item->quantity;
    }

    $selectedAddress = auth()->user()->addresses()
        ->where('id', request('address_id'))
        ->first()
        ?? auth()->user()->addresses()->where('is_default', 1)->first()
        ?? auth()->user()->addresses()->first();
@endphp

<div class="layout">

    <!-- LEFT -->
    <div>

        <!-- ADDRESS SELECT -->
        <div class="card">
            <div class="card-title">📍 ALAMAT PENGIRIMAN</div>

            <form method="GET">
                <select name="address_id" onchange="this.form.submit()"
                    style="width:100%; padding:10px; border-radius:7px; border:1px solid #ccc; margin-bottom:15px;">
                    <option value="">-- Pilih Alamat Pengiriman --</option>
                    @foreach(auth()->user()->addresses as $addr)
                        <option value="{{ $addr->id }}"
                            {{ request('address_id', optional($selectedAddress)->id) == $addr->id ? 'selected' : '' }}>
                            {{ $addr->full_name }} - {{ $addr->city }}
                        </option>
                    @endforeach
                </select>
            </form>

            <div class="address-box">
                @if ($selectedAddress)
                    <strong>{{ $selectedAddress->full_name }}</strong><br>
                    {{ $selectedAddress->address_line }}<br>
                    {{ $selectedAddress->district }}, {{ $selectedAddress->city }}<br>
                    {{ $selectedAddress->province }} - {{ $selectedAddress->postal_code }}<br>
                    {{ $selectedAddress->phone }}
                @else
                    <strong>Silakan pilih alamat terlebih dahulu</strong>
                @endif
            </div>

            <br>

            <a href="{{ route('profile.address.index') }}"
            style="display:inline-block; padding:8px 12px; background:#007bff;
            color:#fff; border-radius:6px; text-decoration:none; font-size:13px;">
                Kelola Alamat ➜
            </a>
        </div>

        <!-- CART PRODUCTS -->
        <div class="card">
            <div class="card-title">🛒 Barang dalam Keranjang</div>

            @foreach ($cartItems as $item)
                <div class="product">
                    @if($item->product && $item->product->gambar)
                        <img src="{{ asset($item->product->gambar->gambar) }}" alt="produk">
                    @endif

                    <div style="width:100%;">
                        <div style="font-weight:bold; font-size:14px;">
                            {{ $item->product->nama_produk }}
                        </div>

                        <div>
                            Rp{{ number_format($item->product->harga->harga, 0, ',', '.') }}
                            × {{ $item->quantity }}
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- SHIPPING --}}
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

        <!-- PAYMENT -->
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

    <!-- RIGHT - SUMMARY -->
    <div>
        <div class="summary-box">
            <div class="card-title">Cek ringkasan transaksimu</div>

            <div class="row">
                <span>Total Produk</span>
                <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>

            <div class="row">
                <span>Ongkir ({{ strtoupper($kurirDipilih) }})</span>
                <span>Rp{{ number_format($ongkir, 0, ',', '.') }}</span>
            </div>

            <div class="total-label">
                Rp{{ number_format($subtotal + $ongkir, 0, ',', '.') }}
            </div>

            <button class="btn-pay">💳 Bayar Sekarang</button>
        </div>
    </div>

</div>

</body>
</html>
