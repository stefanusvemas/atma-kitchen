<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Mail\ForgetPwMailSend;
use App\Models\Customer;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user_credential;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\MailSend;
use Illuminate\Support\Facades\Mail;

class SessionController extends Controller
{

    public function login(Request $request)
    {

        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Proses login gagal',
                'data' => $validator->errors()
            ], 401);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'message' => 'Email dan password yang dimasukkan tidak sesuai'
            ], 401);
        }

        $user = Auth::user();
        if (!$user->active) {
            Auth::logout();
            return response()->json(['error' => 'Akun Anda belum diverifikasi. Silahkan cek email Anda'], 401);
        }

        $datauser = user_credential::where('email', $request->email)->first(); // mendapatkan data customer
        if ($datauser['id_customer'] == null) {
            $jabatan = Karyawan::where('id_karyawan', $datauser['id_karyawan'])->first()->load('jabatan');
            $role = 'karyawan';
            return response()->json([
                'status' => true,
                'message' => 'Berhasil proses login',
                'token' => $datauser->createToken('api-product')->plainTextToken,
                'role' => $role,
                'user' => $user,
                'detail user' => $user,
                'jabatan' => $jabatan
            ]);
        } else {
            $role = 'customer';
        }

        // return response()->json([
        //     'role' => $role,
        // ]);


        // if ($role = 'karyawan') {
        //     $user = Karyawan::where('id_karyawan', $user->id_karyawan)->first();// Dapatkan data pelanggan yang sesuai dengan pengguna
        // }else{
        //     $user = Customer::where('id_customer', $user->id_customer)->first();// Dapatkan data pelanggan yang sesuai dengan pengguna
        // }




        return response()->json([
            'status' => true,
            'message' => 'Berhasil proses login',
            'token' => $datauser->createToken('api-product')->plainTextToken,
            'role' => $role,
            'user' => $user,
            'detail user' => $user,
        ]);
    }


    public function forgetPassword(Request $request)
    {
        $pass = Str::random(100);

        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;

        $user_credential = user_credential::where('email', $email)->first();

        if (!$user_credential) {
            return response()->json([
                'message' => 'Email tidak ditemukan dalam database',
                'data' => null
            ], 404);
        }

        $atribut = [
            'pass_key' => $pass,
        ];

        $user_credential->update($atribut);

        if ($user_credential['pass_key'] == null) {
            return response()->json([
                'message' => 'PASS_KEY = NULL',
                'pass_key' => $pass
            ]);
        }

        $details = [
            'nama' => $request->nama,
            'website' => 'Atma Kitchen',
            'url' => 'http://127.0.0.1:8000/' . '/customer/verifyForgetPw/' . $pass
        ];
        Mail::to($request->email)->send(new ForgetPwMailSend($details));



        return response()->json([
            'message' => 'Berhasil',
            'data' => $user_credential
        ]);
    }

    public function verifyForgetPw($pass_key, Request $request)
    {
        $keyCheck = user_credential::select('pass_key')
            ->where('pass_key', $pass_key)
            ->exists();

        if ($keyCheck) {
            $atribut = [
                'password' => Hash::make($request['password']),
                'pass_key' => null
            ];

            $user = user_credential::where('pass_key', $pass_key)
                ->update($atribut);

            return response()->json([
                'message' => 'Verifikasi Passwrd Baru Berhasil'
            ]);
        } else {
            return response()->json([
                'message' => 'Keys Tidak Valid.'
            ], 404);
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function logout(Request $request)
    {
        //
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json([
            'message' => 'berhasil Logout',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
