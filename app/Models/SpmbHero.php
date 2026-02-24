<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmbHero extends Model
{
    use HasFactory;

    protected $table = 'spmb_hero';

    protected $fillable = [
        'badge_text',
        'badge_warna',
        'judul_baris1',
        'judul_baris2',
        'deskripsi',
        'tahun_ajaran',
        'tampilkan_gelombang',
        'jumlah_gelombang_tampil',
        'aktif',
        'urutan',
        'bg_type',
        'bg_value',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'tampilkan_gelombang' => 'boolean',
    ];

    /**
     * Scope untuk hero yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('aktif', true);
    }

    /**
     * Scope urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    /**
     * Get hero utama (yang pertama/aktif)
     */
    public static function getHeroUtama(): ?self
    {
        return self::active()->ordered()->first();
    }

    /**
     * Badge warna classes
     */
    public function getBadgeWarnaClassAttribute(): string
    {
        $warnaClasses = [
            'blue' => 'from-blue-500 to-cyan-500',
            'green' => 'from-emerald-500 to-green-500',
            'orange' => 'from-orange-500 to-amber-500',
            'purple' => 'from-purple-500 to-violet-500',
            'red' => 'from-red-500 to-rose-500',
            'indigo' => 'from-indigo-500 to-blue-500',
        ];

        return $warnaClasses[$this->badge_warna] ?? $warnaClasses['blue'];
    }

    /**
     * Judul lengkap
     */
    public function getJudulLengkapAttribute(): string
    {
        return $this->judul_baris1 . ' ' . $this->judul_baris2;
    }

    /**
     * Background style untuk hero section
     */
    public function getBgStyleAttribute(): string
    {
        return match($this->bg_type) {
            'color' => "background: {$this->bg_value};",
            'image' => "background-image: url('" . asset($this->bg_value) . "'); background-size: cover; background-position: center;",
            default => '', // default menggunakan class tailwind di view
        };
    }
}
