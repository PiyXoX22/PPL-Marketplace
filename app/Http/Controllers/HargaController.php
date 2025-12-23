<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    public function index()
    {
        $data = Harga::paginate(10);
        return view('harga.index', compact('data'));
    }

    public function create()
    {
        return view('harga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_prod' => 'required|integer|unique:harga,id_prod',
            'harga'   => 'required|numeric',
        ]);

        Harga::create($validated);
        return redirect()->route('admin.harga.index')
        ->with('success', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        $harga = Harga::where('id_prod', $id)->firstOrFail();
        return view('harga.show', compact('harga'));
    }

    public function edit($id)
    {
        $harga = Harga::where('id_prod', $id)->firstOrFail();
        return view('harga.edit', compact('harga'));
    }

    public function update(Request $request, $id)
    {
        $harga = Harga::where('id_prod', $id)->firstOrFail();

        $validated = $request->validate([
            'harga' => 'required|numeric',
        ]);

        $harga->update($validated);
        return redirect()->route('admin.harga.index')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        $harga = Harga::where('id_prod', $id)->firstOrFail();
        $harga->delete();
        return redirect()->route('admin.harga.index')->with('success', 'Data berhasil dihapus!');
    }


}
