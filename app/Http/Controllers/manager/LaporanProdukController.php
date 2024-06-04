<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;

class LaporanProdukController extends Controller
{
    public function index()
    {

        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();

        return view('manager.laporan_produk', compact('user_data'));
    }
}
