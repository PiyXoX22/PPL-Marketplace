@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md shadow-gray-300 rounded-xl p-6 mt-8">

    <h2 class="text-2xl font-semibold mb-4">Tambah Produk Baru</h2>

    <form action="{{ route('admin.produk.simpanBuat') }}" method="POST">
        @csrf

        {{-- NAMA PRODUK --}}
        <div class="mb-4">
            <label class="block font-medium">Nama Produk</label>
            <input type="text" name="nama"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- DESKRIPSI --}}
        <div class="mb-4">
            <label class="block font-medium">Deskripsi</label>
            <textarea name="deskripsi" rows="3"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        {{-- KATEGORI --}}
        <div class="mb-4">
            <label class="block font-medium">Kategori</label>
            <select name="kategori_id"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @foreach ($kategori as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
            </select>
        </div>

        {{-- HARGA --}}
        <div class="mb-4">
            <label class="block font-medium">Harga</label>
            <input type="number" name="harga"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- STOK --}}
        <div class="mb-4">
            <label class="block font-medium">Stok</label>
            <input type="number" name="stok"
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- GAMBAR --}}
        <div class="mb-4">
            <label class="block font-medium">Upload Gambar</label>
            <input type="file" name="gambar[]" multiple
                class="mt-1 w-full border-gray-300 rounded-lg shadow-sm">
            <small class="text-gray-500">Bisa upload lebih dari satu gambar</small>
        </div>

        {{-- BUTTON --}}
        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Simpan
            </button>
        </div>

    </form>
</div>
@endsection
