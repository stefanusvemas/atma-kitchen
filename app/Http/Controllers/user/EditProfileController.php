<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class EditProfileController extends Controller
{
    public function index()
    {
        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first()->load('user_credential');
        $transaksi = Transaksi::where('id_customer', Auth::user()->id_customer)->whereNull('id_pembayaran')->first();

        if ($transaksi == null) {
            $cart_count = 0;
        } else {
            $cart_count = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->sum('jumlah');
        }
        return view('user.edit_profile', compact('user_data', 'cart_count'));
    }

    public function editAction(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'no_telp' => 'required',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $data = [
            'nama' => $request['nama'],
            'tanggal_lahir' => $request['tanggal_lahir'],
            'no_telp' => $request['no_telp'],
        ];

        // return $data;

        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first();
        $user_data->update($data);

        session()->flash('success', 'Data berhasil diubah');

        return redirect('/user/profile');
    }
}
