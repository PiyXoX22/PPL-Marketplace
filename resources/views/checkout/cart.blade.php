<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout Keranjang</title>
    <style>
        body { background: #f3f5f7; margin: 0; font-family: Arial, sans-serif; }
        .layout { max-width: 1200px; margin: 20px auto; display: grid; grid-template-columns: 1fr 380px; gap: 25px; }
        .card { background: #fff; border-radius: 12px; border: 1px solid #e3e3e3; padding: 18px 20px; margin-bottom: 20px; }
        .card-title { font-size: 16px; font-weight: bold; margin-bottom: 12px; }
        .address-box { line-height: 1.5; font-size: 14px; }
        .product { display: flex; gap: 15px; align-items: center; margin-bottom: 15px; }
        .product img { width: 100px; height: 100px; border-radius: 8px; object-fit: cover; border: 1px solid #ddd; }
        .summary-box { background: #fff; padding: 20px; border-radius: 12px; border: 1px solid #e3e3e3; position: sticky; top: 20px; }
        .row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; }
        .total-label { font-weight: bold; font-size: 18px; margin-top: 12px; color: #03ac0e; }
        .btn-pay { width: 100%; background: #03ac0e; color: white; border: none; padding: 14px; border-radius: 8px; font-size: 16px; cursor: pointer; margin-top: 18px; font-weight: bold; }
        .btn-pay:hover { background: #02940c; }
        select { width: 100%; padding: 10px; border-radius: 7px; border: 1px solid #ccc; margin-top: 10px; font-size: 14px; }
        .payment-item { display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid #efefef; font-size: 14px; }
        .hidden { display: none; }
    </style>
</head>
<body>

<div class="layout">

    <!-- LEFT -->
    <div>
        <!-- ADDRESS SELECT -->
        <div class="card">
            <div class="card-title">📍 ALAMAT PENGIRIMAN</div>
            <form method="GET">
                <select name="address_id" onchange="this.form.submit()">
                    <option value="">-- Pilih Alamat Pengiriman --</option>
                    @foreach(auth()->user()->addresses as $addr)
                        <option value="{{ $addr->id }}" {{ request('address_id', optional($selectedAddress)->id) == $addr->id ? 'selected' : '' }}>
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
            <a href="{{ route('profile.address.index') }}" style="display:inline-block; padding:8px 12px; background:#007bff; color:#fff; border-radius:6px; text-decoration:none; font-size:13px;">
                Kelola Alamat ➜
            </a>
        </div>

        <!-- CART PRODUCT -->
        <div class="card">
            <div class="card-title">🛒 Barang dalam Keranjang</div>
            @foreach ($cartItems as $item)
                <div class="product">
                    @if($item->product && $item->product->gambar)
                        <img src="{{ asset($item->product->gambar->gambar) }}">
                    @endif
                    <div>
                        <b>{{ $item->product->nama_produk }}</b><br>
                        Rp{{ number_format($item->product->harga->harga ?? 0,0,',','.') }} × {{ $item->quantity }}
                    </div>
                </div>
            @endforeach

            <!-- SHIPPING -->
            <div class="mt-3">
                <label class="card-title">Metode Pengiriman</label>
                <select id="courier" name="courier">
                    <option value="">-- Pilih Kurir --</option>
                    <option value="jne">JNE</option>
                    <option value="pos">POS Indonesia</option>
                    <option value="jnt">J&T Express</option>
                    <option value="sicepat">SiCepat</option>
                    <option value="gosend">GoSend</option>
                </select>
                <button type="button" id="hitung-ongkir" class="btn-pay" style="margin-top:10px;">Hitung Ongkos Kirim</button>
                <div id="loading-indicator" class="hidden" style="margin-top:10px;">Memproses...</div>
                <div class="results-container hidden" style="margin-top:15px;">
                    <div id="results-ongkir"></div>
                </div>
            </div>
        </div>

        <!-- PAYMENT -->
        <div class="card">
            <div class="card-title">Metode Pembayaran</div>
            @foreach(['COD','Online'] as $pay)
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
            <div class="card-title">Ringkasan</div>
            <form action="{{ route('checkout.pay') }}" method="POST">
                @csrf
                <input type="hidden" name="courier" id="input-courier">
                <input type="hidden" name="ongkir" id="input-ongkir" value="0">
                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                <input type="hidden" name="discount" value="{{ $discount }}">
                <input type="hidden" id="input-grand-total" name="grand_total" value="{{ $total }}">
                <input type="hidden" name="payment_method" id="input-payment-method">

                <div class="row">
                    <span>Subtotal</span>
                    <span>Rp{{ number_format($subtotal,0,',','.') }}</span>
                </div>

                <div class="row">
                    <span>Ongkir</span>
                    <span id="view-ongkir">Rp0</span>
                </div>

                <div class="total-label" id="view-total">
                    Rp{{ number_format($subtotal,0,',','.') }}
                </div>

                <button type="submit" class="btn-pay">Bayar Sekarang</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Ongkir
    document.getElementById('hitung-ongkir').addEventListener('click', function () {
        let courier = document.getElementById('courier').value;
        if (!courier) { alert("Pilih kurir!"); return; }

        fetch("/cek-ongkir", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ courier: courier })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) { alert(data.message); return; }

            let ongkir = Math.round(data.data.total_ongkir);
            let subtotal = {{ $total }}; // ⬅️ BUKAN subtotal mentah
let grandTotal = subtotal + ongkir;

            document.getElementById('view-ongkir').innerText = "Rp " + ongkir.toLocaleString('id-ID');
            document.getElementById('view-total').innerText = "Rp " + grandTotal.toLocaleString('id-ID');

            document.getElementById('input-ongkir').value = ongkir;
            document.getElementById('input-grand-total').value = grandTotal;
            document.getElementById('input-courier').value = courier;
        });
    });

    // Payment method
    document.querySelectorAll('input[name="pay"]').forEach(function(radio){
        radio.addEventListener('change', function(){
            document.getElementById('input-payment-method').value = this.value;
        });
    });

    // Default payment method
    window.addEventListener('DOMContentLoaded', function(){
        const firstPay = document.querySelector('input[name="pay"]');
        if(firstPay){
            firstPay.checked = true;
            document.getElementById('input-payment-method').value = firstPay.value;
        }
    });
</script>

</body>
</html>
