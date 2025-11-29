@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Qty</h2>

    <form action="{{ route('admin.qty.update', $qty->id_prod) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">ID Produk</label>
            <input type="text" class="form-control" value="{{ $qty->id_prod }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Qty</label>
            <input type="number" name="qty" class="form-control" value="{{ $qty->qty }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.qty.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
