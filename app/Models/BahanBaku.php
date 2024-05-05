<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_bahan_baku';
    protected $table = 'bahan_baku';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'stok',
        'harga'
    ];

    public function resep()
    {
        return $this->hasMany(Resep::class, 'id_bahan_baku');
    }
}
