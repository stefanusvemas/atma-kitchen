<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;

class Pembayaran extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pembayaran';
    protected $table = 'pembayaran'; // Pastikan tabelnya benar

    protected $fillable = [
        'jumlah_pembayaran',
        'jenis_pembayaran',
        'verifikasi_pembayaran',
        'tgl_konfirmasi',
    ];

    public $timestamps = false; // Menonaktifkan timestamps

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
