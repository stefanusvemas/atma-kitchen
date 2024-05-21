<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pembayaran', 'id_pembayaran');
    }
}
