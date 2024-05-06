<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::where('tanggal', date('Y-m-d'))->get()->load('karyawan');
        return response()->json([
            'message' => 'success',
            'data' => $absensi,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
        ]);

        Absensi::create([
            'id_karyawan' => $request->id_karyawan,
            'tanggal' => date('Y-m-d'),
        ]);

        return response()->json([
            'message' => 'success',
        ]);
    }
}
