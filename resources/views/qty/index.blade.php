@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">Data Qty</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.qty.create') }}" class="btn btn-primary mb-3">+ Tambah Qty</a>

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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $q->qty }}</td>
                    <td>
                        <a href="{{ route('admin.qty.edit', $q->id_prod) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('admin.qty.destroy', $q->id_prod) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin hapus?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
