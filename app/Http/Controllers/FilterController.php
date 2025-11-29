<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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
        $history = [];
        if ($request->filled('search')) {
            $search = $request->search;

            // Simpan riwayat pencarian via cookie
            $history = json_decode($request->cookie('search_history', '[]'), true);

            array_unshift($history, $search);        // keyword terbaru di depan
            $history = array_unique($history);       // hapus duplikat
            $history = array_slice($history, 0, 10); // maksimal 10 keyword terakhir

            Cookie::queue('search_history', json_encode($history), 60*24*30); // simpan 30 hari

            // Query search
            $query->where(function($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('kategori', function($qc) use ($search) {
                      $qc->where('kategori', 'like', "%{$search}%");
                  });
            });
        } else {
            // Ambil riwayat jika tidak search
            $history = json_decode($request->cookie('search_history', '[]'), true);
        }

        // Ambil hasil akhir
        $produk = $query->get();

        return view('site.filter', compact('produk', 'kategoriList', 'history'));
    }
}
