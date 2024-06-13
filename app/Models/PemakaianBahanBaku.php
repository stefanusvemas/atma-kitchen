<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemakaianBahanBaku extends Model
{
    use HasFactory;

    protected $table = 'pemakaian_bahan_baku';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_bahan_baku',
        'tgl_pemakaian',
        'jumlah',
    ];

    public function bahan_baku()
    {
        return $this->belongsTo(BahanBaku::class, 'id_bahan_baku', 'id_bahan_baku');
    }
}
