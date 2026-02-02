<?php

namespace App\Models;

use App\Traits\ClearsCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory, ClearsCache;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'gambar' => 'array',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Boot method for auto-generating slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
            // Ensure unique slug
            $originalSlug = $berita->slug;
            $count = 1;
            while (static::where('slug', $berita->slug)->exists()) {
                $berita->slug = $originalSlug . '-' . $count++;
            }
        });
    }

    /**
     * Get all comments for this berita
     */
    public function komentar(): HasMany
    {
        return $this->hasMany(KomentarBerita::class, 'berita_id')->orderBy('created_at', 'desc');
    }

    /**
     * Get approved comments only
     */
    public function approvedKomentar(): HasMany
    {
        return $this->komentar()->where('is_approved', true);
    }

    /**
     * Scope for active berita
     */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for published berita
     */
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    /**
     * Scope for ordering by latest
     */
    public function scopeTerbaru($query)
    {
        return $query->orderBy('published_at', 'desc')->orderBy('id', 'desc');
    }

    /**
     * Get first image URL
     */
    public function getGambarUtamaAttribute(): ?string
    {
        if (empty($this->gambar) || !is_array($this->gambar)) {
            return null;
        }
        
        $firstImage = $this->gambar[0] ?? null;
        if (!$firstImage) {
            return null;
        }
        
        if (str_starts_with($firstImage, 'http')) {
            return $firstImage;
        }
        
        return asset('storage/' . $firstImage);
    }

    /**
     * Get all image URLs
     */
    public function getGambarUrlsAttribute(): array
    {
        if (empty($this->gambar) || !is_array($this->gambar)) {
            return [];
        }
        
        return array_map(function ($img) {
            if (str_starts_with($img, 'http')) {
                return $img;
            }
            return asset('storage/' . $img);
        }, $this->gambar);
    }

    /**
     * Get excerpt of content
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->isi), 150);
    }

    /**
     * Get cache key to clear
     * Clears related berita cache for this berita
     */
    public function getCacheKey()
    {
        return 'related_berita_' . $this->id;
    }

    /**
     * Clear all related berita caches when any berita is updated
     */
    public static function clearAllRelatedCache()
    {
        // Get all active berita IDs
        $ids = self::aktif()->published()->pluck('id');
        
        // Clear related cache for each berita
        foreach ($ids as $id) {
            Cache::forget('related_berita_' . $id);
        }
    }
    
    /**
     * Boot the trait - override to also clear all related caches
     */
    public static function bootClearsCache()
    {
        static::saved(function ($model) {
            $model->clearCache();
            // Also clear all related caches since related berita might change
            static::clearAllRelatedCache();
        });

        static::deleted(function ($model) {
            $model->clearCache();
            static::clearAllRelatedCache();
        });

        static::updated(function ($model) {
            $model->clearCache();
            static::clearAllRelatedCache();
        });
    }
}
