<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;

class KategoriController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $kategori = Kategori::with('barang')->get();
        return view('kategori.index', compact('kategori'));
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        // Produk yang belum punya kategori
        $produk = Produk::doesntHave('kategori')->get();

        return view('kategori.create', compact('produk'));
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'id_prod'   => 'required|exists:produk,id|unique:kategori,id_prod',
            'kategori'  => 'required|string|max:100',
        ]);

        Kategori::create([
            'id_prod'  => $request->id_prod,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Menampilkan form edit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string|max:100',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    // Hapus kategori
    public function destroy($id)
    {
        Kategori::destroy($id);
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
