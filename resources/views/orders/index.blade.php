@extends('layouts.app')

@section('title', 'Pengelolaan Transaksi')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Data Transaksi</h1>

        <a href="{{ route('admin.orders.create') }}"
           class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm"></i> Tambah Transaksi
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
                List Transaksi
            </h6>
        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="thead-dark">
                        <tr>
                            <th width="60">ID</th>
                            <th width="140">Tanggal</th>
                            <th>Total</th>
                            <th>Grand Total</th>
                            <th>Paid</th>
                            <th width="120">Status</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($trx as $t)

                        <tr>

                            <!-- ID -->
                            <td>
                                <span class="badge badge-secondary">
                                    {{ $loop->iteration }}
                                </span>
                            </td>


                            <!-- TANGGAL -->
                            <td>
                                {{ $t->tanggal }}
                            </td>


                            <!-- TOTAL -->
                            <td>
                                Rp {{ number_format($t->total,0,',','.') }}
                            </td>


                            <!-- GRAND TOTAL -->
                            <td>
                                <span class="font-weight-bold">
                                    Rp {{ number_format($t->grand_total,0,',','.') }}
                                </span>
                            </td>


                            <!-- PAID -->
                            <td>
                                {{ number_format($t->paid,0,',','.') }}
                            </td>


                            <!-- STATUS -->
                            <td>

                                @if($t->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>

                                @elseif($t->status == 'terbayar')
                                    <span class="badge badge-success">Terbayar</span>

                                @elseif($t->status == 'cancel')
                                    <span class="badge badge-danger">Cancel</span>

                                @elseif($t->status == 'gagal')
                                    <span class="badge badge-danger">Gagal</span>

                                @else
                                    <span class="badge badge-secondary">
                                        {{ ucfirst($t->status) }}
                                    </span>
                                @endif

                            </td>


                            <!-- ACTION -->
                            <td>

                                <a href="{{ route('admin.orders.show',$t->id) }}"
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.orders.edit',$t->id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.orders.destroy',$t->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus transaksi ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Belum ada transaksi
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
        {{ $trx->links() }}
    </div>

</div>

@endsection