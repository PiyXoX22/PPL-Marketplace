@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kategori</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container py-4">
    <h1 class="mb-4 text-center">Data Kategori</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategori as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->kategori }}</td>
                    <td>
                        <a href="{{ route('admin.kategori.edit', $k->id_prod) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.kategori.destroy', $k->id_prod) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $kategori->links() }}
</div>


</body>
</html>
@endsection
