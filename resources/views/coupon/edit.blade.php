@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Kupon</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.coupon.store') }}">
            @csrf

            <div class="mb-3">
                <label>Kode Kupon</label>
                <input type="text" name="code" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tipe</label>
                <select name="type" class="form-control">
                    <option value="percent">Percent</option>
                    <option value="nominal">Nominal</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Nilai</label>
                <input type="number" name="value" class="form-control">
            </div>

            <div class="row">
                <div class="col">
                    <label>Mulai</label>
                    <input type="date" name="start_date" class="form-control">
                </div>
                <div class="col">
                    <label>Berakhir</label>
                    <input type="date" name="end_date" class="form-control">
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.coupon.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
