<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;

class ProdukController extends Controller
{
    public function index()
    {
        $produkCollection = Produk::select('id_produk', 'nama', 'harga', 'gambar', 'kuota_produksi', 'stok')->get();

        $jumlah = DetailTransaksi::with('produk', 'transaksi')
            ->whereHas('transaksi', function ($query) {
                $query->where('tgl_ambil', date('Y-m-d'));
            })
            ->get()
            ->groupBy('produk.id_produk');

        $jumlahTotal = [];
        $remainingQuota = [];

        foreach ($jumlah as $productId => $details) {
            $jumlahTotal[$productId] = 0;

            foreach ($details as $detail) {
                $jumlahTotal[$productId] += $detail['jumlah'];
            }

            $product = $details[0]['produk'];

            if ($product['id_penitip'] == null) {
                $remainingQuota[$productId] = $product['kuota_produksi'] - $jumlahTotal[$productId];
            } else {
                $remainingQuota[$productId] = $product['stok'] - $jumlahTotal[$productId];
            }
        }

        // Update the product collection with the calculated remaining quota
        $updatedProduk = $produkCollection->map(function ($product) use ($remainingQuota) {
            if (isset($remainingQuota[$product->id_produk])) {
                if ($product->id_penitip == null) {
                    $product->kuota_produksi = $remainingQuota[$product->id_produk];
                } else {
                    $product->stok = $remainingQuota[$product->id_produk];
                }
            }
            return $product;
        });

        return response(
            [
                'status' => 'OK',
                'message' => 'Data produk berhasil ditampilkan',
                'data' => $updatedProduk
            ],
            200
        );
    }
}
