@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Edit Harga</h1>

<div class="card shadow">
<div class="card-body">

<form action="{{ route('admin.harga.update',$harga->id_prod) }}"
method="POST">

@csrf
@method('PUT')

<div class="form-group">

<label>ID Produk</label>

<input type="text"
class="form-control"
value="{{ $harga->id_prod }}"
readonly>

</div>

<div class="form-group">

<label>Harga</label>

<input type="number"
name="harga"
class="form-control"
value="{{ $harga->harga }}">

</div>

<button class="btn btn-warning">
Update
</button>

<a href="{{ route('admin.harga.index') }}"
class="btn btn-secondary">
Kembali
</a>

</form>

</div>
</div>

</div>

@endsection