<?php

namespace App\Models;

use App\Traits\ClearsCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory, ClearsCache;

    protected $table = 'jurusan';

    protected $fillable = [
        'kode',
        'nama',
        'kategori',
        'deskripsi',
        'gambar',
        'logo',
        'peluang_karir',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'peluang_karir' => 'array',
        'aktif' => 'boolean',
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    /**
     * Scope untuk jurusan aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    /**
     * Scope untuk urutan
     */
    public function scopeUrut($query)
    {
        return $query->orderBy('urutan');
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
        
        // If path starts with 'images/', it's in public folder
        if (str_starts_with($this->gambar, 'images/')) {
            return asset($this->gambar);
        }
        
        // Otherwise assume it's in storage
        return asset('storage/' . $this->gambar);
    }

    /**
     * Get logo URL
     */
    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return null;
        }
        
        if (str_starts_with($this->logo, 'http')) {
            return $this->logo;
        }
        
        // If path starts with 'images/', it's in public folder
        if (str_starts_with($this->logo, 'images/')) {
            return asset($this->logo);
        }
        
        // Otherwise assume it's in storage
        return asset('storage/' . $this->logo);
    }

    /**
     * Get cache key to clear
     */
    public function getCacheKey()
    {
        return 'jurusan_aktif';
    }
}
