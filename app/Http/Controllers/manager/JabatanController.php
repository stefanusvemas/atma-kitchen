<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;

class JabatanController extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $jabatan = Jabatan::withCount('karyawan')->get();
        // return $jabatan;

        return view('manager.jabatan', compact('user_data', 'jabatan'));
    }

    public function search(Request $request)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $jabatan = Jabatan::where('nama', 'like', '%' . $request->search . '%')->withCount('karyawan')->get();
        // return $jabatan;

        return view('manager.jabatan', compact('user_data', 'jabatan'));
    }

    public function add()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        return view('manager.tambah_jabatan', compact('user_data'));
    }

    public function addAction(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        Jabatan::create([
            'nama' => $request->nama,
            'gaji_pokok' => 0,
            'bonus' => 0,
        ]);

        return redirect('manager/jabatan');
    }

    public function edit($id)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $jabatan = Jabatan::where('id_jabatan', $id)->first();
        return view('manager.edit_jabatan', compact('user_data', 'jabatan'));
    }

    public function editAction(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        Jabatan::where('id_jabatan', $id)->update([
            'nama' => $request->nama
        ]);

        return redirect('manager/jabatan');
    }

    public function delete($id)
    {
        Jabatan::where('id_jabatan', $id)->delete();
        return redirect('manager/jabatan');
    }
}
