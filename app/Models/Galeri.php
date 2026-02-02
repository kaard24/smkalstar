<?php

namespace App\Models;

use App\Traits\ClearsCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory, ClearsCache;

    protected $table = 'galeri';

    protected $fillable = [
        'gambar',
        'keterangan',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active items
     */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordering
     */
    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('id', 'desc');
    }

    /**
     * Get the gambar URL
     */
    public function getGambarUrlAttribute(): ?string
    {
        if (!$this->gambar) {
            return null;
        }
        
        if (str_starts_with($this->gambar, 'http')) {
            return $this->gambar;
        }
        
        return asset('storage/' . $this->gambar);
    }

    /**
     * Get cache key to clear
     */
    public function getCacheKey()
    {
        return 'galeri_aktif';
    }
}
