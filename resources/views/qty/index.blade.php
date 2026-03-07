@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Data Qty</h1>

        <a href="{{ route('admin.qty.create') }}"
           class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm"></i> Tambah Qty
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
                List Qty Produk
            </h6>
        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="thead-dark">
                        <tr>
                            <th width="60">ID</th>
                            <th>Nama Produk</th>
                            <th width="120">Qty</th>
                            <th width="160">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse ($qty as $q)

                        <tr>

                            <!-- ID -->
                            <td>
                                <span class="badge badge-secondary">
                                    {{ $loop->iteration }}
                                </span>
                            </td>


                            <!-- PRODUK -->
                            <td class="font-weight-bold">
                                {{ $q->produk->nama_produk ?? '-' }}
                            </td>


                            <!-- QTY -->
                            <td>
                                <span class="badge badge-warning">
                                    {{ $q->qty }}
                                </span>
                            </td>


                            <!-- ACTION -->
                            <td>

                                <a href="{{ route('admin.qty.edit', $q->id_prod) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>


                                <form action="{{ route('admin.qty.destroy', $q->id_prod) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin hapus?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada data qty
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
        {{ $qty->links() }}
    </div>

</div>

@endsection