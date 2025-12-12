@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Transaksi: {{ $trx->id }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.orders.update', $trx->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                @foreach($statuses as $status)
                    <option value="{{ $status }}" {{ $trx->status==$status?'selected':'' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Paid</label>
            <input type="number" name="paid" class="form-control" value="{{ $trx->paid }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
