<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Trx;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'rating'     => 'required|integer|min:1|max:5',
            'review'     => 'nullable|string',
        ]);

        // cek apakah produk pernah dibeli & transaksi sudah dibayar
        $pernahBeli = Trx::where('paid', 1)
            ->whereIn('id', function ($query) use ($request) {
                $query->select('trx_id')
                      ->from('trx_detail')
                      ->where('id_barang', $request->product_id);
            })
            ->exists();

        if (!$pernahBeli) {
            return back()->with('error', 'Produk ini belum pernah dibeli.');
        }

        Review::create([
            'product_id' => $request->product_id,
            'rating'     => $request->rating,
            'review'     => $request->review,
        ]);

        return back()->with('success', 'Review berhasil disimpan.');
    }
}
