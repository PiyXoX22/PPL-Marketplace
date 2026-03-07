@extends('layouts.app')

@section('content')
<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Tambah Kategori</h1>

<div class="card shadow">
<div class="card-body">

<form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="form-group">
<label>Nama Kategori</label>
<input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}">

@error('kategori')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<div class="form-group">
<label>Gambar Kategori</label>
<input type="file" name="gambar" class="form-control">

@error('gambar')
<small class="text-danger">{{ $message }}</small>
@enderror
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>

</div>
@endsection