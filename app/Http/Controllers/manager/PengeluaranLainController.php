<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use App\Models\PengeluaranLain;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class PengeluaranLainController extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $pengeluaran_lain = PengeluaranLain::all()->sortByDesc('id_pengeluaran');

        return view('manager.pengeluaran_lain', compact('user_data', 'pengeluaran_lain'));
    }

    public function search(Request $request)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $pengeluaran_lain = PengeluaranLain::where('deskripsi', 'like', '%' . $request->search . '%')->get()->sortByDesc('id_pengeluaran');

        return view('manager.pengeluaran_lain', compact('user_data', 'pengeluaran_lain'));
    }

    public function add()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();

        return view('manager.tambah_pengeluaran_lain', compact('user_data'));
    }

    public function addAction(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'deskripsi' => 'required',
            'jumlah' => 'required',
        ]);

        if ($validate->fails()) {
            Session::flash('error', $validate->errors());
            return back();
        }

        $request = $request->all();
        $data = [
            'tgl_Pengeluaran' => date('Y-m-d'),
            'deskripsi' => $request['deskripsi'],
            'jumlah_pengeluaran' => $request['jumlah'],
            'id_karyawan' => Auth::user()->id_karyawan,
        ];
        PengeluaranLain::create($data);

        Session::flash('success', 'Pengeluaran Lain berhasil ditambahkan');

        return redirect('/manager/pengeluaran_lain');
    }

    public function edit($id)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $pengeluaran_lain = PengeluaranLain::where('id_pengeluaran', $id)->first();

        return view('manager.edit_pengeluaran_lain', compact('user_data', 'pengeluaran_lain'));
    }

    public function editAction(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'deskripsi' => 'required',
            'jumlah' => 'required',
        ]);

        if ($validate->fails()) {
            Session::flash('error', $validate->errors());
            return back();
        }

        $request = $request->all();
        $data = [
            'deskripsi' => $request['deskripsi'],
            'jumlah_pengeluaran' => $request['jumlah'],
        ];
        PengeluaranLain::where('id_pengeluaran', $id)->update($data);

        Session::flash('success', 'Pengeluaran Lain berhasil diubah');

        return redirect('/manager/pengeluaran_lain');
    }

    public function delete($id)
    {
        if (!PengeluaranLain::where('id_pengeluaran', $id)->first()) {
            Session::flash('error', 'Pengeluaran Lain tidak ditemukan');
            return redirect('/manager/pengeluaran_lain');
        }

        PengeluaranLain::where('id_pengeluaran', $id)->delete();

        Session::flash('success', 'Pengeluaran Lain berhasil dihapus');

        return redirect('/manager/pengeluaran_lain');
    }
}
