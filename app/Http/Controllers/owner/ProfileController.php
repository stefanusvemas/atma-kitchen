<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use App\Models\user_credential;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {

        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $credential = user_credential::where('id_karyawan', Auth::user()->id_karyawan)->first();
        // return $credential;
        return view('owner.profile', compact('user_data', 'credential'));
    }

    public function edit(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email:rfc',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            Session::flash('error', $validate->errors());
            return back();
        }

        $request = $request->all();
        $data = [
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ];

        user_credential::where('id_karyawan', Auth::user()->id_karyawan)->update($data);

        Session::flash('success', 'email/password berhasil diubah');
        return redirect('/owner/profile');
    }
}
