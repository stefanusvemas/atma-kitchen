<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use App\Models\BahanBaku;

class BahanBakuController extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $bahan_baku = BahanBaku::all();
        return view('manager.bahan_baku', compact('user_data', 'bahan_baku'));
    }

    public function search(Request $request)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $bahan_baku = BahanBaku::where('nama', 'like', '%' . $request->search . '%')->get();
        return view('manager.bahan_baku', compact('user_data', 'bahan_baku'));
    }
}
