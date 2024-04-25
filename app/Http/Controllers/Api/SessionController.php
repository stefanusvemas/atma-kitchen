<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user_credential;
use Illuminate\Support\Facades\Validator;

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
                    // Jika autentikasi gagal, kembalikan pesan kesalahan
                return response()->json([
                'status' => false,
                'message' => 'Email dan password yang dimasukkan tidak sesuai'
            ], 401);
        }
        $datauser= user_credential::where('email', $request->email)->first();

         
        return response()->json([
        'status' => true, 
        'message' => 'Berhasil proses login',
        'token' => $datauser->createToken('api-product')->plainTextToken,
        'user' => $datauser,
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
    public function store(Request $request)
    {
        //
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
