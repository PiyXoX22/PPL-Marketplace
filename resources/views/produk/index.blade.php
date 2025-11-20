@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Data Produk</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">
        + Tambah Produk
    </a>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($produk as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->nama_produk }}</td>
                            <td>{{ $p->deskripsi }}</td>

                            {{-- kategori --}}
                            <td>
                                {{ $p->kategori->kategori ?? '-' }}
                            </td>

                            {{-- qty --}}
                            <td>
                                {{ $p->stok->qty ?? 0 }}
                            </td>

                            {{-- harga --}}
                            <td>
                                {{ $p->harga->harga ?? '-' }}
                            </td>

                            {{-- gambar --}}
                            <td>
                                @if($p->gambar && $p->gambar->gambar)
                                    <img src="{{ asset($p->gambar->gambar) }}" width="60">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('produk.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                {{-- <a href="{{ route('produk.show', $p->id) }}" class="btn btn-info btn-sm">Show</a> --}}

                                <form action="{{ route('produk.destroy', $p->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

@endsection
