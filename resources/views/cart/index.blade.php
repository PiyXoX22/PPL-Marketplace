<x-headersite/>

<style>

body{
font-family: Arial, sans-serif;
background:linear-gradient(180deg,#f8fafc,#eef2ff);
padding:20px;
transition:.3s;
}

.dark body{
background:#0f172a;
color:white;
}

/* CONTAINER */

.container{
display:grid;
grid-template-columns:1fr 340px;
gap:20px;
align-items:start;
}

/* CARD */

.card{
background:#fff;
border-radius:10px;
padding:20px;
box-shadow:0 4px 12px rgba(0,0,0,.05);
}

.dark .card{
background:#1e293b;
box-shadow:0 4px 12px rgba(0,0,0,.5);
}

/* TITLE */

.cart-title{
font-size:22px;
font-weight:bold;
margin-bottom:15px;
}

/* TABLE */

table{
width:100%;
border-collapse:collapse;
}

th{
background:#f5f5f5;
padding:12px;
font-weight:bold;
text-align:left;
}

.dark th{
background:#0f172a;
}

td{
padding:12px;
border-bottom:1px solid #eee;
vertical-align:middle;
}

.dark td{
border-bottom:1px solid #334155;
}

img{
border-radius:6px;
}

/* BUTTON */

.btn{
padding:6px 10px;
border-radius:4px;
border:none;
cursor:pointer;
font-size:13px;
}

.btn-add{
background:#3b82f6;
color:#fff;
}

.btn-minus{
background:#ef4444;
color:#fff;
}

/* QTY */

.qty-form{
display:flex;
gap:5px;
align-items:center;
}

input[type="number"],
input[type="text"]{
padding:8px;
border-radius:5px;
border:1px solid #ccc;
width:70px;
text-align:center;
background:white;
}

.dark input{
background:#0f172a;
border:1px solid #334155;
color:white;
}

/* SUMMARY */

.summary-title{
font-size:18px;
font-weight:bold;
margin-bottom:15px;
}

.summary-row{
display:flex;
justify-content:space-between;
margin-bottom:10px;
font-size:15px;
}

.summary-row.total{
font-size:18px;
font-weight:bold;
border-top:1px solid #eee;
padding-top:10px;
}

.dark .summary-row.total{
border-top:1px solid #334155;
}

/* COUPON */

.coupon-box{
margin-top:30px;
padding:20px;
border-top:2px dashed #ddd;
width:100%;
background:#fafafa;
border-radius:10px;
}

.dark .coupon-box{
background:#0f172a;
border-top:2px dashed #334155;
}

/* BUY BUTTON */

.btn-buy{
width:100%;
padding:12px;
border-radius:8px;
background:#3b82f6;
color:#fff;
font-size:16px;
border:none;
margin-top:15px;
cursor:pointer;
}

.btn-buy:hover{
background:#2563eb;
}

/* MESSAGE */

.success{
color:#22c55e;
}

.error{
color:#ef4444;
}

</style>


<div class="container">

<!-- LEFT : CART -->
<div class="card">

<div class="cart-title">
Keranjang
</div>

<table>

<thead>
<tr>
<th>Produk</th>
<th>Harga</th>
<th>Jumlah</th>
<th>Total</th>
<th></th>
</tr>
</thead>

<tbody>

@forelse($cartItems as $item)

<tr>

<td>

<div style="display:flex; gap:10px; align-items:center;">

<img src="{{ asset($item->product->gambar->gambar ?? '') }}" width="70">

<div>
<strong>{{ $item->product->nama_produk }}</strong>
</div>

</div>

</td>

<td>
Rp {{ number_format($item->product->harga->harga ?? 0,0,',','.') }}
</td>

<td>

<form action="{{ route('cart.update', $item->id) }}"
method="POST"
class="qty-form">

@csrf
@method('PATCH')

<button name="action" value="decrease" class="btn btn-minus">
-
</button>

<input type="number" value="{{ $item->quantity }}" disabled>

<button name="action" value="increase" class="btn btn-add">
+
</button>

</form>

</td>

<td>
Rp {{ number_format(($item->product->harga->harga ?? 0) * $item->quantity,0,',','.') }}
</td>

<td>

<form action="{{ route('cart.destroy', $item->id) }}" method="POST">

@csrf
@method('DELETE')

<button class="btn btn-minus">
✕
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="5" style="text-align:center;">
Keranjang kosong
</td>
</tr>

@endforelse

</tbody>

</table>

</div>


<!-- RIGHT : SUMMARY -->
<div class="card">

<div class="summary-title">
Ringkasan Belanja
</div>

<div class="summary-row">
<span>Subtotal</span>
<span>Rp {{ number_format($subtotal,0,',','.') }}</span>
</div>

<div class="summary-row total">
<span>Total</span>
<span id="cart-total">
Rp {{ number_format($total,0,',','.') }}
</span>
</div>


<div class="coupon-box">

<label><strong>Kode Kupon</strong></label>

<input type="text" id="coupon-code" placeholder="Masukkan kode diskon">

<button class="btn btn-add"
style="width:100%; margin-top:10px;"
onclick="applyCoupon()">

Apply Coupon

</button>

<div id="coupon-msg"></div>

</div>


<form action="{{ route('checkout.show', auth()->id()) }}" method="GET">

<input type="hidden" name="subtotal" value="{{ $subtotal }}">
<input type="hidden" name="discount" value="{{ $discount }}">
<input type="hidden" name="total" value="{{ $total }}">

<button type="submit" class="btn-buy">
Checkout
</button>

</form>

</div>

</div>