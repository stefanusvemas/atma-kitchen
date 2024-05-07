<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranLain extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran_lain';
    protected $primaryKey = 'id_pengeluaran_lain';
    public $timestamps = false;

    protected $fillable = [
        'id_karyawan',
        'jumlah_pengeluaran',
        'deskripsi',
        'tgl_Pengeluaran',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }
}
