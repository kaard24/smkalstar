<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanKegiatan extends Model
{
    use HasFactory;

    protected $table = 'jurusan_kegiatan';

    protected $fillable = [
        'jurusan_id',
        'judul',
        'deskripsi',
        'urutan',
    ];

    /**
     * Relasi ke jurusan
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Relasi ke gambar-gambar kegiatan
     */
    public function gambar()
    {
        return $this->hasMany(JurusanKegiatanGambar::class, 'kegiatan_id')->orderBy('urutan');
    }

    /**
     * Get gambar URLs attribute
     */
    public function getGambarUrlsAttribute()
    {
        return $this->gambar->map(function ($g) {
            return $g->gambar_url;
        });
    }
}
