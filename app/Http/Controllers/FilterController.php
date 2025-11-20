<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori unik dari DB
        $kategoriList = Kategori::select('kategori')->groupBy('kategori')->get();

        // Query produk + relasi
        $query = Produk::with(['kategori', 'harga', 'gambar', 'stok']);

        // Jika ada filter kategori
        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });
        }

        $produk = $query->get();

        return view('site.filter', compact('produk', 'kategoriList'));
    }
}
