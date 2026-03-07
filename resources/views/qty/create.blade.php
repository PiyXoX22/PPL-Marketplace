@extends('layouts.app')

@section('content')

<div class="container py-4">

<h2 class="mb-4">Tambah Qty</h2>

<form action="{{ route('admin.qty.store') }}" method="POST">

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

</div>

<div class="form-group mt-3">

<label>Qty</label>

<input type="number"
name="qty"
class="form-control">

</div>

<button class="btn btn-primary mt-3">
Simpan
</button>

<a href="{{ route('admin.qty.index') }}"
class="btn btn-secondary mt-3">
Kembali
</a>

</form>

</div>

@endsection