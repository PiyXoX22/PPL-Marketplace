@extends('layouts.app')

@section('content')

<div class="container">

<h2>Edit Banner</h2>

<form action="{{ route('admin.upui.update',$banner->id) }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="mb-3">
<label>Judul</label>
<input type="text"
name="judul"
value="{{ $banner->judul }}"
class="form-control">
</div>

<div class="mb-3">
<label>Subjudul</label>
<input type="text"
name="subjudul"
value="{{ $banner->subjudul }}"
class="form-control">
</div>

<div class="mb-3">
<label>Gambar Baru</label>
<input type="file" name="gambar" class="form-control">
</div>

<img src="{{ asset($banner->gambar) }}" width="200">

<button class="btn btn-success mt-3">
Update
</button>

</form>

</div>

@endsection