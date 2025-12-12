<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class SiteController extends Controller
{
    public function index()
    {
        // Ambil semua kategori
        $kategoriList = Kategori::all()->unique('kategori')->values();

        // Ambil produk dari database
        $produk = Produk::with('harga')->paginate(20);

        // Kirim ke view
        return view('site.index', compact('produk', 'kategoriList'));
    }

}
