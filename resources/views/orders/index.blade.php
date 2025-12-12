@extends('layouts.app')

@section('title', 'Pengelolaan Transaksi')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Transaksi</h1>

    <a href="{{ route('admin.orders.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Grand Total</th>
                <th>Paid</th> <!-- Tambahkan -->
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trx as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->tanggal }}</td>
                <td>{{ number_format($t->total,0,',','.') }}</td>
                <td>{{ number_format($t->grand_total,0,',','.') }}</td>
                <td>{{ number_format($t->paid,0,',','.') }}</td> <!-- Tambahkan -->
                <td>{{ ucfirst($t->status) }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $t->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('admin.orders.edit', $t->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.orders.destroy', $t->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $trx->links() }}
</div>
@endsection
