@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Kategori</h2>

    <form action="{{ route('admin.kategori.update', $kategori->id_prod) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">ID Produk</label>
            <input type="text" class="form-control" value="{{ $kategori->id_prod }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ $kategori->kategori }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
