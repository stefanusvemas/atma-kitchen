<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\Karyawan;
use App\Models\Produk;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResepController extends Controller
{
    //
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $produk = Produk::with('resep.bahanBaku')->get();
        // return ($resep);
        return view('admin.resep', compact('user_data', 'produk'));
    }

    public function edit($id)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $resep = Resep::where('id_resep', $id)->first();
        // return ($resep);
        return view('admin.edit_resep', compact('user_data', 'resep'));
    }
}
