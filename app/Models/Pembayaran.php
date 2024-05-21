<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;

class Pembayaran extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pembayaran';
    protected $table = 'pembayaran';
    public $timestamps = false;

    protected $fillable = [
        'jumlah_pembayaran',
        'jenis_pembayaran',
        'verifikasi_pembayaran',
        'tgl_konfirmasi',
    ];

    protected $casts = [
        'verifikasi_pembayaran' => 'boolean',
    ];

    protected $dates = [
        'tgl_konfirmasi',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
