@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Data Kupon</h5>
        <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary">
            Tambah Kupon
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Tipe</th>
                    <th>Nilai</th>
                    <th>Periode</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $c)
                <tr>
                    <td>{{ $c->code }}</td>
                    <td>{{ $c->type }}</td>
                    <td>{{ $c->value }}</td>
                    <td>{{ $c->start_date }} - {{ $c->end_date }}</td>
                    <td>
                        <span class="badge {{ $c->is_active ? 'bg-success':'bg-danger' }}">
                            {{ $c->is_active ? 'Aktif':'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.coupon.edit',$c->id) }}"
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('admin.coupon.destroy',$c->id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus kupon?')">
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
@endsection
