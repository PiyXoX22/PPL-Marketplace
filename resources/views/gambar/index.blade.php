@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Gambar Produk</h1>

        <a href="{{ route('admin.gambar.create') }}"
           class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm"></i> Tambah Gambar
        </a>
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
                List Gambar Produk
            </h6>
        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="thead-dark">
                        <tr>
                            <th width="60">ID</th>
                            <th>Nama Produk</th>
                            <th width="150">Gambar</th>
                            <th width="160">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($gambar as $g)

                        <tr>

                            <!-- ID -->
                            <td>
                                <span class="badge badge-secondary">
                                    {{ $loop->iteration }}
                                </span>
                            </td>


                            <!-- NAMA PRODUK -->
                            <td class="font-weight-bold">
                                {{ $g->produk->nama_produk ?? '-' }}
                            </td>


                            <!-- GAMBAR -->
                            <td>
                                <img src="{{ asset($g->gambar) }}"
                                     width="80"
                                     class="img-thumbnail">
                            </td>


                            <!-- ACTION -->
                            <td>

                                <a href="{{ route('admin.gambar.edit',$g->id_prod) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form action="{{ route('admin.gambar.destroy',$g->id_prod) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus gambar ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada gambar produk
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
        {{ $gambar->links() }}
    </div>

</div>

@endsection