<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qty;

class QtyController extends Controller
{
    // Menampilkan semua data qty
    public function index()
    {
        $qty = Qty::all();
        return view('qty.index', compact('qty'));
    }

    // Menampilkan form tambah qty
    public function create()
    {
        return view('qty.create');
    }

    // Menyimpan qty baru
    public function store(Request $request)
    {
        $request->validate([
            'qty' => 'required|integer',
        ]);

        Qty::create([
            'qty' => $request->qty,
        ]);

        return redirect()->route('qty.index')->with('success', 'Data qty berhasil ditambahkan!');
    }

    // Menampilkan form edit qty
    public function edit($id)
    {
        $qty = Qty::findOrFail($id);
        return view('qty.edit', compact('qty'));
    }

    // Memperbarui data qty
    public function update(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer',
        ]);

        $qty = Qty::findOrFail($id);
        $qty->update([
            'qty' => $request->qty,
        ]);

        return redirect()->route('qty.index')->with('success', 'Data qty berhasil diperbarui!');
    }

    // Menghapus data qty
    public function destroy($id)
    {
        $qty = Qty::findOrFail($id);
        $qty->delete();

        return redirect()->route('qty.index')->with('success', 'Data qty berhasil dihapus!');
    }
}
