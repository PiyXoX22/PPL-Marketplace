@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Qty</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-4 text-center">Data Qty</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('qty.create') }}" class="btn btn-primary mb-3">+ Tambah Qty</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID Produk</th>
                <th>Qty</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($qty as $q)
                <tr>
                    <td>{{ $q->id_prod }}</td>
                    <td>{{ $q->qty }}</td>
                    <td>
                        <a href="{{ route('qty.edit', $q->id_prod) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('qty.destroy', $q->id_prod) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
@endsection
