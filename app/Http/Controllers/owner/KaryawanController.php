<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $karyawan = Karyawan::whereHas('jabatan', function ($query) {
            $query->where('id_jabatan', '<>', 1);
        })->with('jabatan')->get();

        // return $karyawan;
        return view('owner.karyawan', compact('user_data', 'karyawan'));
    }

    public function search(Request $request)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $karyawan = Karyawan::whereHas('jabatan', function ($query) {
            $query->where('id_jabatan', '<>', 1);
        })->where('nama', 'like', '%' . $request->search . '%')->with('jabatan')->get();

        return view('owner.karyawan', compact('user_data', 'karyawan'));
    }

    public function edit($id)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $karyawan = Karyawan::where('id_karyawan', $id)->with('jabatan')->first();

        return view('owner.edit_karyawan', compact('user_data', 'karyawan'));
    }

    public function editAction(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'gaji' => 'required',
            'bonus' => 'required',
        ]);

        if ($validate->fails()) {
            Session::flash('error', $validate->errors());
            return back();
        }

        $request = $request->all();

        $data = [
            'gaji' => $request['gaji'],
            'bonus' => $request['bonus'],
        ];

        Karyawan::where('id_karyawan', $id)->update($data);

        Session::flash('success', 'Data karyawan berhasil diubah');

        return redirect('/owner/karyawan');
    }
}
