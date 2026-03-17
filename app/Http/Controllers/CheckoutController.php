<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Trx;
use App\Models\TrxDetail;
use App\Models\Cart;
use App\Models\Produk;
use App\Models\Address;

class CheckoutController extends Controller
{
    // ===============================
    // TAMPILKAN CHECKOUT
    // ===============================
    public function index($id = null)
    {
        $user = Auth::user();

        // Single produk
        if ($id) {
            $produk = Produk::with(['harga','gambar'])->find($id);

            if ($produk) {

                $subtotal = $produk->harga->harga ?? 0;
                $discount = 0;
                $total = $subtotal;

                $addresses = $user->addresses;

                // ambil address_id dari dropdown
                if (request('address_id')) {

                    $selectedAddress = $addresses
                        ->where('id', request('address_id'))
                        ->first();

                } else {

                    $selectedAddress = $addresses->where('is_default',1)->first()
                        ?? $addresses->first();

                }

                return view('checkout.index', compact(
                    'produk',
                    'subtotal',
                    'discount',
                    'total',
                    'addresses',
                    'selectedAddress'
                ));
            }
        }

        // Dari cart
        $cartItems = Cart::with('product.harga','product.gambar')
            ->where('user_id',$user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error','Keranjang kosong!');
        }

        $subtotal = $cartItems->sum(fn($item) =>
            ($item->product->harga->harga ?? 0) * $item->quantity
        );

        $discount = session('coupon.discount', 0);
        $discount = min($discount, $subtotal);
        $total = $subtotal - $discount;

        $addresses = $user->addresses;

// 🔑 AMBIL address_id DARI REQUEST
if (request('address_id')) {
    $selectedAddress = $addresses
        ->where('id', request('address_id'))
        ->first();
} else {
    // fallback ke default
    $selectedAddress = $addresses->where('is_default', 1)->first()
        ?? $addresses->first();
}


        return view('checkout.cart', compact(
            'cartItems',
            'subtotal',
            'discount',
            'total',
            'addresses',
            'selectedAddress'
        ));
    }

    // ===============================
    // CEK ONGKIR
    // ===============================
    public function cekOngkir(Request $request)
    {
        $request->validate([
            'courier' => 'required',
            'address_id' => 'required'
        ]);

        $address = Address::where('id', $request->address_id)
            ->where('user_id', Auth::id())
            ->first();

        if(!$address){
            return response()->json([
                'success'=>false,
                'message'=>'Alamat tidak ditemukan'
            ]);
        }

        $origin = 419;
        $destination = $address->city_id;

        /*
        ==========================
        CEK BERAT
        ==========================
        */

        if($request->has('weight')){

            // checkout cart
            $weight = (int) $request->weight;

        }elseif($request->has('product_id')){

            // checkout produk
            $produk = Produk::findOrFail($request->product_id);

            $weight = (int) filter_var($produk->berat, FILTER_SANITIZE_NUMBER_INT);

        }else{

            return response()->json([
                'success'=>false,
                'message'=>'Berat produk tidak ditemukan'
            ]);

        }

        /*
        ==========================
        RAJAONGKIR API
        ==========================
        */

        $response = Http::asForm()->withHeaders([
            'Accept' => 'application/json',
            'key' => env('RAJAONGKIR_KEY')
        ])->post(
            'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost',
            [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $request->courier,
                'price' => 'lowest'
            ]
        );

        if(!$response->successful()){
            return response()->json([
                'success'=>false,
                'message'=>'API RajaOngkir gagal'
            ]);
        }

        $data = $response->json();

        if(!isset($data['data'][0]['cost'])){
            return response()->json([
                'success'=>false,
                'message'=>'Ongkir tidak tersedia'
            ]);
        }

        $ongkir = $data['data'][0]['cost'];

        return response()->json([
            'success'=>true,
            'data'=>[
                'total_ongkir'=>$ongkir
            ]
        ]);
    }
    // ===============================
    // PROSES BAYAR (SIMPAN TRX)
    // ===============================
    public function pay(Request $request)
    {
        $request->validate([
            'address_id'     => 'required|exists:login2_addresses,id',
            'courier'        => 'required',
            'ongkir'         => 'required|numeric',
            'subtotal'       => 'required|numeric',
            'discount'       => 'nullable|numeric',
            'grand_total'    => 'required|numeric',
            'payment_method' => 'required|string'
        ]);

        DB::beginTransaction();

        try {

            $trxId = 'TRX'.date('ymdHis').rand(10000,99999);

            $trx = Trx::create([
                'id'             => $trxId,
                'user_id'        => Auth::id(),
                'address_id'     => $request->address_id,
                'tanggal'        => now(),
                'total'          => $request->subtotal,
                'discount'       => $request->discount ?? 0,
                'ongkir'         => $request->ongkir,
                'paid'           => 0,
                'payment_method' => $request->payment_method,
                'grand_total'    => $request->grand_total,
                'status'         => 'pending'
            ]);

            $cartItems = Cart::with('product.harga')
                ->where('user_id', Auth::id())
                ->get();

            foreach ($cartItems as $item) {

                TrxDetail::create([
                    'trx_id'       => $trx->id,
                    'id_barang'    => $item->product_id,
                    'qty'          => $item->quantity,
                    'harga_satuan' => $item->product->harga->harga ?? 0,
                    'subtotal'     => ($item->product->harga->harga ?? 0) * $item->quantity
                ]);

            }

            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('checkout.viewPay', $trx->id);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error','Terjadi kesalahan: '.$e->getMessage());

        }
    }

    // ===============================
    // HALAMAN BAYAR
    // ===============================
    public function viewPay($id)
    {
        // 🔐 CEK USER DI SINI (AMAN)
        $trx = Trx::where('id',$id)
            ->where('user_id',Auth::id())
            ->firstOrFail();

        return view('checkout.pay', compact('trx'));
    }

    // ===============================
    // MIDTRANS (JANGAN FILTER user_id)
    // ===============================
    public function midtransCreate(Request $request)
    {
        $trx = Trx::findOrFail($request->trx_id);

        \Midtrans\Config::$serverKey    = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized  = true;
        \Midtrans\Config::$is3ds        = true;

        $params = [
            'transaction_details' => [
                'order_id'     => $trx->id,
                'gross_amount' => $trx->grand_total,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email'      => auth()->user()->email,
            ]
        ];

        return response()->json([
            'success' => true,
            'snap_token' => \Midtrans\Snap::getSnapToken($params)
        ]);
    }

    // ===============================
    // CALLBACK MIDTRANS
    // ===============================
    public function paymentSuccess(Request $request)
    {
        $trx = Trx::where('id',$request->order_id)->firstOrFail();

        if ($trx->paid == 0) {
            $trx->update([
                'paid' => $trx->grand_total,
                'status' => 'paid'
            ]);
        }

        return view('checkout.success', compact('trx'));
    }

    public function paymentPending(Request $request)
    {
        $trx = Trx::where('id',$request->order_id)->firstOrFail();
        return view('checkout.pending', compact('trx'));
    }

    public function paymentFailed()
    {
        return view('checkout.failed');
    }
}
