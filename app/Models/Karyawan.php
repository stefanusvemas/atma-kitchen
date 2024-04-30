<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Jabatan;

class Karyawan extends Model
{
    use HasFactory, HasApiTokens;
    public $timestamps = false;

    protected $primaryKey = 'id_karyawan';
    protected $table = "karyawan";

    protected $fillable = [
        'id_jabatan',
        'nama',
        'tgl_bergabung',
        'gaji',
        'bonus',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }
    public function user_credential()
    {
        return $this->hasOne(user_credential::class);
    }
}
