<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Cart;           // ← WAJIB
use Illuminate\Support\Facades\Auth; // ← WAJIB

class CheckoutController extends Controller
{
    public function index($id)
    {
        // Coba cek apakah ID adalah ID produk
        $produk = Produk::with(['harga', 'gambar', 'stok', 'kategori'])
                        ->find($id);

        if ($produk) {
            // MODE: checkout 1 produk
            return view('checkout.index', [
                'mode' => 'single',
                'produk' => $produk,
            ]);
        }

        // Jika bukan ID produk, berarti ID user → checkout cart
        $cartItems = Cart::with('product')
                        ->where('user_id', $id)
                        ->get();

        if ($cartItems->isEmpty()) {
            return abort(404, 'Cart kosong atau user tidak ditemukan.');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $harga = $item->product->harga->harga ?? 0;
            $total += $harga * $item->quantity;
        }

        return view('checkout.cart', [
            'mode' => 'cart',
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }
    public function update(Request $request, $id)
{
    $cart = Cart::findOrFail($id);

    if($request->action === 'increase') {
        $cart->quantity += 1;
    } elseif($request->action === 'decrease' && $cart->quantity > 1) {
        $cart->quantity -= 1;
    }

    $cart->save();

    return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui!');
}


}
