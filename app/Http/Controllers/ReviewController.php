<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $produkId)
    {
        // Ambil produk
        $produk = Produk::findOrFail($produkId);

        // 1. Harus login
        if (!auth()->check()) {
            abort(403, 'Silakan login terlebih dahulu');
        }

        // 2. Harus sudah membeli produk
        if (!$produk->sudahDibeliOleh(auth()->id())) {
            abort(403, 'Anda belum membeli produk ini');
        }

        // 3. Cegah review ganda (1 user 1 review per produk)
        $sudahReview = Review::where('produk_id', $produkId)
            ->where('nama', auth()->user()->name)
            ->exists();

        if ($sudahReview) {
            abort(403, 'Anda sudah memberikan review untuk produk ini');
        }

        // 4. Validasi input
        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
        ]);

        // 5. Simpan review
        Review::create([
            'produk_id' => $produkId,
            'nama'      => auth()->user()->name,
            'rating'    => $request->rating,
            'komentar'  => $request->komentar,
        ]);

        // 6. Kembali ke halaman produk
        return back()->with('success', 'Review berhasil dikirim');
    }
}
