<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Cart;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Checkout produk single atau cart
     */
    public function index($id)
    {
        $user = Auth::user();

        // Cek apakah ID produk → MODE PRODUK SINGLE
        $produk = Produk::with(['harga', 'gambar', 'stok', 'kategori'])->find($id);

        if ($produk) {

            // Ambil alamat default user
            $addresses = $user->addresses;
            $selectedAddress = $addresses->where('is_default', 1)->first() 
                ?? $addresses->first();

            return view('checkout.index', [
                'mode' => 'single',
                'produk' => $produk,
                'addresses' => $addresses,
                'selectedAddress' => $selectedAddress
            ]);
        }

        // Jika bukan produk → MODE CART
        $cartItems = Cart::with('product')
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        // Hitung total harga item
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += ($item->product->harga->harga ?? 0) * $item->quantity;
        }

        // Ambil alamat user
        $addresses = $user->addresses;
        $selectedAddress = $addresses->where('is_default', 1)->first() 
            ?? $addresses->first();

        return view('checkout.cart', [
            'mode' => 'cart',
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'addresses' => $addresses,
            'selectedAddress' => $selectedAddress
        ]);
    }


    /**
     * Update qty cart melalui tombol + -
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        if ($request->action === 'increase') {
            $cart->quantity += 1;
        } elseif ($request->action === 'decrease' && $cart->quantity > 1) {
            $cart->quantity -= 1;
        }

        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui!');
    }


    /**
     * Set alamat sebagai default saat checkout
     */
    public function selectAddress(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:login2_address,id'
        ]);

        $user = Auth::user();

        // Reset default semua dulu
        Address::where('user_id', $user->id)->update(['is_default' => 0]);

        // Jadikan alamat yang dipilih jadi default
        Address::where('id', $request->address_id)
            ->where('user_id', $user->id)
            ->update(['is_default' => 1]);

        return back()->with('success', 'Alamat utama berhasil diubah!');
    }
}
