<?php

namespace App\Http\Controllers; // ❌ Jangan pakai Admin

use Illuminate\Http\Request;
use App\Models\Trx;
use App\Models\TrxDetail;

class TrxAdminController extends Controller
{
    public function index()
    {
        $trx = Trx::with('detail')->orderBy('tanggal', 'desc')->paginate(10);
        return view('orders.index', compact('trx'));
    }


    public function show($id)
    {
        $trx = Trx::with('detail')->findOrFail($id);
        return view('orders.show', compact('trx'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:trx,id',
            'tanggal' => 'required|date',
            'total' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'payment_method' => 'required|string',
            'status' => 'required|string',
        ]);

        Trx::create($request->all());
        return redirect()->route('admin.orders.index')->with('success','Transaksi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $trx = Trx::findOrFail($id);
        $statuses = ['pending','terbayar','dikemas','dalam_pengantaran','gagal','cancel'];
        return view('orders.edit', compact('trx','statuses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['status'=>'required|string']);
        $trx = Trx::findOrFail($id);
        $trx->status = $request->status;
        $trx->save();

        return redirect()->route('admin.orders.index')->with('success','Status transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Trx::findOrFail($id)->delete();
        return redirect()->route('admin.orders.index')->with('success','Transaksi berhasil dihapus!');
    }
}
