<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Seragam extends Model
{
    protected $table = 'seragam';

    protected $fillable = [
        'hari',
        'foto_laki',
        'foto_perempuan',
        'keterangan_foto_laki',
        'keterangan_foto_perempuan',
        'keterangan',
        'warna_tema',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'urutan' => 'integer',
        'foto_laki' => 'array',
        'foto_perempuan' => 'array',
        'keterangan_foto_laki' => 'array',
        'keterangan_foto_perempuan' => 'array',
    ];

    /**
     * Boot method untuk set default array kosong
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->foto_laki = $model->foto_laki ?? [];
            $model->foto_perempuan = $model->foto_perempuan ?? [];
        });
    }

    /**
     * Get foto laki URLs
     */
    public function getFotoLakiUrlsAttribute(): array
    {
        if (empty($this->foto_laki)) {
            return [];
        }

        return array_map(function ($foto) {
            return Storage::disk('public')->url($foto);
        }, $this->foto_laki);
    }

    /**
     * Get foto perempuan URLs
     */
    public function getFotoPerempuanUrlsAttribute(): array
    {
        if (empty($this->foto_perempuan)) {
            return [];
        }

        return array_map(function ($foto) {
            return Storage::disk('public')->url($foto);
        }, $this->foto_perempuan);
    }

    /**
     * Get foto laki pertama URL (backward compatibility)
     */
    public function getFotoLakiUrlAttribute(): ?string
    {
        $urls = $this->getFotoLakiUrlsAttribute();
        return $urls[0] ?? null;
    }

    /**
     * Get foto perempuan pertama URL (backward compatibility)
     */
    public function getFotoPerempuanUrlAttribute(): ?string
    {
        $urls = $this->getFotoPerempuanUrlsAttribute();
        return $urls[0] ?? null;
    }

    /**
     * Get icon based on hari
     */
    public function getIconAttribute(): string
    {
        $icons = [
            'Senin' => '👔',
            'Selasa' => '👕',
            'Rabu' => '⚜️',
            'Kamis' => '👖',
            'Jumat' => '🧕',
            'Sabtu' => '👟',
        ];
        return $icons[$this->hari] ?? '👔';
    }

    /**
     * Get gradient class based on warna_tema
     */
    public function getGradientClassAttribute(): string
    {
        $gradients = [
            'blue' => 'from-blue-500 to-blue-600',
            'gray' => 'from-slate-500 to-slate-600',
            'green' => 'from-emerald-500 to-emerald-600',
            'red' => 'from-rose-500 to-rose-600',
            'purple' => 'from-violet-500 to-violet-600',
            'orange' => 'from-orange-500 to-orange-600',
            'brown' => 'from-amber-700 to-amber-800',
        ];
        return $gradients[$this->warna_tema] ?? 'from-blue-500 to-blue-600';
    }

    /**
     * Scope active
     */
    public function scopeActive($query)
    {
        return $query->where('aktif', true);
    }

    /**
     * Scope ordered
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }

    /**
     * Get foto laki dengan keterangan (untuk view)
     */
    public function getFotoLakiDataAttribute(): array
    {
        $photos = $this->foto_laki ?? [];
        $captions = $this->keterangan_foto_laki ?? [];
        
        return array_map(function ($photo, $index) use ($captions) {
            return [
                'foto' => $photo,
                'keterangan' => $captions[$index] ?? null,
            ];
        }, $photos, array_keys($photos));
    }

    /**
     * Get foto perempuan dengan keterangan (untuk view)
     */
    public function getFotoPerempuanDataAttribute(): array
    {
        $photos = $this->foto_perempuan ?? [];
        $captions = $this->keterangan_foto_perempuan ?? [];
        
        return array_map(function ($photo, $index) use ($captions) {
            return [
                'foto' => $photo,
                'keterangan' => $captions[$index] ?? null,
            ];
        }, $photos, array_keys($photos));
    }

    /**
     * Get foto laki dengan keterangan
     */
    public function getFotoLakiWithCaptionsAttribute(): array
    {
        $photos = $this->foto_laki ?? [];
        $captions = $this->keterangan_foto_laki ?? [];
        
        return array_map(function ($photo, $index) use ($captions) {
            return [
                'url' => Storage::disk('public')->url($photo),
                'path' => $photo,
                'caption' => $captions[$index] ?? null,
            ];
        }, $photos, array_keys($photos));
    }

    /**
     * Get foto perempuan dengan keterangan
     */
    public function getFotoPerempuanWithCaptionsAttribute(): array
    {
        $photos = $this->foto_perempuan ?? [];
        $captions = $this->keterangan_foto_perempuan ?? [];
        
        return array_map(function ($photo, $index) use ($captions) {
            return [
                'url' => Storage::disk('public')->url($photo),
                'path' => $photo,
                'caption' => $captions[$index] ?? null,
            ];
        }, $photos, array_keys($photos));
    }
}
