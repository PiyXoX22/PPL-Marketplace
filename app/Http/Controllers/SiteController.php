<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class SiteController extends Controller
{
    public function index()
    {
        // Ambil produk dari database
        $produk = Produk::with('harga')->paginate(20);

        // Kirim ke view
        return view('site.index', compact('produk'));
    }
}
