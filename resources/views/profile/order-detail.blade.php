<x-headersite/>

<style>

body{
background:linear-gradient(180deg,#f8fafc,#eef2ff);
transition:.3s;
}

.dark body{
background:#0f172a;
color:white;
}

/* CONTAINER */

.profile-container{
display:flex;
padding:20px;
min-height:80vh;
}

/* SIDEBAR */

.sidebar{
width:200px;
background:#e6e6e6;
padding:20px;
border-radius:8px;
}

.dark .sidebar{
background:#1e293b;
}

.sidebar a{
display:block;
padding:10px;
margin-bottom:6px;
text-decoration:none;
color:#000;
font-weight:bold;
border-radius:6px;
}

.dark .sidebar a{
color:#cbd5f5;
}

.sidebar a:hover{
background:#d4d4d4;
}

.dark .sidebar a:hover{
background:#334155;
}

.sidebar a.active{
background:#000;
color:#fff;
}

.dark .sidebar a.active{
background:#3b82f6;
color:white;
}

/* CONTENT */

.content{
flex:1;
background:#fff;
padding:30px;
margin-left:20px;
border-radius:10px;
box-shadow:0 10px 25px rgba(0,0,0,.1);
}

.dark .content{
background:#1e293b;
box-shadow:0 10px 25px rgba(0,0,0,.5);
}

/* ORDER BOX */

.order-box{
border:1px solid #ddd;
padding:15px;
border-radius:8px;
margin-bottom:20px;
background:white;
}

.dark .order-box{
background:#0f172a;
border:1px solid #334155;
}

/* BUTTON */

.btn-detail{
display:inline-block;
margin-top:10px;
padding:6px 12px;
color:#fff;
text-decoration:none;
border-radius:5px;
font-size:13px;
}

/* TABLE */

.table-order{
width:100%;
border-collapse:collapse;
margin-top:10px;
}

.table-order th,
.table-order td{
border:1px solid #ddd;
padding:10px;
text-align:left;
}

.dark .table-order th,
.dark .table-order td{
border:1px solid #334155;
}

.table-order th{
background:#f1f1f1;
}

.dark .table-order th{
background:#0f172a;
}

.dark .table-order td{
background:#1e293b;
}

</style>


<div class="profile-container">

{{-- Sidebar --}}
<div class="sidebar">

<a href="{{ route('profile.index') }}"
class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">
PROFILE
</a>

<a href="{{ route('profile.address.index') }}"
class="{{ request()->routeIs('profile.address.*') ? 'active' : '' }}">
ADDRESSES
</a>

<a href="{{ route('profile.orders') }}"
class="{{ request()->routeIs('profile.orders') ? 'active' : '' }}">
ORDERS
</a>

<a href="{{ route('logout') }}">
LOGOUT
</a>

</div>


{{-- CONTENT --}}
<div class="content">

<h2 class="text-xl font-bold mb-4">
Order Detail #{{ $trx->id }}
</h2>


<div class="order-box">

<p><strong>Tanggal:</strong> {{ $trx->tanggal }}</p>

<p>
<strong>Total:</strong>
Rp {{ number_format($trx->total,0,',','.') }}
</p>

<p>
<strong>Grand Total:</strong>
Rp {{ number_format($trx->grand_total,0,',','.') }}
</p>

<p>
<strong>Paid:</strong>
Rp {{ number_format($trx->paid,0,',','.') }}
</p>

<p>
<strong>Status:</strong>
{{ ucfirst($trx->status) }}
</p>

<p>
<strong>Payment Method:</strong>
{{ $trx->payment_method }}
</p>


<a href="{{ route('profile.orders') }}"
class="btn-detail"
style="background:#6c757d">
Kembali
</a>

<a href="{{ route('profile.orders.invoice', $trx->id) }}"
class="btn-detail"
style="background:#198754">
Download Invoice (PDF)
</a>

</div>


<h3 class="text-lg font-semibold mb-2">
Detail Barang
</h3>


<table class="table-order">

<thead>
<tr>
<th>ID Barang</th>
<th>Qty</th>
<th>Harga Satuan</th>
<th>Subtotal</th>
</tr>
</thead>

<tbody>

@foreach($trx->detail as $item)

<tr>

<td>{{ $item->id_barang }}</td>

<td>{{ $item->qty }}</td>

<td>
Rp {{ number_format($item->harga_satuan,0,',','.') }}
</td>

<td>
Rp {{ number_format($item->subtotal,0,',','.') }}
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

<x-footersite/>