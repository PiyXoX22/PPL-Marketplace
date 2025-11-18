@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4 text-center">✏ Edit Harga Produk</h2>

    {{-- Pesan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <form action="{{ route('harga.update', $harga->id_prod) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">ID Produk</label>
                    <input type="text" class="form-control" value="{{ $harga->id_prod }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" step="0.01" name="harga" class="form-control" value="{{ $harga->harga }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('harga.index') }}" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>

</div>
@endsection
