<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KonfirmasiPembayaranController extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();

        $pending_payments = Transaksi::where('status', 'pending')
            ->whereHas('customer.addresses', function($query) {
                $query->where('jarak', '>', 0);
            })
            ->with(['customer.addresses', 'detail_transaksi.produk'])
            ->get();

        return view('admin.konfirmasi_pembayaran', compact('pending_payments', 'user_data'));
    }

    public function confirmPayment(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id_transaksi',
            'jumlah_pembayaran' => 'required|numeric|min:0',
        ]);
    
        DB::transaction(function () use ($request) {
            $transaksi = Transaksi::findOrFail($request->id_transaksi);
            
            $pembayaran = new Pembayaran([
                'jumlah_pembayaran' => $request->jumlah_pembayaran,
                'jenis_pembayaran' => 'YourPaymentType', // Sesuaikan dengan jenis pembayaran yang sesuai
                'verifikasi_pembayaran' => 1,
                'tgl_konfirmasi' => now(), // Tambahkan tanggal konfirmasi saat ini
                'id_transaksi' => $transaksi->id_transaksi,
            ]);
    
            $pembayaran->save();
    
            if ($pembayaran->verifikasi_pembayaran == 1) {
                $transaksi->status = 'complete';
                $transaksi->save();
            }
        });
    
        return redirect('/admin/konfirmasi-pembayaran')->with('success', 'Payment confirmed successfully');
    }    
}
