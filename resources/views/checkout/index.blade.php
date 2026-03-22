<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Checkout Produk</title>

<style>
body { background:#f3f5f7;margin:0;font-family:Arial;}
.layout{max-width:1200px;margin:20px auto;display:grid;grid-template-columns:1fr 380px;gap:25px;}
.card{background:#fff;border-radius:12px;border:1px solid #e3e3e3;padding:18px 20px;margin-bottom:20px;}
.card-title{font-size:16px;font-weight:bold;margin-bottom:12px;}
.address-box{line-height:1.5;font-size:14px;}
.product{display:flex;gap:15px;align-items:center;margin-bottom:15px;}
.product img{width:100px;height:100px;border-radius:8px;object-fit:cover;border:1px solid #ddd;}
.summary-box{background:#fff;padding:20px;border-radius:12px;border:1px solid #e3e3e3;position:sticky;top:20px;}
.row{display:flex;justify-content:space-between;margin-bottom:8px;font-size:14px;}
.total-label{font-weight:bold;font-size:18px;margin-top:12px;color:#007bff;}
.btn-pay{width:100%;background:#007bff;color:white;border:none;padding:14px;border-radius:8px;font-size:16px;cursor:pointer;margin-top:18px;font-weight:bold;}
.btn-pay:hover{background:#0065d1;}
select{width:100%;padding:10px;border-radius:7px;border:1px solid #ccc;margin-top:10px;font-size:14px;}
.payment-item{display:flex;justify-content:space-between;align-items:center;padding:14px 0;border-bottom:1px solid #efefef;font-size:14px;}
.hidden{display:none;}
</style>
</head>

<body>

<div class="layout">

<!-- LEFT -->
<div>
<!-- ADDRESS -->
<div class="card">

    <div class="card-title">
    📍 ALAMAT PENGIRIMAN
    </div>

    @php
    $addresses = auth()->user()->addresses;
    $currentAddress = $selectedAddress ?? $addresses->where('is_default',1)->first() ?? $addresses->first();
    @endphp

    <form method="GET">

    <select name="address_id" onchange="this.form.submit()">

    <option value="">-- Pilih Alamat --</option>

    @foreach($addresses as $addr)

    <option value="{{ $addr->id }}"
    {{ request('address_id',$currentAddress?->id) == $addr->id ? 'selected' : '' }}>

    {{ $addr->full_name }} - {{ $addr->city }}

    </option>

    @endforeach

    </select>

    </form>


    <div class="address-box">

    @if($currentAddress)

    <strong>{{ $currentAddress->full_name }}</strong><br>

    {{ $currentAddress->address_line }}<br>

    {{ $currentAddress->district }}, {{ $currentAddress->city }}<br>

    {{ $currentAddress->province }} - {{ $currentAddress->postal_code }}<br>

    {{ $currentAddress->phone }}

    @else

    <strong>Belum ada alamat tersimpan</strong>

    @endif

    </div>


    <br>

    <a href="{{ route('profile.address.index') }}"
    style="display:inline-block;padding:8px 12px;background:#3b82f6;color:#fff;border-radius:6px;text-decoration:none;font-size:13px;">

    Kelola Alamat ➜

    </a>

    </div>

<!-- PRODUCT -->
<div class="card">
<div class="card-title">🛒 Produk</div>

<div class="product">

@if($produk->gambar)
<img src="{{ asset($produk->gambar->gambar) }}">
@endif

<div>
<b>{{ $produk->nama_produk }}</b><br>
Rp{{ number_format($produk->harga->harga ?? 0,0,',','.') }}
</div>

</div>


<!-- SHIPPING -->
<label class="card-title">Metode Pengiriman</label>

<select id="courier">
<option value="">-- Pilih Kurir --</option>
<option value="jne">JNE</option>
<option value="pos">POS Indonesia</option>
<option value="tiki">TIKI</option>
</select>

<button type="button" id="hitung-ongkir" class="btn-pay" style="margin-top:10px;">
Hitung Ongkir
</button>

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
<input type="hidden" name="product_id" value="{{ $produk->id }}">
<input type="hidden" name="address_id" id="input-address-id" value="{{ $currentAddress->id ?? '' }}">

<input type="hidden" name="courier" id="input-courier">

<input type="hidden" name="ongkir" id="input-ongkir" value="0">

<input type="hidden" name="subtotal" value="{{ $produk->harga->harga }}">

<input type="hidden" name="discount" value="0">

<input type="hidden" id="input-grand-total" name="grand_total"
value="{{ $produk->harga->harga }}">

<input type="hidden" name="payment_method" id="input-payment-method">


<div class="row">
<span>Subtotal</span>
<span>Rp{{ number_format($produk->harga->harga,0,',','.') }}</span>
</div>

<div class="row">
<span>Ongkir</span>
<span id="view-ongkir">Rp0</span>
</div>

<div class="total-label" id="view-total">
Rp{{ number_format($produk->harga->harga,0,',','.') }}
</div>

<button type="submit" class="btn-pay">
Bayar Sekarang
</button>

</form>

</div>

</div>

</div>


<script>
document.getElementById('hitung-ongkir').addEventListener('click',function(){

let courier=document.getElementById('courier').value;
let address_id=document.getElementById('input-address-id').value;

if(!courier){
alert("Pilih kurir!");
return;
}

fetch("/cek-ongkir",{

method:"POST",

headers:{
"Content-Type":"application/json",
"Accept":"application/json",
"X-CSRF-TOKEN":document.querySelector('meta[name="csrf-token"]').content
},

body:JSON.stringify({
courier:courier,
address_id:address_id,
product_id: {{ $produk->id }}
})

})
.then(res=>res.json())
.then(data=>{

if(!data.success){
alert(data.message);
return;
}

let ongkir=Math.round(data.data.total_ongkir);
let subtotal={{ $produk->harga->harga }};
let grandTotal=subtotal+ongkir;

document.getElementById('view-ongkir').innerText="Rp "+ongkir.toLocaleString('id-ID');
document.getElementById('view-total').innerText="Rp "+grandTotal.toLocaleString('id-ID');

document.getElementById('input-ongkir').value=ongkir;
document.getElementById('input-grand-total').value=grandTotal;
document.getElementById('input-courier').value=courier;

});

});



document.querySelectorAll('input[name="pay"]').forEach(function(radio){

radio.addEventListener('change',function(){

document.getElementById('input-payment-method').value=this.value;

});

});


window.addEventListener('DOMContentLoaded',function(){

const firstPay=document.querySelector('input[name="pay"]');

if(firstPay){

firstPay.checked=true;

document.getElementById('input-payment-method').value=firstPay.value;

}

});
document.querySelector('select[name="address_id"]').addEventListener('change', function(){

document.getElementById('input-address-id').value = this.value;

});
</script>

</body>
</html>