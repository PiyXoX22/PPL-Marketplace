<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Harga;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori unik dari DB
        $kategoriList = Kategori::select('kategori')->groupBy('kategori')->get();

        // Query produk + relasi
        $query = Produk::with(['kategori', 'harga', 'gambar', 'stok']);

        // ================================
        // FILTER: KATEGORI
        // ================================
        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });
        }

        // ================================
        // FILTER: HARGA
        // ================================
        if ($request->filled('harga')) {
            [$min, $max] = explode('-', $request->harga);

            $query->whereHas('harga', function($q) use ($min, $max) {
                $q->whereBetween('harga', [$min, $max]);
            });
        }

        // ================================
        // FILTER: SEARCH + HISTORY
        // ================================
        $history = [];

        if ($request->filled('search')) {
            $search = $request->search;

            $history = json_decode($request->cookie('search_history', '[]'), true);

            array_unshift($history, $search);
            $history = array_unique($history);
            $history = array_slice($history, 0, 10);

            Cookie::queue('search_history', json_encode($history), 60*24*30);

            $query->where(function($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('kategori', function($qc) use ($search) {
                      $qc->where('kategori', 'like', "%{$search}%");
                  });
            });

        } else {
            $history = json_decode($request->cookie('search_history', '[]'), true);
        }

        // ================================
        // SORTING
        // ================================

if ($request->sort == 'termurah') {
    $query->orderBy(
        Harga::select('harga')
            ->whereColumn('harga.id_prod', 'produk.id')
            ->limit(1),
        'asc'
    );
}

elseif ($request->sort == 'termahal') {
    $query->orderBy(
        Harga::select('harga')
            ->whereColumn('harga.id_prod', 'produk.id')
            ->limit(1),
        'desc'
    );
}

elseif ($request->sort == 'terbaru') {
    $query->orderBy('id', 'desc');
}

        // ================================
        // RESULT
        // ================================
        $produk = $query->get();

        return view('site.filter', compact('produk', 'kategoriList', 'history'));
    }
}
