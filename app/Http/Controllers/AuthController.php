<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ==============================
    // SHOW LOGIN FORM
    // ==============================
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ==============================
    // SHOW REGISTER FORM
    // ==============================
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // ==============================
    // REGISTER USER
    // ==============================
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:30',
            'last_name'  => 'required|string|max:30',
            'username'   => 'required|string|max:30|unique:login,username',
            'email'      => 'required|email|unique:login,email',
            'phone'      => 'required|string|max:12',
            'password'   => 'required|string|min:8|confirmed',
        ]);

        // Insert ke tabel login melalui Model User
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'username'   => $request->username,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password'   => Hash::make($request->password),
            'role_id'    => 3, // Default role user
        ]);

        // Login otomatis
        Auth::login($user);

        return redirect()->route('otp.form')->with('success', 'Akun berhasil dibuat!');
    }

    // ==============================
    // LOGIN USER
    // ==============================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
            // 'g-recaptcha-response' => 'required|captcha',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // CEK ROLE
            if (Auth::user()->role_id == 1) {
                return redirect()->route('admin.dashboard'); // Admin -> dashboard
            }

            return redirect()->route('home'); // User biasa -> home
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    // ==============================
    // LOGOUT USER
    // ==============================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
