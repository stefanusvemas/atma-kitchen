<?php

namespace App\Http\Controllers;

use App\Models\NotaPemesanan;
use App\Models\Pengiriman;
use App\Models\user_credential;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function invoice($id)
    {
        $data = NotaPemesanan::where('no_nota', $id)->first()->load('transaksi', 'transaksi.pembayaran', 'transaksi.customer');
        $pengiriman = Pengiriman::where('id_transaksi', $data->transaksi->id_transaksi)->first()->load('alamat');
        $detail_transaksi = $data->transaksi->detail_transaksi->load('produk');
        $email = user_credential::where('id_customer', $data->transaksi->id_customer)->first()->email;
        // return $email;
        $total_harga = $data->transaksi->total_harga;
        if ($total_harga > 500000) {
            $poinEarned = 50;
        } elseif ($total_harga > 200000) {
            $poinEarned = 30;
        } elseif ($total_harga > 13000) {
            $poinEarned = 1;
        } else {
            $poinEarned = 0;
        }

        $pdf = Pdf::loadView('pdf.invoice', ['data' => $data, 'pengiriman' => $pengiriman, 'detail_transaksi' => $detail_transaksi, 'poinEarned' => $poinEarned, 'email' => $email]);

        return $pdf->stream();
    }

    public function invoiceByProduct($id)
    {
        $nota = NotaPemesanan::where('id_transaksi', $id)->first();
        if ($nota == null) {
            $nota = NotaPemesanan::create([
                'id_transaksi' => $id
            ]);
        }

        $data = NotaPemesanan::where('id_transaksi', $id)->first()->load('transaksi', 'transaksi.pembayaran', 'transaksi.customer');
        // return $data;
        $pengiriman = Pengiriman::where('id_transaksi', $data->transaksi->id_transaksi)->first()->load('alamat');
        $detail_transaksi = $data->transaksi->detail_transaksi->load('produk');
        $email = user_credential::where('id_customer', $data->transaksi->id_customer)->first()->email;
        // return $email;
        $total_harga = $data->transaksi->total_harga;
        if ($total_harga > 500000) {
            $poinEarned = 50;
        } elseif ($total_harga > 200000) {
            $poinEarned = 30;
        } elseif ($total_harga > 13000) {
            $poinEarned = 1;
        } else {
            $poinEarned = 0;
        }

        $pdf = Pdf::loadView('pdf.invoice', ['data' => $data, 'pengiriman' => $pengiriman, 'detail_transaksi' => $detail_transaksi, 'poinEarned' => $poinEarned, 'email' => $email]);

        return $pdf->stream();
    }
}
