<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Produk $product)
    {
        $user = Auth::user();

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'product_id' => $product->id],
            ['quantity' => 0]
        );

        $cart->quantity += 1;
        $cart->save();

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function index()
    {
        $user = Auth::user();

        $cartItems = Cart::with('product.harga')
            ->where('user_id', $user->id)
            ->get();

        // =========================
        // HITUNG SUBTOTAL
        // =========================
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $harga = $item->product->harga->harga ?? 0;
            $subtotal += $harga * $item->quantity;
        }

        // =========================
        // AMBIL DISKON DARI SESSION
        // =========================
        $discount = 0;
        if (session()->has('coupon')) {
            $discount = session('coupon.discount');
        }

        // Pastikan diskon tidak lebih besar dari subtotal
        if ($discount > $subtotal) {
            $discount = $subtotal;
        }

        // =========================
        // TOTAL AKHIR
        // =========================
        $total = $subtotal - $discount;

        return view('cart.index', compact(
            'cartItems',
            'subtotal',
            'discount',
            'total'
        ));
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        // Aksi tombol: increase / decrease
        $action = $request->input('action');
        $quantity = (int) $request->input('quantity');

        if ($action === 'increase') {
            $cart->quantity += 1;
        } elseif ($action === 'decrease') {
            if ($cart->quantity > 1) {
                $cart->quantity -= 1;
            }
        } else {
            // Jika user edit manual input quantity
            if ($quantity > 0) {
                $cart->quantity = $quantity;
            }
        }

        $cart->save();

        return back();
    }

    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        // Hapus kupon jika keranjang kosong
        if (Cart::where('user_id', Auth::id())->count() === 0) {
            session()->forget('coupon');
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Item berhasil dihapus!');
    }
}
