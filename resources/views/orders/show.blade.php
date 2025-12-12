@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Transaksi: {{ $trx->id }}</h1>

    <div class="mb-3">
        <strong>Tanggal:</strong> {{ $trx->tanggal }} <br>
        <strong>Total:</strong> {{ number_format($trx->total,0,',','.') }} <br>
        <strong>Grand Total:</strong> {{ number_format($trx->grand_total,0,',','.') }} <br>
        <strong>Paid:</strong> {{ number_format($trx->paid,0,',','.') }} <br> <!-- Tambahkan -->
        <strong>Status:</strong> {{ ucfirst($trx->status) }} <br>
        <strong>Payment Method:</strong> {{ $trx->payment_method }} <br>
    </div>

    <h3>Detail Barang</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Barang</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trx->detail as $item)
            <tr>
                <td>{{ $item->id_barang }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($item->harga_satuan,0,',','.') }}</td>
                <td>{{ number_format($item->subtotal,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
