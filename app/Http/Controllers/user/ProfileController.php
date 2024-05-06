<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function index()
    {
        // $user_data = Customer::where('id_customer', Auth::user()['id_customer'])->first();

        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first()->load('user_credential');
        $credential = $user_data->user_credential;
        // return $user_data;

        return view('user.profile', compact('user_data'));
    }

    public function editAction(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email:rfc',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $data = [
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ];

        $user_data = Customer::where('id_customer', Auth::user()->id_customer)->first();
        $user_data->user_credential->update($data);

        session()->flash('success', 'email/password berhasil diubah');

        return redirect('/user/profile');
    }
}
