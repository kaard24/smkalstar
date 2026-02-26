<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanKegiatanGambar extends Model
{
    use HasFactory;

    protected $table = 'jurusan_kegiatan_gambar';

    protected $fillable = [
        'kegiatan_id',
        'gambar',
        'urutan',
    ];

    /**
     * Relasi ke kegiatan
     */
    public function kegiatan()
    {
        return $this->belongsTo(JurusanKegiatan::class, 'kegiatan_id');
    }

    /**
     * Get gambar URL
     */
    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) {
            return null;
        }
        
        if (str_starts_with($this->gambar, 'http')) {
            return $this->gambar;
        }
        
        if (str_starts_with($this->gambar, 'images/')) {
            return asset($this->gambar);
        }
        
        return asset('storage/' . $this->gambar);
    }
}
