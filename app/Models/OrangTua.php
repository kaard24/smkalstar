<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $table = 'orang_tua';

    protected $fillable = [
        'calon_siswa_id',
        'jenis',
        'nama_ayah',
        'nik_ayah',
        'status_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'nik_ibu',
        'status_ibu',
        'pekerjaan_ibu',
        'no_wa_ortu',
        'pekerjaan',
        'nama_wali',
        'pekerjaan_wali',
        'no_hp_wali',
        'hubungan_wali',
    ];

    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }
}
