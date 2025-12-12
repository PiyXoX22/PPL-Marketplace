@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Transaksi Baru</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>ID Transaksi</label>
            <input type="text" name="id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Total</label>
            <input type="number" name="total" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Grand Total</label>
            <input type="number" name="grand_total" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Payment Method</label>
            <input type="text" name="payment_method" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="terbayar">Terbayar</option>
                <option value="dikemas">Dikemas</option>
                <option value="dalam_pengantaran">Dalam Pengantaran</option>
                <option value="gagal">Gagal</option>
                <option value="cancel">Cancel</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
