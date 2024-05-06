<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use App\Models\Penitip;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class PenitipController extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $penitip = Penitip::all();

        return view('manager.penitip', compact('user_data', 'penitip'));
    }

    public function search(Request $request)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $penitip = Penitip::where('nama', 'like', '%' . $request->search . '%')->get();

        return view('manager.penitip', compact('user_data', 'penitip'));
    }

    public function add()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();

        return view('manager.tambah_penitip', compact('user_data'));
    }

    public function addAction(Request $request)
    {
        // return $request->all();
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        if ($validate->fails()) {
            Session::flash('error', $validate->errors());
            return back();
        }

        $request = $request->all();
        Penitip::create($request);

        return redirect('/manager/penitip');
    }

    public function edit($id)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $penitip = Penitip::where('id_penitip', $id)->first();

        return view('manager.edit_penitip', compact('user_data', 'penitip'));
    }

    public function editAction(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        if ($validate->fails()) {
            Session::flash('error', $validate->errors());
            return back();
        }

        $request = $request->all();
        $data = [
            'nama' => $request['nama'],
            'alamat' => $request['alamat'],
            'no_telp' => $request['no_telp'],
        ];
        Penitip::where('id_penitip', $id)->update($data);

        return redirect('/manager/penitip');
    }

    public function delete($id)
    {
        Penitip::where('id_penitip', $id)->delete();

        return redirect('/manager/penitip');
    }
}
