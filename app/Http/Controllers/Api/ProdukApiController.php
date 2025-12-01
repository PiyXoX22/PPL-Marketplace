<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukApiController extends Controller
{
// GET /api/produk
public function index()
{
    $produkList = Produk::with(['harga', 'kategori', 'gambar'])->get();

    $data = $produkList->map(function ($item) {
        return [
            'id'          => $item->id,
            'nama_produk' => $item->nama_produk,
            'harga'       => $item->harga->harga ?? 0,
            'kategori'    => $item->kategori->nama_kategori ?? null,
            'gambar'      => $item->gambar->gambar ?? null,
        ];
    });

    return response()->json([
        'status'  => 'success',
        'message' => 'Daftar produk berhasil diambil',
        'count'   => $produkList->count(),
        'data'    => $data
    ], 200, [], JSON_PRETTY_PRINT);
}



    // POST /api/produk
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_id' => 'required|integer|exists:hargas,id',
            'kategori_id' => 'nullable|integer|exists:kategoris,id',
        ]);

        $produk = Produk::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil ditambahkan',
            'data' => $produk
        ], 201);
    }

    // GET /api/produk/{id}
    public function show($id)
    {
        $produk = Produk::with(['harga', 'kategori', 'gambar'])->find($id);

        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail produk berhasil diambil',
            'data' => $produk
        ], 200);
    }

    // PUT /api/produk/{id}
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan',
                'data' => null
            ], 404);
        }

        $produk->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil diupdate',
            'data' => $produk
        ], 200);
    }

    // DELETE /api/produk/{id}
    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak ditemukan',
                'data' => null
            ], 404);
        }

        $produk->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil dihapus',
            'data' => null
        ], 200);
    }
}
