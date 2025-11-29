<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class AddressController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)
                            ->with(['country', 'state', 'city'])
                            ->get();

        return view('profile.address', compact('user', 'addresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_title' => 'required|string|max:255',
            'first_name'    => 'nullable|string|max:255',
            'last_name'     => 'nullable|string|max:255',
            'phone'         => 'nullable|string|max:255',
            'address'       => 'nullable|string|max:255',
            'country_id'    => 'required|exists:countries,id',
            'state_id'      => 'nullable|exists:states,id',
            'city_id'       => 'required|exists:cities,id',
            'zip_code'      => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        Address::create([
            'user_id'       => $user->id,
            'address_title' => $request->address_title,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'country_id'    => $request->country_id ?? 1,
            'state_id'      => $request->state_id ?? 1,
            'city_id'       => $request->city_id ?? 1,
            'zip_code'      => $request->zip_code,
        ]);

        return back()->with('success', 'Address added!');
    }

    public function update(Request $request, Address $address)
    {
        $request->validate([
            'address_title' => 'required|string|max:255',
            'first_name'    => 'nullable|string|max:255',
            'last_name'     => 'nullable|string|max:255',
            'phone'         => 'nullable|string|max:255',
            'address'       => 'nullable|string|max:255',
            'country_id'    => 'required|exists:countries,id',
            'state_id'      => 'nullable|exists:states,id',
            'city_id'       => 'required|exists:cities,id',
            'zip_code'      => 'nullable|string|max:255',
        ]);

        $address->update([
            'address_title' => $request->address_title,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'country_id'    => $request->country_id,
            'state_id'      => $request->state_id,
            'city_id'       => $request->city_id,
            'zip_code'      => $request->zip_code,
        ]);

        return back()->with('success', 'Address updated!');
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return back()->with('success', 'Address deleted!');
    }
}
