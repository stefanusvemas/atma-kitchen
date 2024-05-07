<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hampers extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_hampers';
    protected $table = 'hampers';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'deskripsi',
        'foto_hampers',
        'harga'
    ];

    public function detailHampers()
    {
        return $this->hasMany(DetailHampers::class, 'id_hampers');
    }
}
