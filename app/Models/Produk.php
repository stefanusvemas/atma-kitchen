<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_produk';
    protected $table = 'produk';
    public $timestamps = false;

    protected $fillable = [
        'id_penitip',
        'nama',
        'gambar',
        'harga',
        'stok',
        'kuota_produksi',
        'status',
        'deskripsi'
    ];

    public function resep()
    {
        return $this->hasMany(Resep::class, 'id_produk');
    }

    public function detailHampers()
    {
        return $this->hasMany(DetailHampers::class, 'id_produk');
    }

    public function penitip()
    {
        return $this->belongsTo(Penitip::class, 'id_penitip', 'id_penitip');
    }
}
