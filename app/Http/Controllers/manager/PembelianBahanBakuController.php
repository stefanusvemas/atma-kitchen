<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use App\Models\PembelianBahanBaku;
use App\Models\BahanBaku;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class PembelianBahanBakuController extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $pembelian = PembelianBahanBaku::all()->load('bahan_baku', 'karyawan')->sortByDesc('id_pembelian');
        // return $pembelian;

        return view('manager.pembelian_bahan_baku', compact('user_data', 'pembelian'));
    }

    public function search(Request $request)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $pembelian = PembelianBahanBaku::whereHas('bahan_baku', function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        })->orWhereHas('karyawan', function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        })->get()->load('bahan_baku', 'karyawan')->sortByDesc('id_pembelian');

        return view('manager.pembelian_bahan_baku', compact('user_data', 'pembelian'));
    }

    public function add()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $bahan_baku = BahanBaku::all();

        return view('manager.tambah_pembelian_bahan_baku', compact('user_data', 'bahan_baku'));
    }

    public function addAction(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id_bahan_baku' => 'required|exists:bahan_baku,id_bahan_baku',
            'jumlah' => 'required',
            'harga' => 'required',
        ]);

        // return Auth::user();

        if ($validate->fails()) {
            Session::flash('error', $validate->errors());
            return back();
        }

        $request = $request->all();
        $data = [
            'id_bahan_baku' => $request['id_bahan_baku'],
            'id_karyawan' => Auth::user()->id_karyawan,
            'jumlah_pembelian' => $request['jumlah'],
            'total_harga' => $request['harga'],
            'tgl_pembelian' => date('Y-m-d'),
        ];

        PembelianBahanBaku::create($data);

        BahanBaku::where('id_bahan_baku', $request['id_bahan_baku'])->increment('stok', $request['jumlah']);

        return redirect('/manager/pembelian_bahan_baku');
    }

    public function edit($id)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $pembelian = PembelianBahanBaku::where('id_pembelian', $id)->first();
        $bahan_baku = BahanBaku::all();
        if (!$pembelian) {
            session()->flash('error', 'Data tidak ditemukan.');
            return redirect('/manager/pembelian_bahan_baku');
        }
        if ($pembelian['tgl_pembelian'] != date('Y-m-d')) {
            session()->flash('error', 'Data tidak dapat diubah pada tanggal yang berbeda.');
            return redirect('/manager/pembelian_bahan_baku');
        }
        // return $pembelian;

        return view('manager.edit_pembelian_bahan_baku', compact('user_data', 'pembelian', 'bahan_baku'));
    }

    public function editAction(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'id_bahan_baku' => 'required|exists:bahan_baku,id_bahan_baku',
            'jumlah' => 'required',
            'harga' => 'required',
        ]);

        if ($validate->fails()) {
            Session::flash('error', $validate->errors());
            return back();
        }

        $pembelian = PembelianBahanBaku::where('id_pembelian', $id)->first();

        $oldBahanBakuId = $pembelian->id_bahan_baku;
        $oldJumlah = $pembelian->jumlah_pembelian;


        $request = $request->all();
        $data = [
            'id_bahan_baku' => $request['id_bahan_baku'],
            'jumlah_pembelian' => $request['jumlah'],
            'total_harga' => $request['harga'],
        ];

        PembelianBahanBaku::where('id_pembelian', $id)->update($data);

        if ($oldBahanBakuId != $request['id_bahan_baku']) {
            BahanBaku::where('id_bahan_baku', $oldBahanBakuId)->decrement('stok', $oldJumlah);
            BahanBaku::where('id_bahan_baku', $request['id_bahan_baku'])->increment('stok', $request['jumlah']);
        } else {
            $diff = $request['jumlah'] - $oldJumlah;
            BahanBaku::where('id_bahan_baku', $request['id_bahan_baku'])->increment('stok', $diff);
        }

        return redirect('/manager/pembelian_bahan_baku');
    }

    public function delete($id)
    {
        $pembelian = PembelianBahanBaku::where('id_pembelian', $id)->first();
        if (!$pembelian) {
            session()->flash('error', 'Data tidak ditemukan.');
            return redirect('/manager/pembelian_bahan_baku');
        }
        if ($pembelian['tgl_pembelian'] == date('Y-m-d')) {
            BahanBaku::where('id_bahan_baku', $pembelian->id_bahan_baku)->decrement('stok', $pembelian->jumlah_pembelian);
            PembelianBahanBaku::where('id_pembelian', $id)->delete();

            session()->flash('success', 'Data berhasil dihapus');

            return redirect('/manager/pembelian_bahan_baku');
        } else {
            session()->flash('error', 'Data tidak dapat dihapus pada tanggal yang berbeda.');
            return redirect('/manager/pembelian_bahan_baku');
        }
    }
}
