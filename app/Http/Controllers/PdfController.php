<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\NotaPemesanan;
use App\Models\Pengiriman;
use App\Models\Transaksi;
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

        $alamat = Pengiriman::where('id_transaksi', $id)->first();
        if ($alamat != null) {
            $pengiriman = Pengiriman::where('id_transaksi', $data->transaksi->id_transaksi)->first()->load('alamat');
        } else {
            $pengiriman = null;
        }

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

    public function penjualanProduk(Request $request)
    {
        $month = $request->month;
        list($tahun, $month) = explode('-', $month);
        $bulan = date('F', mktime(0, 0, 0, $month, 10));
        $tgl_cetak = date('d F Y');

        $groupedTransactions = DB::table('transaksi')
            ->join('detail_transaksi', 'transaksi.id_transaksi', '=', 'detail_transaksi.id_transaksi')
            ->join('produk', 'detail_transaksi.id_produk', '=', 'produk.id_produk')
            ->select(
                'detail_transaksi.id_produk',
                'produk.nama as product_name',
                'produk.harga as product_price',
                DB::raw('SUM(detail_transaksi.jumlah) as total_amount'),
                DB::raw('SUM(detail_transaksi.jumlah * produk.harga) as total_price'),
            )
            ->whereMonth('transaksi.tgl_transaksi', $month)->whereYear('transaksi.tgl_transaksi', $tahun)
            ->where('transaksi.status', 'completed')
            ->groupBy('detail_transaksi.id_produk', 'produk.nama', 'produk.harga')
            ->get();

        $totalPrice = $groupedTransactions->sum('total_price');
        // return $groupedTransactions;
        $pdf = Pdf::loadView('pdf.penjualan_by_produk', ['groupedTransactions' => $groupedTransactions, 'bulan' => $bulan, 'tahun' => $tahun, 'tgl_cetak' => $tgl_cetak, 'totalPrice' => $totalPrice]);

        return $pdf->stream();
    }

    public function stokBahanBaku()
    {
        $tgl_cetak = date('d F Y');
        $data = BahanBaku::all();
        // return $data;
        $pdf = Pdf::loadView('pdf.stok_bahan_baku', ['tgl_cetak' => $tgl_cetak, 'data' => $data]);

        return $pdf->stream();

    }
}

