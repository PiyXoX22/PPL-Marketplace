<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
