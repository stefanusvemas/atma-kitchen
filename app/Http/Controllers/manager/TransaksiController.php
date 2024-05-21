<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\BahanBaku;
use App\Models\Customer;
use App\Models\Karyawan;
use App\Models\Produk;
use App\Models\Resep;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class TransaksiController extends Controller
{
    //
    public function index()
    {
        $user_data = Karyawan::where('id_karyawan', Auth::user()->id_karyawan)->with('jabatan')->first();
        $orders = Transaksi::where('status', 'approved')->with('detail_transaksi')->get();
        return view('manager.list_pesanan', compact('user_data', 'orders'));
        // return response()->json($orders);
    }

    public function rejectOrder($id)
    {
        $order = Transaksi::with('detail_transaksi')->find($id);
        if (!$order) {
            abort(404);
        }
        $order->status = 'Declined';
        $order->save();

        foreach ($order->detail_transaksi as $detail) {
            $product = Produk::find($detail->id_produk);
            if ($product) {
                $product->stok += $detail->jumlah;
                $product->kuota_produksi += $detail->jumlah;
                $product->save();
            }
        }
        // Mengembalikan Saldo
        $customer = Customer::find($order->id_customer);
        if ($customer) {
            $customer->saldo += $order->total_harga;
            $customer->save();
        }
        return redirect('/manager/list_pesanan');
    }

    public function acceptOrder($id)
    {
        $order = Transaksi::with('detail_transaksi')->find($id);
        // $bb = Transaksi::with('detail_transaksi.produk.resep.bahanbaku')->find($id);

        if (!$order) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        // Memastikan pesanan belum diterima sebelumnya
        if ($order->status === 'process') {
            return response()->json(['message' => 'Transksi sudah diproses'], 400);
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

        // Mengubah status pesanan menjadi 'accepted'
        $order->status = 'process';
        $order->save();

        // Menyimpan poin pelanggan jika pesanan diterima
        $customer = Customer::find($order->id_customer);
        if ($customer) {
            $total_harga = $order->total_harga;
            if ($total_harga > 500000) {
                $poinEarned = 50;
            } elseif ($total_harga > 200000) {
                $poinEarned = 30;
            } elseif ($total_harga > 13000) {
                $poinEarned = 1;
            } else {
                $poinEarned = 0;
            }

            $customer->jumlah_poin += $poinEarned;
            $customer->save();
        }

        return redirect('/manager/list_pesanan');
        // return response()->json(['message' => 'Transaksi diterima dan poin pelanggan ditambahkan']);
    }
}
