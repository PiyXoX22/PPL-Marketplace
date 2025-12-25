<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $produkId)
    {
        // HARUS LOGIN
        if (!auth()->check()) {
            return back()->with('error', 'Silakan login terlebih dahulu');
        }

        // PRODUK VALID
        $produk = Produk::findOrFail($produkId);

        // CEGAH REVIEW GANDA
        $sudahReview = Review::where('produk_id', $produkId)
            ->where('user_id', auth()->id())
            ->exists();

        if ($sudahReview) {
            return back()->with('error', 'Anda sudah memberi review untuk produk ini');
        }

        // VALIDASI
        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:500',
        ]);

        // SIMPAN REVIEW
        Review::create([
            'produk_id' => $produkId,
            'user_id'   => auth()->id(),
            'rating'    => $request->rating,
            'komentar'  => $request->komentar,
        ]);

        return back()->with('success', 'Review berhasil dikirim');
    }
}
