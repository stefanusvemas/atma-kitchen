<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Karyawan;

class Transaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';
    protected $table = 'transaksi';

    protected $fillable = [
        'id_customer',
        'id_karyawan',
        'id_pembayaran',
        'status',
        'tgl_transaksi',
        'total_harga',
        'foto_bukti'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }

    //     public function pembayaran()
    //     {
    //         return $this->belongsTo(Pembayaran::class, 'id_pembayaran', 'id_pembayaran');
    //     }
}
