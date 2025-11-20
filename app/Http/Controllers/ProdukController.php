<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Harga;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // ============================================================
    // Tampilkan semua produk + filter kategori
    // ============================================================
    public function index(Request $request)
    {
        // Ambil daftar kategori unik
        $kategoriList = Kategori::select('kategori')->groupBy('kategori')->get();

        // Query dasar produk + relasi
        $query = Produk::with(['stok', 'kategori', 'harga', 'gambar']);

        // Filter kategori jika dipilih
        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });
        }

        $produk = $query->get();

        return view('produk.index', compact('produk', 'kategoriList'));
    }

    // ============================================================
    // Form Tambah Produk
    // ============================================================
    public function create()
    {
        return view('produk.create');
    }

    // ============================================================
    // SIMPAN PRODUK BARU
    // ============================================================
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:150',
            'deskripsi'   => 'required|string',
            'harga'       => 'required|numeric',
        ]);

        // Buat produk
        $produk = Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi'   => $request->deskripsi,
        ]);

        // Simpan harga berdasarkan id produk
        Harga::create([
            'id_prod' => $produk->id,
            'harga'   => $request->harga,
        ]);

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil ditambahkan!');
    }

    // ============================================================
    // EDIT
    // ============================================================
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    // ============================================================
    // UPDATE PRODUK
    // ============================================================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:150',
            'deskripsi'   => 'required|string'
        ]);

        $produk = Produk::findOrFail($id);

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi'   => $request->deskripsi
        ]);

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil diperbarui!');
    }

    // ============================================================
    // HAPUS PRODUK
    // ============================================================
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil dihapus!');
    }

    // ============================================================
    // DETAIL
    // ============================================================
    public function show($id)
    {
        $produk = Produk::with(['kategori', 'stok', 'harga', 'gambar'])->findOrFail($id);

        return view('produk.show', compact('produk'));
    }
}
