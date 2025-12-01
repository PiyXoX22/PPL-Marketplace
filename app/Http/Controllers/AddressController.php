<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Menampilkan daftar alamat + dropdown provinsi
     */
    public function index()
    {
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->get();

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),
        ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');

        $provinces = $response->successful() ? ($response->json()['data'] ?? []) : [];

        return view('profile.address', compact('user', 'addresses', 'provinces'));
    }

    /**
     * Menampilkan form edit alamat
     */
    public function edit($id)
    {
        $address = Address::findOrFail($id);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),
        ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');

        $provinces = $response->successful() ? ($response->json()['data'] ?? []) : [];

        return view('profile.address-edit', compact('address', 'provinces'));
    }

    /**
     * Menyimpan alamat baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name'     => 'required|string|max:100',
            'phone'         => 'required|string|max:20',
            'province'      => 'required|string|max:100',
            'city'          => 'required|string|max:100',
            'district'      => 'required|string|max:100',
            'postal_code'   => 'required|string|max:10',
            'address_line'  => 'required|string',
            'additional_info' => 'nullable|string',
        ]);

        Address::create([
            'user_id'       => Auth::id(),
            'full_name'     => $request->full_name,
            'phone'         => $request->phone,
            'province'      => $request->province,
            'city'          => $request->city,
            'district'      => $request->district,
            'postal_code'   => $request->postal_code,
            'address_line'  => $request->address_line,
            'additional_info' => $request->additional_info ?? '',
            'is_default'    => 0,
        ]);

        return redirect()->route('profile.address.index')->with('success', 'Alamat berhasil ditambahkan!');
    }

    /**
     * Update alamat yang sudah ada
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name'     => 'required|string|max:100',
            'phone'         => 'required|string|max:20',
            'province'      => 'required|string|max:100',
            'city'          => 'required|string|max:100',
            'district'      => 'required|string|max:100',
            'postal_code'   => 'required|string|max:10',
            'address_line'  => 'required|string',
            'additional_info' => 'nullable|string',
        ]);

        $address = Address::findOrFail($id);

        $address->update([
            'full_name'     => $request->full_name,
            'phone'         => $request->phone,
            'province'      => $request->province,
            'city'          => $request->city,
            'district'      => $request->district,
            'postal_code'   => $request->postal_code,
            'address_line'  => $request->address_line,
            'additional_info' => $request->additional_info ?? '',
        ]);

        return redirect()->route('profile.address.index')->with('success', 'Alamat berhasil diperbarui!');
    }

    /**
     * Menghapus alamat
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return redirect()->route('profile.address.index')->with('success', 'Alamat berhasil dihapus!');
    }
}
