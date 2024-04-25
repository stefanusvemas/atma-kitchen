<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\user_credential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $karyawan = Karyawan::all(); 

            return response()->json([
                'data' => $karyawan,
                'status' => true,
                'message' => 'Berhasil ambil data'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'nama' => 'required',
            'tanggal_bergabung' => 'required|date',
            'gaji' => 'required|numeric',
            'bonus' => 'required|numeric',
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);
        // Membuat entri baru dalam database tabel karyawan dengan data yang divalidasi
        $karyawan = Karyawan::create($validatedData);

        $atribut = [
            'id_karyawan' => $karyawan['id_karyawan'],
            'email' => $request['email'] , 
            'password' => Hash::make($request['password']),
        ];

        $karyawan = user_credential::create($atribut);
        // Memberikan respons dalam bentuk JSON
        return response([
            'message' => 'Register Success',
            'customer' => $karyawan,
        ], 200);
  
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
