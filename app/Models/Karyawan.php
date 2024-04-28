<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Karyawan extends Model
{
    use HasFactory, HasApiTokens;
    public $timestamps = false;

    protected $primaryKey = 'id_karyawan';
    protected $table ="karyawan";

    protected $fillable = [
        'id_jabatan',
        'nama',
        'tgl_bergabung',
        'gaji',
        'bonus',
    ];
    public function user_credential()
    {
        return $this->hasOne(user_credential::class);
    }
}
