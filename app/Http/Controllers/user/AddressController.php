<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AddressController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id_customer;
        $user_data = Customer::where('id_customer', $user_id)->first();
        $addresses = Address::where('id_customer', $user_id)->get();
        return view('user.address_list', compact('user_data', 'addresses'));
    }

    public function create()
    {
        $user_id = Auth::user()->id_customer;
        $user_data = Customer::where('id_customer', $user_id)->first();
        return view('user.address_input', compact('user_data'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id_customer;

        $validate = Validator::make($request->all(), [
            'nama_jalan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        Address::create([
            'id_customer' => $user_id,
            'nama_jalan' => $request->input('nama_jalan'),
            'kecamatan' => $request->input('kecamatan'),
            'kelurahan' => $request->input('kelurahan'),
            'jarak' => 0, // Default value for jarak
        ]);

        return redirect('/user/address')->with('success', 'Address successfully added');
    }

    public function edit($id)
    {
        $address = Address::findOrFail($id);
        $user_id = Auth::user()->id_customer;

        if ($address->id_customer != $user_id) {
            return redirect('/user/address')->with('error', 'Unauthorized action');
        }

        $user_data = Customer::where('id_customer', $user_id)->first();

        return view('user.address_edit', compact('address', 'user_data'));
    }

    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        if ($address->id_customer != Auth::user()->id_customer) {
            return redirect('/user/address')->with('error', 'Unauthorized action');
        }

        $validate = Validator::make($request->all(), [
            'nama_jalan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $address->update([
            'nama_jalan' => $request->input('nama_jalan'),
            'kecamatan' => $request->input('kecamatan'),
            'kelurahan' => $request->input('kelurahan'),
        ]);

        return redirect('/user/address')->with('success', 'Address updated successfully');
    }

    public function delete($id)
    {
        $address = Address::where('id_alamat', $id)->first();

        if (!$address) {
            Session::flash('error', 'Address not found');
            return redirect('/user/address');
        }

        $address->delete();

        Session::flash('success', 'Address successfully deleted');

        return redirect('/user/address');
    }
}

