<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Trx;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name'   => 'required',
            'last_name'    => 'required',
            'email'        => 'required|email',
            'phone'        => 'nullable',
            'password'     => 'nullable|min:6|confirmed'
        ]);

        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email      = $request->email;
        $user->phone      = $request->phone;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated!');
    }


    // ORDERS

    public function orders()
    {
        $orders = Trx::where('user_id', Auth::id())
                    ->orderBy('tanggal', 'desc')
                    ->get();

        return view('profile.orders', compact('orders'));
    }

    public function orderDetail($id)
    {
        $trx = Trx::with(['detail.produk'])
                ->where('user_id', Auth::id())
                ->findOrFail($id);

        return view('profile.order-detail', compact('trx'));
    }

    // =========================
    // INVOICE PDF
    // =========================
    public function invoice($id)
    {
        $trx = Trx::with(['detail.produk'])
                ->where('user_id', Auth::id()) // 🔐 keamanan
                ->findOrFail($id);

        $pdf = \PDF::loadView('profile.invoice', compact('trx'))
                    ->setPaper('A4');

        return $pdf->download('Invoice-'.$trx->id.'.pdf');
    }
}
