<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EditProfileController extends Controller
{
    public function index()
    {
        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first()->load('user_credential');
        return view('user.edit_profile', compact('user_data'));
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
