<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_alamat';
    protected $table = 'alamat';
    public $timestamps = false;

    protected $fillable = [
        'id_customer',
        'nama_jalan',
        'kecamatan',
        'kelurahan',
        'jarak',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }
}
