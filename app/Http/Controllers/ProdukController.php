<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Harga;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function exportPdf()
    {
        $produk = Produk::with(['stok', 'kategori', 'harga', 'gambar'])->get();

        foreach ($produk as $p) {
            if ($p->gambar && $p->gambar->gambar) {
                $p->gambar_path = public_path($p->gambar->gambar); // PATH ABSOLUT
            } else {
                $p->gambar_path = null;
            }
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('produk.pdf', compact('produk'))
                ->setPaper('a4', 'landscape'); // lebar biar muat tabel

        return $pdf->download('data-produk.pdf');
    }
     // FORM CREATE
     public function buat()
     {
         $kategori = Kategori::all();
         return view('produk.buat', compact('kategori'));
     }

     // SIMPAN DATA DALAM RELASI
     public function simpan(Request $request)
     {
         $request->validate([
             'nama' => 'required',
             'kategori_id' => 'required',
             'harga' => 'required|numeric',
             'stok' => 'required|numeric',
             'gambar.*' => 'image|mimes:jpg,png,jpeg'
         ]);

         // 1. SIMPAN PRODUK
         $produk = Produk::create([
             'nama' => $request->nama,
             'deskripsi' => $request->deskripsi,
             'kategori_id' => $request->kategori_id,
         ]);

         // 2. SIMPAN HARGA
         $produk->harga()->create([
             'harga' => $request->harga
         ]);

         // 3. SIMPAN STOK
         $produk->stok()->create([
             'stok' => $request->stok
         ]);

         // 4. SIMPAN GAMBAR (multiple)
         if ($request->hasFile('gambar')) {
             foreach ($request->file('gambar') as $img) {
                 $path = $img->store('produk', 'public');
                 $produk->gambar()->create([
                     'path' => $path
                 ]);
             }
         }

         return redirect()->route('produk.buat')->with('success', 'Produk berhasil ditambahkan!');
     }

}
