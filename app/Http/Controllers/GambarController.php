<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use App\Models\Produk;
use Illuminate\Http\Request;

class GambarController extends Controller
{
    public function index()
    {
        $gambar = Gambar::with('produk')->paginate(10);
        return view('gambar.index', compact('gambar'));
    }

    public function create()
    {
        $produk = Produk::all();
        return view('gambar.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_prod' => 'required|integer|exists:produk,id',
            'gambar'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ====== SIMPAN KE PUBLIC/UPLOADS ======
        $file     = $request->file('gambar');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $namaFile);

        // Simpan path untuk database
        $path = 'uploads/' . $namaFile;

        Gambar::create([
            'id_prod' => $request->id_prod,
            'gambar'  => $path,
        ]);

        return redirect()->route('admin.gambar.index')->with('success', 'Gambar berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $gambar = Gambar::where('id_prod', $id)->firstOrFail();
        $produk = Produk::all();

        return view('gambar.edit', compact('gambar', 'produk'));
    }

    public function update(Request $request, $id)
    {
        $gambar = Gambar::where('id_prod', $id)->firstOrFail();

        if ($request->hasFile('gambar')) {

            $request->validate([
                'gambar' => 'image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // Hapus file lama di public/uploads
            if (file_exists(public_path($gambar->gambar))) {
                unlink(public_path($gambar->gambar));
            }

            // Upload file baru
            $file     = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $namaFile);

            $pathBaru = 'uploads/' . $namaFile;

            $gambar->update([
                'gambar' => $pathBaru,
            ]);
        }

        return redirect()->route('admin.gambar.index')->with('success', 'Gambar berhasil diperbarui.');

    }

    public function destroy($id)
    {
        $gambar = Gambar::where('id_prod', $id)->firstOrFail();

        // Hapus file dari public/uploads
        if (file_exists(public_path($gambar->gambar))) {
            unlink(public_path($gambar->gambar));
        }

        $gambar->delete();

        return redirect()->route('admin.gambar.index')->with('success', 'Gambar berhasil dihapus.');

    }
}
