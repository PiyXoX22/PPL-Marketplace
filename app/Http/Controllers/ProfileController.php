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
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->email        = $request->email;
        $user->phone        = $request->phone;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated!');
    }
    // =========================
    // ORDERS SECTION
    // =========================
    public function orders()
{
    // Ambil transaksi milik user yang login saja
    $orders = Trx::where('user_id', Auth::id())
                ->orderBy('tanggal', 'desc')
                ->get();

    return view('profile.orders', compact('orders'));
}

public function orderDetail($id)
{
    // Ambil detail transaksi milik user login
    $trx = Trx::with('detail')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

<<<<<<< HEAD
    return view('profile.order-detail', compact('trx'));
}
=======
        return view('profile.order-detail', compact('trx'));
    }
    public function invoice($id)
    {
        $trx = Trx::with(['detail.produk'])->findOrFail($id);
<<<<<<< Updated upstream
=======
>>>>>>> 3f0a34207af4cd1888f99c637c712dfaf9ea64cd
>>>>>>> Stashed changes

public function invoice($id)
{
    // Invoice hanya boleh diakses oleh pemilik transaksi
    $trx = Trx::with('detail')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

    $pdf = \PDF::loadView('profile.invoice', compact('trx'))
                ->setPaper('A4');

    return $pdf->download('Invoice-'.$trx->id.'.pdf');
}





}
