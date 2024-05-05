<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\user_credential;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $karyawan = Karyawan::whereHas('jabatan', function ($query) {
            $query->where('id_jabatan', '<>', 1);
        })->with('jabatan')->get();
        // return $karyawan;

        return view('manager.karyawan', compact('user_data', 'karyawan'));
    }

    public function search(Request $request)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $karyawan = Karyawan::whereHas('jabatan', function ($query) {
            $query->where('id_jabatan', '<>', 1);
        })->where('nama', 'like', '%' . $request->search . '%')->with('jabatan')->get();

        return view('manager.karyawan', compact('user_data', 'karyawan'));
    }

    public function add()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $jabatan = Jabatan::where('id_jabatan', '<>', 1)->get();

        return view('manager.tambah_karyawan', compact('user_data', 'jabatan'));
    }

    public function addAction(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email:rfc|unique:user_credentials,email',
            'password' => 'required',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
        ]);

        if ($validate->fails()) {
            Session::flash('error', $validate->errors());
            return back();
        }

        $request = $request->all();
        $data_karyawan = [
            'nama' => $request['nama'],
            'id_jabatan' => $request['id_jabatan'],
            'tgl_bergabung' => date('Y-m-d'),
            'gaji' => 0,
            'bonus' => 0,
        ];

        $karyawan = Karyawan::create($data_karyawan);

        user_credential::create([
            'id_karyawan' => $karyawan->id_karyawan,
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'active' => 1,
        ]);

        return redirect('manager/karyawan');
    }

    public function edit($id)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $karyawan = Karyawan::where('id_karyawan', $id)->with('jabatan')->first();
        $jabatan = Jabatan::where('id_jabatan', '<>', 1)->get();
        // return $karyawan;

        return view('manager.edit_karyawan', compact('user_data', 'karyawan', 'jabatan'));
    }

    public function editAction(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
        ]);

        if ($validate->fails()) {
            Session::flash('error', $validate->errors());
            return back();
        }

        $request = $request->all();
        $data_karyawan = [
            'nama' => $request['nama'],
            'id_jabatan' => $request['id_jabatan'],
        ];

        Karyawan::where('id_karyawan', $id)->update($data_karyawan);

        return redirect('manager/karyawan');
    }

    public function delete($id)
    {
        Karyawan::where('id_karyawan', $id)->delete();

        return redirect('manager/karyawan');
    }
}
