<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_jabatan';
    protected $table = 'jabatan';

    protected $fillable = [
        'nama',
    ];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'id_jabatan', 'id_jabatan');
    }
}
