@extends('layouts.app')

@section('content')

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Data Harga</h1>

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<a href="{{ route('admin.harga.create') }}" class="btn btn-primary mb-3">
+ Tambah Harga
</a>

<div class="card shadow">
<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-striped">

<thead class="thead-dark">
<tr>
<th>Produk</th>
<th>Harga</th>
<th width="180px">Aksi</th>
</tr>
</thead>

<tbody>

@forelse($data as $d)

<tr>

<td>
{{ $d->produk->nama_produk ?? $d->id_prod }}
</td>

<td>
Rp {{ number_format($d->harga,0,',','.') }}
</td>

<td>

<a href="{{ route('admin.harga.show',$d->id_prod) }}"
class="btn btn-info btn-sm">
Detail
</a>

<a href="{{ route('admin.harga.edit',$d->id_prod) }}"
class="btn btn-warning btn-sm">
Edit
</a>

<form action="{{ route('admin.harga.destroy',$d->id_prod) }}"
method="POST"
class="d-inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data ini?')">
Hapus
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="3" class="text-center">
Belum ada data
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>
</div>

<div class="mt-3">
{{ $data->links() }}
</div>

</div>

@endsection