<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BahanBakuController extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $bahan_baku = BahanBaku::all();
        // return ($bahan_baku);
        return view('admin.bahan_baku', compact('user_data', 'bahan_baku'));
    }

    public function create()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        // return ($bahan_baku);
        return view('admin.tambah_bahan_baku', compact('user_data'));
    }

    public function createAction(Request $request)
    {
        $data = $request->all();
        $validatedData = validator::make($data, [ // validasi input
            'nama' => 'required',
            'stok' => 'required',
            'harga' => 'required'
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData);
        }

        BahanBaku::create($data);
        // return ($bahan_baku);
        return redirect('admin/bahan_baku')->with('success', 'Berhasil Tambah data');
    }

    public function search(Request $request)
    {
        $search = $request->query('search');
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $bahan_baku = BahanBaku::where('nama', 'like', "%$search%")->get();
        // return ($search);
        return view('admin.bahan_baku', compact('user_data', 'bahan_baku'));
    }

    public function edit($id)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $bahan_baku = BahanBaku::where('id_bahan_baku', $id)->first();
        // return ($bahan_baku);
        return view('admin.edit_bahan_baku', compact('user_data', 'bahan_baku'));
    }

    public function editAction(Request $request, $id)
    {
        $data = $request->all();
        $validatedData = validator::make($data, [ // validasi input
            'nama' => 'required',
            'stok' => 'required|numberic',
            'harga' => 'required'
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData);
        }
        // $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $bahan_baku = BahanBaku::where('id_bahan_baku', $id)->first();

        $atribut = [
            'nama' => $request['nama'],
            'stok' => $request['stok'],
            'harga' => $request['harga']
        ];

        $bahan_baku->update($atribut);
        // return ($bahan_baku);
        return redirect('admin/bahan_baku')->with('success', 'Berhasil ubah data');
    }

    public function destroy($id)
    {

        // $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $bahan_baku = BahanBaku::where('id_bahan_baku', $id)->first();

        $bahan_baku->delete();

        return redirect('admin/bahan_baku')->with('success', 'Berhasil hapus data');
    }
}
