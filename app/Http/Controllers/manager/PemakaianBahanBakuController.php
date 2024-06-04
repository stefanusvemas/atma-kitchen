<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PemakaianBahanBaku;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;

class PemakaianBahanBakuController extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $data = PemakaianBahanBaku::with('bahan_baku')->get()->sortByDesc('tgl_pemakaian');
        // return $data;

        return view('manager.pemakaian_bahan_baku', compact('user_data', 'data'));
    }
}
