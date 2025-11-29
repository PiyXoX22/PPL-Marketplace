<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class PaymentController extends Controller
{
    public function generateSnapToken(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Parameter transaksi
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . time(),
                'gross_amount' => $request->amount,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email'      => $request->email,
            ],
        ];

        // Generate SNAP TOKEN
        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snapToken' => $snapToken
        ]);
    }

    // CALLBACK MIDTRANS
    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if ($hashed === $request->signature_key) {
            // Update status transaksi ke DB
            // contoh:
            // Transaction::where('order_id', $request->order_id)->update(['status' => $request->transaction_status]);

            return response()->json(['message' => 'Callback processed']);
        }

        return response()->json(['message' => 'Invalid signature'], 401);
    }
}
