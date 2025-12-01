<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Checkout 1 produk
    public function index($id)
    {
        $produk = Produk::with(['harga', 'gambar', 'stok', 'kategori'])->find($id);

        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan!');
        }

        return view('checkout.index', [
            'mode' => 'single',
            'produk' => $produk,
        ]);
    }

    // Checkout seluruh cart
    public function cartCheckout()
    {
        $user = Auth::user();

        $cartItems = Cart::with('product.harga')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $harga = $item->product->harga->harga ?? 0;
            $total += $harga * $item->quantity;
        }

        return view('checkout.cart', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    // Proses checkout cart (saat klik "Bayar Sekarang")
    public function payCart(Request $request)
    {
        $request->validate([
            'kurir' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $user = Auth::user();
        $cartItems = Cart::with('product.harga')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $ongkirList = [
            'jne'     => 18000,
            'pos'     => 17000,
            'jnt'     => 19000,
            'sicepat' => 16000,
            'gosend'  => 20000,
        ];

        $ongkir = $ongkirList[$request->kurir] ?? 17000;

        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'user_id' => $user->id,
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
}
