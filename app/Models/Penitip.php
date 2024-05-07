<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penitip extends Model
{
    use HasFactory;
    protected $table = 'penitip';
    protected $primaryKey = 'id_penitip';
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'alamat',
        'no_telp',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_penitip', 'id_penitip');
    }
}
