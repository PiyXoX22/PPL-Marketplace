@extends('layouts.app')

@section('content')

<div class="container">

<h2>Data Banner</h2>

<a href="{{ route('admin.upui.create') }}" class="btn btn-primary mb-3">
Tambah Banner
</a>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Judul</th>
<th>Subjudul</th>
<th>Gambar</th>
<th>Aksi</th>
</tr>

@foreach($banner as $b)

<tr>

<td>{{ $b->id }}</td>
<td>{{ $b->judul }}</td>
<td>{{ $b->subjudul }}</td>

<td>
<img src="{{ asset($b->gambar) }}" width="120">
</td>

<td>

<a href="{{ route('admin.upui.edit',$b->id) }}"
class="btn btn-warning btn-sm">
Edit
</a>

<form action="{{ route('admin.upui.destroy',$b->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">
Hapus
</button>

</form>

</td>

</tr>

@endforeach

</table>

</div>

@endsection