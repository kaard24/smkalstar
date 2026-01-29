<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'calon_siswa_id',
        'jurusan_id',
        'gelombang',
        'status_pendaftaran'
    ];

    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function tes()
    {
        return $this->hasOne(Tes::class);
    }

    public function pengumuman()
    {
        return $this->hasOne(Pengumuman::class);
    }
}
