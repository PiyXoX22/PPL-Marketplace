<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    // List semua kupon (admin)
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    // Form create kupon
    public function create()
    {
        return view('admin.coupons.create');
    }

    // Simpan kupon baru
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_purchase' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Coupon::create($request->all());
        return redirect()->route('admin.coupons.index')->with('success', 'Kupon berhasil dibuat.');
    }

    // Validasi kupon di checkout (user)
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'cart_total' => 'required|numeric',
        ]);

        $coupon = Coupon::where('code', $request->code)
                        ->where('status', 1)
                        ->whereDate('start_date', '<=', Carbon::today())
                        ->whereDate('end_date', '>=', Carbon::today())
                        ->first();

        if(!$coupon){
            return response()->json(['success' => false, 'message' => 'Kupon tidak valid atau sudah kadaluarsa.']);
        }

        if($request->cart_total < $coupon->min_purchase){
            return response()->json(['success' => false, 'message' => 'Belanja minimal ' . number_format($coupon->min_purchase) . ' untuk kupon ini.']);
        }

        // Hitung diskon
        $discount = $coupon->type == 'percentage'
                    ? ($request->cart_total * $coupon->value / 100)
                    : $coupon->value;

        return response()->json([
            'success' => true,
            'discount' => $discount,
            'new_total' => $request->cart_total - $discount,
            'message' => 'Kupon berhasil diterapkan!'
        ]);
    }
}
