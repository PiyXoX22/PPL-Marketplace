<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Trx;
use App\Models\TrxDetail;
use App\Models\Cart;
use App\Models\Produk;
use App\Models\Address;

class CheckoutController extends Controller
{
    // Tampilkan checkout
    public function index($id = null)
    {
        $user = Auth::user();

        // Jika single produk
        if ($id) {
            $produk = Produk::with(['harga','gambar'])->find($id);
            if ($produk) {
                $addresses = $user->addresses;
                $selectedAddress = $addresses->where('is_default',1)->first() ?? $addresses->first();
                return view('checkout.index', compact('produk','addresses','selectedAddress'));
            }
        }

        // Jika cart
        $cartItems = Cart::with('product.harga','product.gambar')->where('user_id',$user->id)->get();
        if ($cartItems->isEmpty()) return redirect()->route('cart.index')->with('error','Keranjang kosong!');

        $subtotal = $cartItems->sum(fn($item)=>($item->product->harga->harga ?? 0)*$item->quantity);
        $addresses = $user->addresses;
        $selectedAddress = $addresses->where('is_default',1)->first() ?? $addresses->first();

        return view('checkout.cart', compact('cartItems','subtotal','addresses','selectedAddress'));
    }

    // Hitung ongkir
    public function cekOngkir(Request $request)
    {
        $request->validate(['courier'=>'required|string']);
        $user = Auth::user();
        $address = Address::where('user_id',$user->id)->first();
        if(!$address) return response()->json(['success'=>false,'message'=>'Alamat tidak ditemukan']);

        $cartItems = Cart::with('product')->where('user_id',$user->id)->get();
        $totalGram = $cartItems->sum(fn($item)=>((int)preg_replace('/[^0-9]/','',$item->product->berat ?? '0'))*$item->quantity);
        $kg = max(1,ceil($totalGram/1000));

        $ongkirTable = ['jne'=>10000,'pos'=>8000,'jnt'=>11000,'sicepat'=>9000,'gosend'=>15000];
        if(!isset($ongkirTable[$request->courier])) return response()->json(['success'=>false,'message'=>'Kurir tidak valid']);

        $totalOngkir = $ongkirTable[$request->courier] * $kg;
        return response()->json(['success'=>true,'data'=>['courier'=>strtoupper($request->courier),'kg'=>$kg,'total_ongkir'=>$totalOngkir]]);
    }

    // Proses checkout / bayar
   public function pay(Request $request)
{
    $request->validate([
        'courier'       => 'required',
        'ongkir'        => 'required|numeric',
        'subtotal'      => 'required|numeric',
        'grand_total'   => 'required|numeric',
        'payment_method'=> 'required|string'
    ]);

    DB::beginTransaction();
    try {

        // ID unik kapital: TRX241208xxxxxx
        $trxId = 'TRX'.date('ymdHis').rand(10000,99999);

        $trx = Trx::create([
            'id'            => $trxId,
            'tanggal'       => now(),
            'total'         => $request->subtotal,
            'paid'          => 0,
            'payment_method'=> $request->payment_method,
            'grand_total'   => $request->grand_total
        ]);

        $cartItems = Cart::with('product.harga')
            ->where('user_id', Auth::id())
            ->get();

        foreach ($cartItems as $item) {
            TrxDetail::create([
                'trx_id'        => $trx->id,
                'id_barang'     => $item->product_id,
                'qty'           => $item->quantity,
                'harga_satuan'  => $item->product->harga->harga ?? 0,
                'subtotal'      => ($item->product->harga->harga ?? 0) * $item->quantity
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

DB::commit();
return redirect()->route('checkout.viewPay', $trx->id);


    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
    }
    
}
public function viewPay($id)
{
    $trx = Trx::findOrFail($id);

    return view('checkout.pay', compact('trx'));
}
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

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    return response()->json([
        'success' => true,
        'snap_token' => $snapToken
    ]);
}
public function paymentSuccess(Request $request)
{
    $trx = Trx::findOrFail($request->order_id);
    return view('checkout.success', compact('trx'));
}

public function paymentPending(Request $request)
{
    $trx = Trx::findOrFail($request->order_id);
    return view('checkout.pending', compact('trx'));
}

public function paymentFailed(Request $request)
{
    return view('checkout.failed');
}




}
