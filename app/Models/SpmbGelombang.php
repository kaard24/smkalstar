<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class SpmbGelombang extends Model
{
    protected $table = 'spmb_gelombang';

    protected $fillable = [
        'nama',
        'nomor',
        'tahun_ajaran',
        'pendaftaran_start',
        'pendaftaran_end',
        'tes_mulai',
        'tes_selesai',
        'pengumuman',
        'status',
        'aktif',
        'urutan',
    ];

    protected $casts = [
        'pendaftaran_start' => 'date',
        'pendaftaran_end' => 'date',
        'tes_mulai' => 'date',
        'tes_selesai' => 'date',
        'pengumuman' => 'date',
        'aktif' => 'boolean',
        'urutan' => 'integer',
        'nomor' => 'integer',
    ];

    // Relationships
    public function alur(): HasMany
    {
        return $this->hasMany(SpmbAlur::class, 'gelombang_id')->orderBy('urutan');
    }

    public function persyaratan(): HasMany
    {
        return $this->hasMany(SpmbPersyaratan::class, 'gelombang_id')->orderBy('urutan');
    }

    public function biaya(): HasMany
    {
        return $this->hasMany(SpmbBiaya::class, 'gelombang_id')->orderBy('urutan');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('aktif', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }

    // Status Methods
    public function getStatusPendaftaranAttribute(): string
    {
        $now = now();
        if ($now->lt($this->pendaftaran_start)) return 'MENDATANG';
        if ($now->between($this->pendaftaran_start, $this->pendaftaran_end)) return 'BERLANGSUNG';
        return 'SELESAI';
    }

    public function getStatusTesAttribute(): string
    {
        $now = now();
        if ($now->lt($this->tes_mulai)) return 'MENDATANG';
        if ($now->between($this->tes_mulai, $this->tes_selesai)) return 'BERLANGSUNG';
        return 'SELESAI';
    }

    public function getStatusPengumumanAttribute(): string
    {
        $now = now();
        return $now->lt($this->pengumuman) ? 'MENDATANG' : 'SELESAI';
    }

    public function getIsAktifAttribute(): bool
    {
        $now = now();
        return $now->between($this->pendaftaran_start, $this->pengumuman);
    }

    public function getSisaHariPendaftaranAttribute(): int
    {
        $now = now();
        if ($now->gt($this->pendaftaran_end)) return 0;
        return ceil($now->diffInDays($this->pendaftaran_end, false));
    }

    public function getStatusColorAttribute(): array
    {
        $status = $this->status_pendaftaran;
        return match($status) {
            'BERLANGSUNG' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'border' => 'border-blue-200', 'icon' => 'text-blue-500'],
            'SELESAI' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'border' => 'border-green-200', 'icon' => 'text-green-500'],
            default => ['bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'border' => 'border-gray-200', 'icon' => 'text-gray-400'],
        };
    }
}
