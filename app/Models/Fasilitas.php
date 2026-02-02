<?php

namespace App\Models;

use App\Traits\ClearsCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory, ClearsCache;

    protected $table = 'fasilitas';

    protected $fillable = [
        'nama',
        'gambar',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'gambar' => 'array',
    ];

    /**
     * Scope untuk fasilitas aktif
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
     * Get gambar URLs
     */
    public function getGambarUrlsAttribute()
    {
        if (empty($this->gambar) || !is_array($this->gambar)) {
            return [];
        }

        return array_map(function ($gambar) {
            if (str_starts_with($gambar, 'http')) {
                return $gambar;
            }
            return asset('storage/' . $gambar);
        }, $this->gambar);
    }

    /**
     * Get main gambar URL (first image)
     */
    public function getGambarUrlAttribute()
    {
        if (empty($this->gambar)) {
            return null;
        }

        $gambar = is_array($this->gambar) ? ($this->gambar[0] ?? null) : $this->gambar;

        if (!$gambar) {
            return null;
        }
        
        if (str_starts_with($gambar, 'http')) {
            return $gambar;
        }
        
        return asset('storage/' . $gambar);
    }

    /**
     * Get cache key to clear
     */
    public function getCacheKey()
    {
        return 'fasilitas_aktif';
    }
}
