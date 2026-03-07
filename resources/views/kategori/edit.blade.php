@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Edit Kategori</h1>

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('admin.kategori.update', $kategori->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>ID</label>
                    <input type="text" class="form-control" value="{{ $kategori->id }}" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text"
                           name="kategori"
                           class="form-control"
                           value="{{ old('kategori', $kategori->kategori) }}"
                           required>

                    @error('kategori')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Gambar Kategori</label>

                    @if($kategori->gambar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$kategori->gambar) }}" width="80">
                        </div>
                    @endif

                    <input type="file" name="gambar" class="form-control">

                    @error('gambar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>

</div>
@endsection