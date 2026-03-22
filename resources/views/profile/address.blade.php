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
background:#f1f5f9;
padding:20px;
border-radius:10px;
}

.dark .sidebar{
background:#1e293b;
}

.sidebar a{
display:block;
padding:10px;
margin-bottom:6px;
color:#1e293b;
font-weight:bold;
text-decoration:none;
border-radius:8px;
transition:.2s;
}

.dark .sidebar a{
color:#cbd5f5;
}

/* 🔥 HOVER BIRU */
.sidebar a:hover{
background:#dbeafe;
color:#1d4ed8;
}

.dark .sidebar a:hover{
background:#334155;
}

/* 🔥 ACTIVE BIRU */
.sidebar a.active{
background:#3b82f6;
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
border-radius:12px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.dark .content{
background:#1e293b;
box-shadow:0 10px 25px rgba(0,0,0,.5);
}

/* INPUT */

input, select{
width:100%;
height:40px;
margin-bottom:10px;
padding:5px;
border:1px solid #ccc;
border-radius:8px;
background:white;
transition:.2s;
}

/* 🔥 FOCUS BIRU */
input:focus,
select:focus{
outline:none;
border:1px solid #3b82f6;
box-shadow:0 0 0 2px rgba(59,130,246,0.2);
}

.dark input,
.dark select{
background:#0f172a;
border:1px solid #334155;
color:white;
}

/* BUTTON 🔥 GANTI HITAM */

.btn-submit{
padding:8px 16px;
background:#3b82f6;
color:#fff;
border:none;
border-radius:8px;
cursor:pointer;
transition:.2s;
}

.btn-submit:hover{
background:#2563eb;
}

.dark .btn-submit{
background:#3b82f6;
}

/* TABLE */

.table-address{
width:100%;
border-collapse:collapse;
margin-top:20px;
border-radius:10px;
overflow:hidden;
}

.table-address th,
.table-address td{
border:1px solid #e5e7eb;
padding:10px;
}

.dark .table-address th,
.dark .table-address td{
border:1px solid #334155;
}

/* 🔥 HEADER TABLE SOFT */
.table-address th{
background:#eff6ff;
color:#0f172a;
}

.dark .table-address th{
background:#0f172a;
}

.table-address td{
background:#fff;
}

.dark .table-address td{
background:#1e293b;
}

/* ALERT */

.alert-success{
padding:10px;
background:#dbeafe;
color:#1d4ed8;
border-radius:8px;
margin-bottom:10px;
}

.dark .alert-success{
background:#1e3a8a;
color:#dbeafe;
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
Alamat Saya
</h2>


@if(session('success'))
<div class="alert-success">
{{ session('success') }}
</div>
@endif


{{-- FORM --}}
<form action="{{ route('profile.address.store') }}" method="POST">
@csrf

<label>Nama Lengkap</label>
<input type="text" name="full_name" required>

<label>No. Telepon</label>
<input type="text" name="phone" required>

<label>Provinsi</label>
<select id="province" name="province" required>
<option value="">-- Pilih Provinsi --</option>

@foreach($provinces as $p)
<option value="{{ $p['name'] }}" data-id="{{ $p['id'] }}">
{{ $p['name'] }}
</option>
@endforeach

</select>


<label>Kota</label>
<select id="city" name="city" required disabled>
<option value="">Pilih Provinsi dulu</option>
</select>

<input type="hidden" name="city_id" id="city_id">


<label>Kecamatan</label>
<select id="district" name="district" required disabled>
<option value="">Pilih Kota dulu</option>
</select>


<label>Kode Pos</label>
<input type="text" name="postal_code" required>


<label>Alamat Lengkap</label>
<input type="text" name="address_line" required>


<label>Detail Tambahan (Opsional)</label>
<input type="text" name="additional_info">


<button class="btn-submit">
Tambah Alamat
</button>

</form>


{{-- TABLE ADDRESS --}}
<table class="table-address">

<thead>
<tr>
<th>Nama</th>
<th>Telepon</th>
<th>Provinsi</th>
<th>Kota</th>
<th>Kecamatan</th>
<th>Kode Pos</th>
<th>Alamat</th>
<th>Default?</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@forelse($addresses as $address)

<tr>

<td>{{ $address->full_name }}</td>
<td>{{ $address->phone }}</td>
<td>{{ $address->province }}</td>
<td>{{ $address->city }}</td>
<td>{{ $address->district }}</td>
<td>{{ $address->postal_code }}</td>
<td>{{ $address->address_line }}</td>
<td>{{ $address->is_default ? 'Default' : '-' }}</td>

<td>

<form action="{{ route('profile.address.destroy', $address->id) }}" method="POST">

@csrf
@method('DELETE')

<button
class="btn-submit"
style="background:red"
onclick="return confirm('Hapus alamat ini?')">

Hapus

</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="9" class="text-center">
Belum ada alamat
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>