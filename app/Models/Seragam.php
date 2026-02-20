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
        'keterangan',
        'warna_tema',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * Get foto laki URL
     */
    public function getFotoLakiUrlAttribute(): ?string
    {
        if ($this->foto_laki) {
            return Storage::disk('public')->url($this->foto_laki);
        }
        return null;
    }

    /**
     * Get foto perempuan URL
     */
    public function getFotoPerempuanUrlAttribute(): ?string
    {
        if ($this->foto_perempuan) {
            return Storage::disk('public')->url($this->foto_perempuan);
        }
        return null;
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
}
