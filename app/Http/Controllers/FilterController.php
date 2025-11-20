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

        // ================================
        // FILTER: Kategori
        // ================================
        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });
        }

        // ================================
        // FILTER: Search (nama, deskripsi, kategori)
        // ================================
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function($q) use ($search) {

                // cari berdasarkan nama produk
                $q->where('nama_produk', 'like', "%{$search}%")

                // cari berdasarkan deskripsi
                ->orWhere('deskripsi', 'like', "%{$search}%")

                // cari berdasarkan kategori
                ->orWhereHas('kategori', function($qc) use ($search) {
                    $qc->where('kategori', 'like', "%{$search}%");
                });

            });
        }

        // Ambil hasil akhir
        $produk = $query->get();

        return view('site.filter', compact('produk', 'kategoriList'));
    }
}
