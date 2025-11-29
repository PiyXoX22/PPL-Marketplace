@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Daftar Gambar Produk</h2>
    <a href="{{ route('admin.gambar.create') }}" class="btn btn-primary">+ Tambah Gambar</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID Produk</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($gambar as $g)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
          <img src="{{ asset($g->gambar) }}" alt="gambar produk" width="120">
        </td>
        <td>
          <a href="{{ route('admin.gambar.edit', $g->id_prod) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('admin.gambar.destroy', $g->id_prod) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus gambar ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
