<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    //
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $produk = Produk::all();
        return view('admin.product', compact('user_data', 'produk'));
    }

    public function create_sendiri()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        return view('admin.tambah_produk_sendiri', compact('user_data'));
    }

    public function create_sendiriAction(Request $request)
    {
        $data = $request->all();

        // Lakukan validasi input
        $validatedData = validator::make($data, [
            'nama' => 'required',
            'gambar' => 'required',
            'stok' => 'required',
            'kuota_produksi' => 'required',
            'harga' => 'required',
        ]);

        if ($validatedData->fails()) {
            return back()->withErrors($validatedData)->withInput();
        }
        
        $data['status'] = 'aktif';

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public/produkImages');
            // Simpan path gambar ke dalam $data
            $data['gambar'] = $gambarPath;
        }

        // Buat produk baru dengan data yang sudah divalidasi
        Produk::create($data);
        return redirect('admin/produk')->with('success', 'Berhasil Tambah data');
    }


    public function destroy($id)
    {
        $produk = Produk::where('id_produk', $id)->first();
        $produk->delete();
        return redirect('admin/produk')->with('success', 'Berhasil hapus data');
    }
}
