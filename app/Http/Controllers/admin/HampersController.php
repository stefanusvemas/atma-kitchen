<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DetailHampers;
use App\Models\Hampers;
use App\Models\Karyawan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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

    public function create()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $produk = Produk::all();
        // return ($bahan_baku);
        return view('admin.tambah_hampers', compact('user_data', 'produk'));
    }

    public function createAction(Request $request)
    {

        $data = $request->all();
        $validatedData = validator::make($data, [
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'foto_hampers' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'produk.*' => 'required',
            'jumlah.*' => 'required'
        ]);

        if ($validatedData->fails()) {
            Session::flash('error', $validatedData->errors());
            return back();
        }

        if ($request->hasFile('foto_hampers')) {
            $gambarPath = $request->file('foto_hampers')->store('public/hampersImages');
            $gambarPath = str_replace('public/', 'storage/', $gambarPath);
            $data['foto_hampers'] = $gambarPath;
        }

        $data_hampers = [
            'nama' => $data['nama'],
            'harga' => $data['harga'],
            'deskripsi' => $data['deskripsi'],
            'foto_hampers' => $data['foto_hampers']
        ];

        $hampers = Hampers::create($data_hampers);

        $detail_hampers = [];
        foreach ($data['produk'] as $key => $value) {
            $detail_hampers[] = [
                'id_hampers' => $hampers->id_hampers,
                'id_produk' => $value,
                'jumlah' => $data['jumlah'][$key]
            ];
        }

        DetailHampers::insert($detail_hampers);

        return redirect('admin/hampers')->with('success', 'Berhasil tambah data');
    }

    public function edit($id)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $produk = Produk::all();
        $hampers = Hampers::where('id_hampers', $id)->first();
        $detail_hampers = DetailHampers::where('id_hampers', $id)->get();
        // return ($detail_hampers);
        return view('admin.edit_hampers', compact('user_data', 'produk', 'hampers', 'detail_hampers'));
    }

    public function editAction(Request $request, $id)
    {
        $data = $request->all();
        $validatedData = validator::make($data, [
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'foto_hampers' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'produk.*' => 'required',
            'jumlah.*' => 'required'
        ]);

        if ($validatedData->fails()) {
            Session::flash('error', $validatedData->errors());
            return back();
        }

        $hampers = Hampers::where('id_hampers', $id)->first();

        if ($request->hasFile('foto_hampers')) {
            $publicPath =
                $hampers->foto_hampers;
            $publicPath = str_replace('storage/', '', $publicPath);

            if (Storage::disk('public')->exists($publicPath)) {
                Storage::disk('public')->delete($publicPath);
            }

            $gambarPath = $request->file('foto_hampers')->store('public/hampersImages');
            $gambarPath = str_replace('public/', 'storage/', $gambarPath);
            $data['foto_hampers'] = $gambarPath;

            $data_hampers = [
                'nama' => $data['nama'],
                'harga' => $data['harga'],
                'deskripsi' => $data['deskripsi'],
                'foto_hampers' => $data['foto_hampers']
            ];
        } else {
            $data_hampers = [
                'nama' => $data['nama'],
                'harga' => $data['harga'],
                'deskripsi' => $data['deskripsi'],
            ];
        }

        $hampers->update($data_hampers);

        $detail_hampers = [];
        foreach ($data['produk'] as $key => $value) {
            $detail_hampers[] = [
                'id_hampers' => $hampers->id_hampers,
                'id_produk' => $value,
                'jumlah' => $data['jumlah'][$key]
            ];
        }

        DetailHampers::where('id_hampers', $id)->delete();
        DetailHampers::insert($detail_hampers);

        return redirect('admin/hampers')->with('success', 'Berhasil edit data');
    }

    public function destroy($id)
    {

        // $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $hampers = Hampers::where('id_hampers', $id)->first();

        $publicPath =
            $hampers->foto_hampers;
        $publicPath = str_replace('storage/', '', $publicPath);

        if (Storage::disk('public')->exists($publicPath)) {
            Storage::disk('public')->delete($publicPath);
        }
        $hampers->delete();

        return redirect('admin/hampers')->with('success', 'Berhasil hapus data');
    }

    public function search(Request $request)
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $hampers = DetailHampers::with(['produk', 'hampers'])->get()->groupBy('id_hampers');

        // Perform search if search query is provided
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $hampers = $hampers->filter(function ($item) use ($searchTerm) {
                return stripos($item->first()['produk']['nama'], $searchTerm) !== false;
            });
        }

        // return $hampers;
        return view('admin.hampers', compact('user_data', 'hampers'));
    }
}
