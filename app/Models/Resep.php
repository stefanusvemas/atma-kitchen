<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'id_resep';
    protected $table = "resep";

    protected $fillable = [
        'id_produk',
        'id_bahan_baku',
        'jumlah_bahan_baku',
        'satuan'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function bahanbaku()
    {
        return $this->hasMany(BahanBaku::class, 'id_bahan_baku', 'id_bahan_baku');
    }
}
