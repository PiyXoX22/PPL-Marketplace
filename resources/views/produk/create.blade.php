@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Tambah Produk</h1>

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('produk.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk') }}">
                    @error('nama_produk')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Harga Produk</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>

</div>
@endsection
