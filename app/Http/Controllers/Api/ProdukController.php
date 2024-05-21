<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::get()->select('id_produk', 'nama', 'harga', 'gambar', 'kuota_produksi', 'stok');

        return response(
            [
                'status' => 'OK',
                'message' => 'Data produk berhasil ditampilkan',
                'data' => $produk
            ],
            200
        );
    }
}
