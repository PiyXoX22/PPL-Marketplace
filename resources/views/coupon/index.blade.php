@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Data Kupon</h1>

        <a href="{{ route('admin.coupon.create') }}"
           class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm"></i> Tambah Kupon
        </a>
    </div>


    <!-- Card -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                List Kupon
            </h6>
        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="thead-dark">
                        <tr>
                            <th width="60">ID</th>
                            <th>Kode</th>
                            <th width="120">Tipe</th>
                            <th width="120">Nilai</th>
                            <th width="220">Periode</th>
                            <th width="120">Status</th>
                            <th width="160">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($coupons as $c)

                    <tr>

                        <!-- ID -->
                        <td>
                            <span class="badge badge-secondary">
                                {{ $loop->iteration }}
                            </span>
                        </td>

                        <!-- CODE -->
                        <td class="font-weight-bold">
                            {{ $c->code }}
                        </td>

                        <!-- TYPE -->
                        <td>
                            <span class="badge badge-info">
                                {{ strtoupper($c->type) }}
                            </span>
                        </td>

                        <!-- VALUE -->
                        <td>
                            @if($c->type == 'percent')
                                {{ $c->value }} %
                            @else
                                Rp {{ number_format($c->value,0,',','.') }}
                            @endif
                        </td>

                        <!-- PERIODE -->
                        <td>
                            {{ $c->start_date }} <b>-</b> {{ $c->end_date }}
                        </td>

                        <!-- STATUS -->
                        <td>
                            @if($c->is_active)
                                <span class="badge badge-success">
                                    Aktif
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <!-- ACTION -->
                        <td>

                            <a href="{{ route('admin.coupon.edit',$c->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <form action="{{ route('admin.coupon.destroy',$c->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus kupon?')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Belum ada data kupon
                        </td>
                    </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection