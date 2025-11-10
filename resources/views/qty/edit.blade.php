@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Qty</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-4">Edit Qty</h1>

    <form action="{{ route('qty.update', $qty->id_prod) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Jumlah Qty</label>
            <input type="number" name="qty" class="form-control" value="{{ $qty->qty }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('qty.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
@endsection
