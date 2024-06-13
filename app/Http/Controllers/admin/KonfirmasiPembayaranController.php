<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KonfirmasiPembayaranController extends Controller
{
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();

        $pending_payments = Transaksi::with('pembayaran')
            ->whereHas('pembayaran', function($query) {
                $query->where('verifikasi_pembayaran', 0);
            })
            ->where('status', 'pending')
            ->get();
            
        $late_payments = Transaksi::with('pembayaran')
            ->whereDoesntHave('pembayaran')
            ->whereNull('status')
            ->where('created_at', '<=', now()->subMinutes(1))
            ->get();

        return view('admin.konfirmasi_pembayaran', compact('pending_payments', 'late_payments', 'user_data'));
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
        $pembayaran->tgl_konfirmasi = now();
        
        // Calculate tip if payment is greater than the total price
        $tip = max(0, $request->jumlah_pembayaran - $transaksi->total_harga);
        $transaksi->status = 'processed';
        
        $transaksi->save();
        $pembayaran->save();
    
        return redirect('/admin/konfirmasi-pembayaran')->with('success', 'Payment confirmed successfully')->with('tip', $tip);
    }

    public function cancelOrder($id_transaksi)
    {
        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
    
        if ($transaksi) {
            // Get the details of the transaction
            $detailTransaksi = DetailTransaksi::where('id_transaksi', $transaksi->id_transaksi)->get();
    
            // Loop through each detail and restore the stock
            foreach ($detailTransaksi as $detail) {
                $produk = $detail->produk; // Get the associated product
    
                // Update the product's stock or quota
                if ($produk->id_penitip == null) {
                    $produk->kuota_produksi += $detail->jumlah;
                } else {
                    $produk->stok += $detail->jumlah;
                }
    
                // Save the changes to the product
                $produk->save();
            }
    
            $transaksi->delete();
            return redirect('/admin/konfirmasi-pembayaran')->with('success', 'Order cancelled successfully');
        }
    
        return redirect('/admin/konfirmasi-pembayaran')->with('error', 'Order not found');
    }

}
