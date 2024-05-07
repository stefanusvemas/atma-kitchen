<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\Karyawan;
use App\Models\Produk;
use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResepController extends Controller
{
    //
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $products = Produk::with('resep.bahanBaku')->get()->groupBy('id_produk');
        // return ($produk);
        return view('admin.resep', compact('user_data', 'products'));
    }

    public function edit($id)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $resep = Resep::where('id_resep', $id)->first();

        if (!$resep) {
            return redirect()->back()->with('error', 'Resep tidak ditemukan');
        }

        // Ambil produk berdasarkan resep
        $produk = Produk::all();

        // Ambil bahan baku berdasarkan resep
        $bahanBaku = BahanBaku::all();

        // return ($resep);
        return view('admin.edit_resep', compact('user_data', 'produk', 'bahanBaku', 'resep'));
    }

    public function editAction(Request $request, $id)
    {
        $data = $request->all();
        $validatedData = validator::make($data, [ // validasi input
            'id_produk' => 'required',
            'id_bahan_baku' => 'required',
            'jumlah_bahan_baku' => 'required',
            'satuan' => 'required'
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData);
        }
        $resep = Resep::where('id_resep', $id)->first();

        $atribut = [
            'id_produk' => $request['id_produk'],
            'id_bahan_baku' =>  $request['id_bahan_baku'],
            'jumlah_bahan_baku' => $request['jumlah_bahan_baku'],
            'satuan' => $request['satuan']
        ];

        $resep->update($atribut);
        return redirect('admin/resep')->with('success', 'Berhasil ubah data');
    }

    public function create()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $produk = Produk::all();
        $bahan_baku = BahanBaku::all();

        // return ($bahan_baku);
        return view('admin.tambah_resep', compact('user_data', 'produk', 'bahan_baku'));
    }

    public function createAction(Request $request)
    {
        $data = $request->all();
        $validatedData = validator::make($data, [ // validasi input
            'id_produk' => 'required',
            'id_bahan_baku' => 'required',
            'jumlah_bahan_baku' => 'required',
            'satuan' => 'required'
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData);
        }

        Resep::create($data);
        // return ($bahan_baku);
        return redirect('admin/resep')->with('success', 'Berhasil Tambah data');
    }

    public function destroy($id)
    {
        $resep = Resep::where('id_resep', $id)->first();

        $resep->delete();

        return redirect('admin/resep')->with('success', 'Berhasil hapus data');
    }

    public function search(Request $request)
    {
        $search = $request->query('search');
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $products = Produk::where('nama', 'like', "%$search%")->get()->groupBy('id_produk');
        // return ($search);
        return view('admin.resep', compact('user_data', 'products'));
    }
}
