<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Produk;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Produk $product)
    {
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $product->id],
            ['quantity' => 0]
        );

        $cart->increment('quantity');

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function index()
    {
        $cartItems = Cart::with('product.harga')
            ->where('user_id', Auth::id())
            ->get();

        // SUBTOTAL
        $subtotal = $cartItems->sum(fn($item) =>
            ($item->product->harga->harga ?? 0) * $item->quantity
        );

        // DISKON DARI SESSION
        $discount = session('coupon.discount', 0);
        $discount = min($discount, $subtotal);

        $total = $subtotal - $discount;

        return view('cart.index', compact(
            'cartItems',
            'subtotal',
            'discount',
            'total'
        ));
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required']);

        $coupon = Coupon::where('code', $request->code)
            ->where('is_active', 1)
            ->whereDate('expired_at', '>=', now())
            ->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Kode kupon tidak valid'
            ]);
        }

        $cartItems = Cart::with('product.harga')
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $cartItems->sum(fn($item) =>
            ($item->product->harga->harga ?? 0) * $item->quantity
        );

        if ($coupon->min_transaction && $subtotal < $coupon->min_transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Minimal belanja tidak mencukupi'
            ]);
        }

        $discount = $coupon->type === 'percent'
            ? ($coupon->value / 100) * $subtotal
            : $coupon->value;

        if ($coupon->max_discount) {
            $discount = min($discount, $coupon->max_discount);
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $discount
        ]);

        return response()->json([
            'success' => true,
            'discount' => $discount,
            'total' => $subtotal - $discount
        ]);
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        if ($request->action === 'increase') {
            $cart->increment('quantity');
        } elseif ($request->action === 'decrease' && $cart->quantity > 1) {
            $cart->decrement('quantity');
        }

        return back();
    }

    public function remove($id)
    {
        Cart::findOrFail($id)->delete();

        if (Cart::where('user_id', Auth::id())->count() === 0) {
            session()->forget('coupon');
        }

        return back()->with('success', 'Item berhasil dihapus!');
    }
}
