<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alamat;

class Pengiriman extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';
    protected $table = 'pengiriman';
    public $timestamps = false;

    protected $fillable = [
        'id_transaksi',
        'id_alamat',
        'status_pengiriman',
        'waktu_pickup',
        'foto_bukti_diterima',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'id_alamat', 'id_alamat');
    }
}
