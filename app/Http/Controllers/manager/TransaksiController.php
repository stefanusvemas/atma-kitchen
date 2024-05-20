<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\Customer;
use App\Models\Produk;
use App\Models\Resep;
use App\Models\Transaksi;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class TransaksiController extends Controller
{
    //
    public function listOrdersToConfirm()
    {
        $orders = Transaksi::where('status', 'pending')->get();
        return response()->json($orders);
    }

    public function rejectOrder($id)
    {
        $order = Transaksi::with('detail_transaksi')->find($id);
        if (!$order) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }
        $order->status = 'ditolak';
        $order->save();

        foreach ($order->detail_transaksi as $detail) {
            $product = Produk::find($detail->id_produk);
            if ($product) {
                $product->stok += $detail->jumlah;
                $product->kuota_produksi += $detail->jumlah;
                $product->save();
                return $product;
            }
        }

        // Menampilkan bahan baku yang digunakan
        // $usedBahanBaku = [];
        // foreach ($order->detail_transaksi as $detail) {
        //     $product = Produk::find($detail->id_produk);
        //     if ($product) {
        //         foreach ($product->resep as $resep) {
        //             foreach ($resep->bahanbaku as $bahan) {
        //                 $usedBahanBaku[] = $bahan->nama_bahan_baku;
        //             }
        //         }
        //     }
        // }
        // return response()->json(['used_bahan_baku' => $usedBahanBaku]);

        // Mengembalikan Saldo
        $customer = Customer::find($order->id_customer);
        if ($customer) {
            $customer->saldo += $order->total_harga;
            $customer->save();
        }

        return response()->json(['message' => 'Transaksi DItolak dan saldo dikembalikan']);
    }

    public function acceptOrder($id)
    {
        $order = Transaksi::with('detail_transaksi')->find($id);
        // $bb = Transaksi::with('detail_transaksi.produk.resep.bahanbaku')->find($id);


        if (!$order) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        // Memastikan pesanan belum diterima sebelumnya
        if ($order->status === 'diterima') {
            return response()->json(['message' => 'Transksi sudah diterima'], 400);
        }

        // Mengubah status pesanan menjadi 'accepted'
        $order->status = 'diterima';
        $order->save();

        // Menyimpan poin pelanggan jika pesanan diterima
        $customer = Customer::find($order->id_customer);
        if ($customer) {

            $poinEarned = 10;
            $customer->jumlah_poin += $poinEarned;
            $customer->save();
        }

        // Mengurangi stok bahan baku
        $bahanBakuKurang = [];
        foreach ($order->detail_transaksi as $detail) {
            $product = Produk::find($detail->id_produk);
            if ($product) {
                $product->stok -= $detail->jumlah;
                $product->save();
                foreach ($product->resep as $resep) {
                    foreach ($resep->bahanbaku as $bahan) {
                        $bb = BahanBaku::find($bahan->id_bahan_baku);
                        $bb_dibutuhkan = $detail->jumlah * $resep->jumlah_bahan_baku;
                        // return $bb_dibutuhkan;
                        if ($bb->stok > $bb_dibutuhkan) {
                            // jika  bahan baku tersedia 
                            $bb->stok -= $bb_dibutuhkan;
                            $bb->save();
                            // return $bb;
                        } else {
                            // jika bahan baku kurang 
                            $kurang = $bb_dibutuhkan - $bb->stok;
                            $bb->stok = $kurang;
                            $bahanBakuKurang[] = $bb;
                            // return $kurang;
                        }
                    }
                }
            }
        }


        if (!$bahanBakuKurang == []) {
            return response()->json(['bahan baku yang kurang' => $bahanBakuKurang]);
        }

        return response()->json(['message' => 'Transaksi diterima dan poin pelanggan ditambahkan']);
    }
}
