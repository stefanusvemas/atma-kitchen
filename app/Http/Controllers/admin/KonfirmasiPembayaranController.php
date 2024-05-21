<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonfirmasiPembayaranController extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();

        $pending_payments = Transaksi::with(['pembayaran', 'customer.addresses', 'detail_transaksi.produk'])
            ->whereHas('pembayaran', function($query) {
                $query->where('verifikasi_pembayaran', 0);
            })
            ->where('status', 'pending')
            ->get();

        $shipping_rate = 2000;

        foreach ($pending_payments as $payment) {
            $address = $payment->customer->addresses->first();
            $shipping_cost = $address ? $address->jarak * $shipping_rate : 0;
            $payment->calculated_shipping_cost = $shipping_cost;
            $payment->calculated_total_price = $payment->total_harga + $shipping_cost;
        }

        return view('admin.konfirmasi_pembayaran', compact('pending_payments', 'user_data', 'shipping_rate'));
    }

    public function confirmPayment(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id_transaksi',
            'jumlah_pembayaran' => 'required|numeric|min:0',
        ]);

        $transaksi = Transaksi::where('id_transaksi', $request->id_transaksi)->first();
        $pembayaran = Pembayaran::where('id_pembayaran', $transaksi->id_pembayaran)->first();

        $pembayaran->verifikasi_pembayaran = 1;
        $pembayaran->jumlah_pembayaran = $request->jumlah_pembayaran;
        $pembayaran->tgl_konfirmasi = date('Y-m-d H:i:s');
        $transaksi->status = 'approved';
        $transaksi->save();
        $pembayaran->save();

        return redirect('/admin/konfirmasi-pembayaran')->with('success', 'Payment confirmed successfully');
    }
}


