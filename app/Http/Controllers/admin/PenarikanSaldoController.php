<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\PenarikanSaldo;
use App\Models\TransferSaldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenarikanSaldoController extends Controller
{
    //
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        // Retrieve all withdrawal requests
        $withdrawals = PenarikanSaldo::with('customer')->where('status', 'pending')->get();


        // Return a view with the withdrawal requests
        return view('admin.pengajuan_penarikan', compact('user_data', 'withdrawals'));
        // return response()->json([
        //     'message' => 'Success',
        //     'data' => $withdrawals
        // ], 200);
    }

    public function konfirmasi($id, Request $request)
    {
        // Retrieve the withdrawal request
        $user_data = Karyawan::where(
            'id_karyawan',
            Auth::user()->id_karyawan
        )->with('jabatan')->first();
        $withdrawal = PenarikanSaldo::find($id);
        $withdrawals = PenarikanSaldo::with('customer')->where('status', 'pending')->get();
        // return $withdrawal;
        if (!$request->hasFile('foto_bukti')) {
            return response()->json([
                'message' => 'Please upload a photo of the transfer receipt'
            ], 400);
        }
        $request->validate([
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->foto_bukti->extension();
        $request->foto_bukti->move(public_path('images/transferSaldo(admin)'), $imageName);

        // Create a new TransferSaldo record
        $transferSaldo = new TransferSaldo();

        $transferSaldo->foto_bukti = $imageName;
        $transferSaldo->tgl_transfer = date('Y-m-d H:i:s');
        // $transferSaldo->save();

        $transferSaldo->id_karyawan = $user_data->id_karyawan;
        $transferSaldo->id_penarikan = $withdrawal->id_penarikan;
        $transferSaldo->bank_asal = $withdrawal->bank;
        $transferSaldo->save();

        $withdrawal->status = 'success';
        $withdrawal->save();
        return view('admin.pengajuan_penarikan', compact('user_data', 'withdrawals'));
    }

    public function tolak($id)
    {
        // Retrieve the withdrawal request
        $user_data = Karyawan::where(
            'id_karyawan',
            Auth::user()->id_karyawan
        )->with('jabatan')->first();
        $withdrawal = PenarikanSaldo::find($id);
        $withdrawals = PenarikanSaldo::with('customer')->where('status', 'pending')->get();

        // Update the status of the withdrawal request to 'failed'
        $withdrawal->status = 'failed';
        $withdrawal->save();
        return view('admin.pengajuan_penarikan', compact('user_data', 'withdrawals'));
    }
}
