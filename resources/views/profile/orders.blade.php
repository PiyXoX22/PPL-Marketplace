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

/* ORDER CARD */

.order-box{
border:1px solid #ddd;
padding:15px;
border-radius:8px;
margin-bottom:15px;
background:white;
}

.dark .order-box{
border:1px solid #334155;
background:#0f172a;
}

.order-header{
display:flex;
justify-content:space-between;
font-weight:bold;
margin-bottom:5px;
}

/* STATUS */

.status{
padding:3px 8px;
border-radius:5px;
font-size:12px;
font-weight:bold;
}

/* Pending */
.pending{
background:#fff3cd;
color:#b38300;
}

/* Terbayar */
.terbayar{
background:#d1e7dd;
color:#0f5132;
}

/* Dikemas */
.dikemas{
background:#cfe2ff;
color:#084298;
}

/* Dalam Pengantaran */
.dalam_pengantaran{
background:#e2d9f3;
color:#44307a;
}

/* Gagal */
.gagal{
background:#f8d7da;
color:#842029;
}

/* Cancel */
.cancel{
background:#e2e3e5;
color:#41464b;
}

/* BUTTON */

.btn-detail{
display:inline-block;
margin-top:10px;
padding:6px 12px;
background:#2d70ee;
color:#fff;
text-decoration:none;
border-radius:5px;
font-size:13px;
}

.btn-detail:hover{
background:#1f55bb;
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


{{-- Content --}}
<div class="content">

<h2 class="text-xl font-bold mb-4">
My Orders
</h2>


@forelse($orders as $order)

<div class="order-box">

<div class="order-header">

<span>
Order #{{ $order->id }}
</span>

<span class="status {{ $order->status }}">
{{ ucfirst($order->status) }}
</span>

</div>

<p>
<strong>Total:</strong>
Rp {{ number_format($order->grand_total,0,',','.') }}
</p>

<p>
<strong>Date:</strong>
{{ $order->tanggal }}
</p>

<a href="{{ route('profile.orders.detail', $order->id) }}"
class="btn-detail">
View Details
</a>

</div>

@empty

<p class="text-gray-500 dark:text-gray-400">
Tidak ada transaksi.
</p>

@endforelse

</div>

</div>

<x-footersite/>