@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2>Tambah Gambar Produk</h2>

  <form action="{{ route('admin.gambar.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label>Pilih Produk</label>
      <select name="id_prod" class="form-control" required>
        <option value="" disabled selected>-- Pilih Produk --</option>
        @foreach ($produk as $p)
          <option value="{{ $p->id }}">
            {{ $p->nama_produk }} (ID: {{ $p->id }})
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label>Upload Gambar</label>
      <input type="file" name="gambar" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('admin.gambar.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
