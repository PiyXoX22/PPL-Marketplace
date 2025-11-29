@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2>Edit Gambar Produk</h2>

  <form action="{{ route('admin.gambar.update', $gambar->id_prod) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label>ID Produk</label>
      <input type="number" name="id_prod" class="form-control" value="{{ $gambar->id_prod }}" readonly>
    </div>

    <div class="mb-3">
      <label>Gambar Saat Ini</label><br>
      <img src="{{ asset($gambar->gambar) }}" alt="gambar lama" width="150" class="mb-2">
    </div>

    <div class="mb-3">
      <label>Ganti Gambar</label>
      <input type="file" name="gambar" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Perbarui</button>
    <a href="{{ route('admin.gambar.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
