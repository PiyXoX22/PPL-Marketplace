@extends('layouts.app')

@section('content')

<div class="container">

<h2>Tambah Banner</h2>

<form action="{{ route('admin.upui.store') }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="mb-3">
<label>Judul</label>
<input type="text" name="judul" class="form-control">
</div>

<div class="mb-3">
<label>Subjudul</label>
<input type="text" name="subjudul" class="form-control">
</div>

<div class="mb-3">
<label>Gambar</label>
<input type="file" name="gambar" class="form-control">
</div>

<button class="btn btn-success">Simpan</button>

</form>

</div>

@endsection