<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailHampers extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail_hampers';
    protected $table = 'detail_hampers';
    public $timestamps = false;

    protected $fillable = [
        'id_hampers',
        'id_produk',
        'jumlah',
        'satuan'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function hampers()
    {
        return $this->belongsTo(Hampers::class, 'id_hampers');
    }
}
