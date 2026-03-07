@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Data Produk</h1>

        <div>
            <a href="{{ route('admin.produk.create') }}"
               class="btn btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm"></i> Tambah Produk
            </a>

            <a href="{{ route('admin.produk.export.pdf') }}"
               class="btn btn-danger shadow-sm">
                <i class="fas fa-file-pdf fa-sm"></i> Export PDF
            </a>
        </div>
    </div>


    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif


    <!-- Card -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                List Produk
            </h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="thead-dark">
                        <tr>
                            <th width="60">ID</th>
                            <th width="90">Gambar</th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th width="120">Kategori</th>
                            <th width="80">Qty</th>
                            <th width="120">Harga</th>
                            <th width="160">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($produk as $p)

                    <tr>

                        <!-- ID -->
                        <td>
                            <span class="badge badge-secondary">
                                {{ $loop->iteration }}
                            </span>
                        </td>


                        <!-- GAMBAR -->
                        <td>
                            @if($p->gambar && $p->gambar->gambar)
                                <img src="{{ asset($p->gambar->gambar) }}"
                                     width="60"
                                     class="img-thumbnail">
                            @else
                                <img src="https://via.placeholder.com/60"
                                     class="img-thumbnail">
                            @endif
                        </td>


                        <!-- NAMA -->
                        <td class="font-weight-bold">
                            {{ $p->nama_produk }}
                        </td>


                        <!-- DESKRIPSI -->
                        <td>
                            {{ \Illuminate\Support\Str::limit($p->deskripsi, 80) }}
                        </td>


                        <!-- KATEGORI -->
                        <td>
                            <span class="badge badge-info">
                                {{ $p->kategori->kategori ?? '-' }}
                            </span>
                        </td>


                        <!-- QTY -->
                        <td>
                            <span class="badge badge-warning">
                                {{ $p->stok->qty ?? 0 }}
                            </span>
                        </td>


                        <!-- HARGA -->
                        <td>
                            <span class="badge badge-success">
                            Rp {{ number_format($p->harga->harga ?? 0,0,',','.') }}
                            </span>
                        </td>


                        <!-- ACTION -->
                        <td>

                            <a href="{{ route('admin.produk.edit',$p->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.produk.destroy',$p->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus produk ini?')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            Belum ada data produk
                        </td>
                    </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- Pagination -->
    <div class="mt-3">
        {{ $produk->links() }}
    </div>

</div>

@endsection