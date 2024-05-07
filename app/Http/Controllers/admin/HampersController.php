<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DetailHampers;
use App\Models\Hampers;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HampersController extends Controller
{
    //
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $hampers = DetailHampers::with(['produk', 'hampers'])->get()->groupBy('id_hampers');
        // return ($hampers);
        return view('admin.hampers', compact('user_data', 'hampers'));
    }

    // public function create()
    // {
    //     $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
    //     // return ($bahan_baku);
    //     return view('admin.hampers', compact('user_data'));
    // }

    public function destroy($id)
    {

        // $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $hampers = Hampers::where('id_hampers', $id)->first();

        $hampers->delete();

        return redirect('admin/hampers')->with('success', 'Berhasil hapus data');
    }

    public function search(Request $request)
    {
        $search = $request->query('search');
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $hampers = Hampers::where('nama', 'like', "%$search%")->get();
        // return ($search);
        return view('admin.hampers', compact('user_data', 'hampers'));
    }
}
