@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">📦 Daftar Harga Produk</h2>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pesan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah Harga --}}
    <div class="card mb-4">
        <div class="card-header">Tambah Harga Baru</div>
        <div class="card-body">
            <form action="{{ route('admin.harga.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">ID Produk</label>
                    <input type="number" class="form-control" name="id_prod" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" step="0.01" class="form-control" name="harga" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    {{-- Tabel Harga --}}
    <div class="card">
        <div class="card-header">Daftar Harga Produk</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID Produk</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
               <tbody>
                @forelse ($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->harga }}</td>
                        <td>
                            <a href="{{ route('admin.harga.edit', $row->id_prod) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.harga.destroy', $row->id_prod) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada data harga.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
