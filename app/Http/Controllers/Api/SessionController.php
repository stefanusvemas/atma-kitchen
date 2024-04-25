<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user_credential;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    public function login(Request $request)
{
        $role = 'customer';
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
                // Jika autentikasi gagal, kembalikan pesan kesalahan
                return response()->json([
                'status' => false,
                'message' => 'Email dan password yang dimasukkan tidak sesuai'
            ], 401);
        }

        $datauser= user_credential::where('email', $request->email)->first(); // mendapatkan data customer
        if ($datauser['id_customer']==null){
            $role = 'karyawan';
        }
        
        $detail_user = Auth::user();// Jika autentikasi berhasil, dapatkan data pengguna
        
        if ($role = 'karyawan') {
            # code...
            $user = Karyawan::where('id_karyawan', $detail_user->id_karyawan)->first();// Dapatkan data pelanggan yang sesuai dengan pengguna
        }else{
            $user = Customer::where('id_customer', $detail_user->id_customer)->first();// Dapatkan data pelanggan yang sesuai dengan pengguna
        }
        return response()->json([
        'status' => true, 
        'message' => 'Berhasil proses login',
        'token' => $datauser->createToken('api-product')->plainTextToken,
        'role' => $role,
        'user' => $user,
        'detail user' => $detail_user,
       
    ]);
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
