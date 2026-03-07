<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // ================================
    // Menampilkan daftar kategori
    // ================================
    public function index()
    {
        $kategori = Kategori::paginate(10);

        return view('kategori.index', compact('kategori'));
    }

    // ================================
    // Form tambah kategori
    // ================================
    public function create()
    {
        return view('kategori.create');
    }

    // ================================
    // Simpan kategori baru
    // ================================
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:100',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');

            $namaFile = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads'), $namaFile);

            $gambar = 'uploads/'.$namaFile;
        }

        Kategori::create([
            'kategori' => $request->kategori,
            'gambar'   => $gambar
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    // ================================
    // Form edit kategori
    // ================================
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('kategori.edit', compact('kategori'));
    }

    // ================================
    // Update kategori
    // ================================
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required|string|max:100',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $kategori = Kategori::findOrFail($id);

        $data = [
            'kategori' => $request->kategori
        ];

        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');

            $namaFile = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads'), $namaFile);

            $data['gambar'] = 'uploads/'.$namaFile;
        }

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    // ================================
    // Hapus kategori
    // ================================
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        // hapus gambar jika ada
        if ($kategori->gambar && file_exists(public_path($kategori->gambar))) {
            unlink(public_path($kategori->gambar));
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}