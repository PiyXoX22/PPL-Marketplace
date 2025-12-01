<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // =========================
    // CHECKOUT 1 PRODUK
    // =========================
    public function index($id)
    {
        $produk = Produk::with(['harga', 'gambar'])->find($id);

        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        $user = Auth::user();
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


    // =========================
    // CHECKOUT KERANJANG
    // =========================
    public function cartCheckout()
    {
        $user = Auth::user();

        $cartItems = Cart::with('product.harga')
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kosong!');
        }

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += ($item->product->harga->harga ?? 0) * $item->quantity;
        }

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


    // =========================
    // PEMBAYARAN CART
    // =========================
    public function payCart(Request $request)
    {
        $request->validate([
            'kurir' => 'required|string',
            'payment_method' => 'required|string',
            'address_id' => 'required|exists:login2_address,id',
        ]);

        $user = Auth::user();
        $cartItems = Cart::with('product.harga')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kosong!');
        }

        $ongkirList = [
            'jne' => 18000,
            'pos' => 17000,
            'jnt' => 19000,
            'sicepat' => 16000,
            'gosend' => 20000,
        ];
        $ongkir = $ongkirList[$request->kurir] ?? 17000;

        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'address_id' => $request->address_id,
                'total' => $cartItems->sum(fn($item) => ($item->product->harga->harga ?? 0) * $item->quantity),
                'shipping_fee' => $ongkir,
                'shipping_courier' => $request->kurir,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            foreach ($cartItems as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->harga->harga ?? 0,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();

            DB::commit();
            return redirect()->route('checkout.success', $transaction->id)
                ->with('success', 'Transaksi berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    // =========================
    // UPDATE QTY CART
    // =========================
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        if ($request->action === 'increase') {
            $cart->quantity += 1;
        } elseif ($request->action === 'decrease' && $cart->quantity > 1) {
            $cart->quantity -= 1;
        }

        $cart->save();
        return redirect()->route('cart.index')
            ->with('success', 'Keranjang berhasil diperbarui!');
    }


    // =========================
    // SET DEFAULT ADDRESS
    // =========================
    public function selectAddress(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:login2_address,id',
        ]);

        $user = Auth::user();

        Address::where('user_id', $user->id)->update(['is_default' => 0]);

        Address::where('id', $request->address_id)
            ->update(['is_default' => 1]);

        return back()->with('success', 'Alamat utama berhasil diubah!');
    }
}
