<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Beranda Section
 * 
 * Menyimpan data section untuk halaman beranda/homepage
 */
class BerandaSection extends Model
{
    use HasFactory;

    protected $table = 'beranda_sections';

    /**
     * Tipe section
     */
    const TYPE_HERO = 'hero';
    const TYPE_ABOUT = 'about';
    const TYPE_FEATURE = 'feature';
    const TYPE_STATISTIC = 'statistic';
    const TYPE_CTA = 'cta';

    protected $fillable = [
        'judul',
        'subjudul',
        'konten',
        'gambar',
        'tipe',
        'urutan',
        'is_active',
        'tombol_teks',
        'tombol_link',
        'warna_latar',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * Get daftar tipe section
     */
    public static function getTipeList(): array
    {
        return [
            self::TYPE_HERO => 'Hero (Banner Utama)',
            self::TYPE_ABOUT => 'Tentang Kami',
            self::TYPE_FEATURE => 'Fitur/Keunggulan',
            self::TYPE_STATISTIC => 'Statistik',
            self::TYPE_CTA => 'Call to Action',
        ];
    }

    /**
     * Get label tipe
     */
    public function getTipeLabelAttribute(): string
    {
        return self::getTipeList()[$this->tipe] ?? $this->tipe;
    }

    /**
     * Scope active
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope ordered
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    /**
     * Get gambar url
     */
    public function getGambarUrlAttribute(): ?string
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }

    /**
     * Get warna badge
     */
    public function getWarnaBadgeAttribute(): string
    {
        return match($this->tipe) {
            self::TYPE_HERO => 'bg-purple-100 text-purple-700',
            self::TYPE_ABOUT => 'bg-blue-100 text-blue-700',
            self::TYPE_FEATURE => 'bg-green-100 text-green-700',
            self::TYPE_STATISTIC => 'bg-orange-100 text-orange-700',
            self::TYPE_CTA => 'bg-red-100 text-red-700',
            default => 'bg-slate-100 text-slate-700',
        };
    }
}
