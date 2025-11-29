<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    // ========================================
    // TAMPILKAN FORM OTP
    // ========================================
    public function form()
    {
        return view('otp.form');
    }

    // ========================================
    // REQUEST OTP
    // ========================================
    public function requestOtp(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string|max:20'
        ]);

        $nomor = $request->nomor;

        // Hapus OTP lama
        Otp::where('nomor', $nomor)->delete();

        // Generate OTP 6 digit
        $kodeOtp = rand(100000, 999999);
        $waktu = time();

        // Simpan ke DB
        Otp::create([
            'nomor' => $nomor,
            'otp'   => $kodeOtp,
            'waktu' => $waktu,
        ]);

        // Kirim via FONNTE
        $curl = curl_init();
        $data = [
            'target'  => $nomor,
            'message' => "Your OTP : " . $kodeOtp
        ];

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.fonnte.com/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => [
                "Authorization: U71oLnGgmn1rtDBVxFKM" // GANTI TOKEN MU
            ],
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ]);

        curl_exec($curl);
        curl_close($curl);

        return redirect()->back()->with([
            'success' => 'OTP telah dikirim!',
            'nomor' => $nomor
        ]);
    }

    // ========================================
    // VALIDASI OTP
    // ========================================
    public function login(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string',
            'otp'   => 'required|integer'
        ]);

        $data = Otp::where('nomor', $request->nomor)
                    ->where('otp', $request->otp)
                    ->first();

        if (!$data) {
            return back()->with('error', 'OTP salah!');
        }

        // Check expiry (300 detik = 5 menit)
        if (time() - $data->waktu > 300) {
            return back()->with('error', 'OTP expired!');
        }

        return redirect()->route('home')->with('success', 'OTP benar, login berhasil!');
    }
}
