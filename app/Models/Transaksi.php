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
    public $timestamps = true;
    const UPDATED_AT = null; // Disable updated_at column

    protected $fillable = [
        'id_customer',
        'id_karyawan',
        'id_pembayaran',
        'status',
        'tgl_transaksi',
        'total_harga',
        'foto_bukti',
        'tgl_ambil',
        'poin',
        'created_at' // Include created_at in fillable
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }

    public function detail_transaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id_transaksi');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran', 'id_pembayaran');
    }
}

