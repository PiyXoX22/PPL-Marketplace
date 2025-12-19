@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ isset($coupon) ? 'Edit Kupon' : 'Tambah Kupon' }}</h5>
    </div>

    <div class="card-body">
        <form method="POST"
            action="{{ isset($coupon)
                ? route('admin.coupon.update', $coupon->id)
                : route('admin.coupon.store') }}">

            @csrf
            @if(isset($coupon)) @method('PUT') @endif

            <div class="mb-3">
                <label>Kode Kupon</label>
                <input type="text" name="code" class="form-control"
                       value="{{ $coupon->code ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label>Tipe</label>
                <select name="type" class="form-control">
                    <option value="percent"
                        {{ ($coupon->type ?? '') == 'percent' ? 'selected' : '' }}>
                        Percent
                    </option>
                    <option value="fixed"
                        {{ ($coupon->type ?? '') == 'fixed' ? 'selected' : '' }}>
                        Nominal
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label>Nilai</label>
                <input type="number" name="value" class="form-control"
                       value="{{ $coupon->value ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label>Minimal Transaksi</label>
                <input type="number" name="min_transaction" class="form-control"
                       value="{{ $coupon->min_transaction ?? '' }}">
            </div>

            <div class="mb-3">
                <label>Max Diskon</label>
                <input type="number" name="max_discount" class="form-control"
                       value="{{ $coupon->max_discount ?? '' }}">
            </div>

            <div class="mb-3">
                <label>Kadaluarsa</label>
                <input type="date" name="expired_at" class="form-control"
                       value="{{ $coupon->expired_at ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="is_active" class="form-control">
                    <option value="1" {{ ($coupon->is_active ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ ($coupon->is_active ?? 1) == 0 ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.coupon.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
