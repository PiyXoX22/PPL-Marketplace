<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->start;
        $end   = $request->end;

        /*
        |--------------------------------------------------------------------------
        | CARD DATA (TANPA FILTER TANGGAL)
        |--------------------------------------------------------------------------
        */
        $totalProduk   = DB::table('produk')->count();
        $totalUser     = DB::table('login')->count();
        $totalKategori = DB::table('kategori')
                            ->distinct('kategori')
                            ->count();

        // TOTAL PENJUALAN GLOBAL (TIDAK TERPENGARUH FILTER)
        $totalPenjualan = DB::table('trx')->count();

        /*
        |--------------------------------------------------------------------------
        | DATA GRAFIK (PAKAI FILTER TANGGAL)
        |--------------------------------------------------------------------------
        */
        $sales = DB::table('trx')
            ->select(
                DB::raw('DATE(tanggal) as tanggal'),
                DB::raw('COUNT(*) as total') // jumlah transaksi per hari
                // kalau mau jumlah pembeli:
                // DB::raw('COUNT(DISTINCT user_id) as total')
            )
            ->when($start && $end, function ($q) use ($start, $end) {
                $q->whereBetween('tanggal', [$start, $end]);
            })
            ->groupBy(DB::raw('DATE(tanggal)'))
            ->orderBy(DB::raw('DATE(tanggal)'), 'asc')
            ->get();

        $labels     = $sales->pluck('tanggal');
        $salesData = $sales->pluck('total');

        return view('home', compact(
            'totalProduk',
            'totalUser',
            'totalKategori',
            'totalPenjualan',
            'labels',
            'salesData'
        ));
    }
}
