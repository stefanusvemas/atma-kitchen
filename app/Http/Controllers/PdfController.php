<?php

namespace App\Http\Controllers;

use App\Models\NotaPemesanan;
use App\Models\Pengiriman;
use App\Models\user_credential;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
use App\Models\Resep;
use Barryvdh\DomPDF\Facade\Pdf;
use ConsoleTVs\Charts\Charts;
use App\Models\BahanBaku;
use Carbon\Carbon;

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

    public function laporanPenjualanBulanan()
    {
        $penjualan = Transaksi::with('detail_transaksi.produk')
            ->get()
            ->groupBy(function($item) {
                return Carbon::parse($item->tgl_transaksi)->format('F Y');
            })
            ->map(function($item) {
                return [
                    'bulan' => Carbon::parse($item->first()->tgl_transaksi)->format('F Y'),
                    'jumlah_transaksi' => $item->count(),
                    'total_harga' => $item->sum('total_harga'),
                ];
            });
    
        $pdf = Pdf::loadView('pdf.laporan_penjualan', compact('penjualan'));
    
        return $pdf->stream('laporan_penjualan_bulanan.pdf');
    }
    public function laporanBahanBakuPerPeriode(Request $request)
    {
        // Ambil tanggal awal dan akhir dari database dan format menjadi tanggal saja
        $tanggal_awal = Carbon::parse(Resep::min('created_at'))->format('Y-m-d');
        $tanggal_akhir = Carbon::parse(Resep::max('created_at'))->format('Y-m-d');
    
        // Ambil data dari database
        $bahanbaku = Resep::join('bahan_baku', 'resep.id_bahan_baku', '=', 'bahan_baku.id_bahan_baku')
                        ->select('bahan_baku.nama', 'resep.satuan', DB::raw('SUM(resep.jumlah_bahan_baku) as jumlah_penggunaan'))
                        ->whereBetween('resep.created_at', [$tanggal_awal, $tanggal_akhir])
                        ->groupBy('bahan_baku.nama', 'resep.satuan')
                        ->get();
    
        // Kirim data ke view
        $pdf = Pdf::loadView('pdf.laporan_bahan_baku', compact('bahanbaku', 'tanggal_awal', 'tanggal_akhir'));
        return $pdf->stream('laporan_bahan_baku.pdf');
    }
}

