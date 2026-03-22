<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\Kategori;

class SiteController extends Controller
{
    public function index()
    {
        // Ambil semua kategori
        $kategoriList = Kategori::all()->unique('kategori')->values();

        // Ambil produk dari database
        $produk = Produk::with(['harga','gambar'])->paginate(80);

        // Ambil banner dari database
        $banners = DB::table('banner')
                    ->where('status', 1)
                    ->get();

        // Kirim ke view
        return view('site.index', compact('produk', 'kategoriList', 'banners'));
    }

}
