@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Data Harga</h1>

        <a href="{{ route('admin.harga.create') }}"
           class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm"></i> Tambah Harga
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
                List Harga Produk
            </h6>
        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="thead-dark">
                        <tr>
                            <th width="60">ID</th>
                            <th>Produk</th>
                            <th width="180">Harga</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($data as $d)

                        <tr>

                            <!-- ID -->
                            <td>
                                <span class="badge badge-secondary">
                                    {{ $loop->iteration }}
                                </span>
                            </td>


                            <!-- PRODUK -->
                            <td class="font-weight-bold">
                                {{ $d->produk->nama_produk ?? $d->id_prod }}
                            </td>


                            <!-- HARGA -->
                            <td>
                                <span class="badge badge-success">
                                    Rp {{ number_format($d->harga,0,',','.') }}
                                </span>
                            </td>


                            <!-- ACTION -->
                            <td>

                                <a href="{{ route('admin.harga.show',$d->id_prod) }}"
                                   class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a href="{{ route('admin.harga.edit',$d->id_prod) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form action="{{ route('admin.harga.destroy',$d->id_prod) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus data ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada data harga
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
        {{ $data->links() }}
    </div>

</div>

@endsection