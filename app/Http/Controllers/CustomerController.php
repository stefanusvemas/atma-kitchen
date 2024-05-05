<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Mail\MailSend;
use App\Models\Customer;
use App\Models\user_credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register()
    {
        return view('register');
    }

    public function registerAction(Request $request)
    {
        $request = $request->all();
        $str = Str::random(100);
        $request['jumlah_poin'] = 0;

        $validate = Validator::make($request, [
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'jumlah_poin' => 'required|integer',
            'no_telp' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email|unique:user_credentials,email',
            'password' => 'required|string|min:6'
        ]);

        if ($validate->fails()) {
            Session::flash('error', $validate->errors());
            return back();
        }

        $customer = Customer::create($request); // menyimpan data di tabel customer
        $atribut = [
            'id_customer' => $customer['id_customer'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'verify_key' => $str,
        ];

        $customer = user_credential::create($atribut); // membuat baru di tabel user_credential

        // kirim email
        $details = [
            'nama' => $request['nama'],
            'website' => 'Atma Kitchen',
            'datetime' => date('Y-m-d H:i:s'),
            'url' => request()->getHttpHost() . '/register/verify/' . $str
        ];
        Mail::to($request['email'])->send(new MailSend($details)); //new MailSend($details)

        return redirect('/login')->with('success', 'Register Success');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);
        $validatedData = $request->validate([ // validasi input
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'no_telp' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        $customer->update($validatedData);
        $atribut = [
            'id_customer' => $customer['id_customer'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ];


        $user_credential = user_credential::where('id_customer', $id)->first();

        $user_credential->update($atribut);

        return redirect('');
    }


    public function verify($verify_key)
    {
        $keyCheck = user_credential::select('verify_key')
            ->where('verify_key', $verify_key)
            ->exists();

        if ($keyCheck) {
            $user = user_credential::where('verify_key', $verify_key)
                ->update([
                    'active' => 1,
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'verify_key' => null
                ]);

            return view('verify');
        } else {
            abort(404);
        }
    }
}
