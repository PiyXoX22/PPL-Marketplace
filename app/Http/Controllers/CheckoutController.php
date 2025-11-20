<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class CheckoutController extends Controller
{
    public function index($id)
    {
        // Ambil produk lengkap dengan relasinya
        $produk = Produk::with(['harga', 'gambar', 'stok', 'kategori'])
                        ->findOrFail($id);

        // Kirim ke view
        return view('checkout.index', compact('produk'));
    }

}
