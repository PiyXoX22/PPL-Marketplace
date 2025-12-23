<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qty;
use App\Models\Produk;

class QtyController extends Controller
{
    // Tampilkan semua qty
    public function index()
    {
        $qty = Qty::with('barang')->paginate(10);
        return view('qty.index', compact('qty'));
    }

    // Form tambah qty
    public function create()
    {
        // pilih produk yang belum punya qty
        $produk = Produk::doesntHave('stok')->get();

        return view('qty.create', compact('produk'));
    }

    // Simpan qty baru
    public function store(Request $request)
    {
        $request->validate([
            'id_prod' => 'required|exists:produk,id|unique:qty,id_prod',
            'qty'     => 'required|integer|min:0',
        ]);

        Qty::create([
            'id_prod' => $request->id_prod,
            'qty'     => $request->qty,
        ]);

        return redirect()->route('qty.index')->with('success', 'Qty berhasil ditambahkan!');
    }

    // Form edit qty
    public function edit($id)
    {
        $qty = Qty::findOrFail($id);
        return view('qty.edit', compact('qty'));
    }

    // Update qty
    public function update(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:0',
        ]);

        $qty = Qty::findOrFail($id);
        $qty->update([
            'qty' => $request->qty,
        ]);

        return redirect()->route('qty.index')->with('success', 'Qty berhasil diperbarui!');
    }

    // Hapus qty
    public function destroy($id)
    {
        Qty::destroy($id);

        return redirect()->route('qty.index')->with('success', 'Qty berhasil dihapus!');
    }
}
