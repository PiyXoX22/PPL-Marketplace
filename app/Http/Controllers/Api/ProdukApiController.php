<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Produk::all()
        ], 200);
    }

    public function store(Request $request)
    {
        $produk = Produk::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Produk ditambahkan',
            'data' => $produk
        ], 201);
    }

    public function show($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $produk
        ]);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $produk->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Produk diupdate',
            'data' => $produk
        ]);
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $produk->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk dihapus'
        ]);
    }
}
