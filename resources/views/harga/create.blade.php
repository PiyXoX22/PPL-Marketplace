@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Tambah Harga</h1>

<div class="card shadow">
<div class="card-body">

<form action="{{ route('admin.harga.store') }}" method="POST">

@csrf

<div class="form-group">
<label>Produk</label>

<select name="id_prod" class="form-control">

<option value="">-- Pilih Produk --</option>

@foreach($produk as $p)

<option value="{{ $p->id }}">
{{ $p->nama_produk }} (ID: {{ $p->id }})
</option>

@endforeach

</select>

@error('id_prod')
<small class="text-danger">{{ $message }}</small>
@enderror

</div>

<div class="form-group">
<label>Harga</label>

<input type="number"
name="harga"
class="form-control"
value="{{ old('harga') }}">

@error('harga')
<small class="text-danger">{{ $message }}</small>
@enderror

</div>

<button class="btn btn-primary">
Simpan
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