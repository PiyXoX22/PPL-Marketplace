<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CouponController extends Controller
{
    // ================= ADMIN =================
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('coupon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'            => 'required|unique:coupons,code',
            'type'            => 'required|in:percent,fixed',
            'value'           => 'required|integer',
            'expired_at'      => 'required|date',
            'min_transaction' => 'nullable|integer',
            'max_discount'    => 'nullable|integer',
            'is_active'       => 'required|boolean',
        ]);

        Coupon::create($request->all());

        return redirect()->route('admin.coupon.index')
            ->with('success', 'Kupon berhasil ditambahkan');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update($request->all());

        return redirect()->route('admin.coupon.index')
            ->with('success', 'Kupon berhasil diupdate');
    }

    public function destroy($id)
    {
        Coupon::destroy($id);
        return back()->with('success', 'Kupon berhasil dihapus');
    }

    // ================= USER APPLY =================
    public function apply(Request $request)
    {
        $request->validate(['code'=>'required']);

        $coupon = Coupon::where('code',$request->code)
            ->where('is_active',1)
            ->whereDate('expired_at','>=',Carbon::now())
            ->first();

        if(!$coupon){
            return back()->with('error','Kupon tidak valid / expired');
        }

        $cartItems = Cart::with('product.harga')
            ->where('user_id',auth()->id())
            ->get();

        $subtotal = $cartItems->sum(fn($i)=>
            ($i->product->harga->harga ?? 0) * $i->quantity
        );

        if($coupon->min_transaction && $subtotal < $coupon->min_transaction){
            return back()->with(
                'error',
                'Minimal transaksi Rp '.number_format($coupon->min_transaction)
            );
        }

        if($coupon->type === 'percent'){
            $discount = ($coupon->value/100) * $subtotal;
            if($coupon->max_discount && $discount > $coupon->max_discount){
                $discount = $coupon->max_discount;
            }
        } else {
            $discount = $coupon->value;
        }

        Session::put('coupon',[
            'code'=>$coupon->code,
            'discount'=>$discount
        ]);

        return back()->with('success','Kupon berhasil digunakan');
    }
}
