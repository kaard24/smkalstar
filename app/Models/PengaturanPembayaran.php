<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Pengaturan Pembayaran
 * 
 * Menyimpan pengaturan pembayaran SPMB seperti:
 * - Nama penerima transfer
 * - Biaya pendaftaran
 * - Keterangan tambahan
 */
class PengaturanPembayaran extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_pembayaran';

    protected $fillable = [
        'nama_penerima',
        'nomor_rekening',
        'bank',
        'biaya',
        'keterangan',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'biaya' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Get info rekening lengkap
     */
    public function getInfoRekeningAttribute(): string
    {
        $info = [];
        if ($this->bank) {
            $info[] = $this->bank;
        }
        if ($this->nomor_rekening) {
            $info[] = $this->nomor_rekening;
        }
        return implode(' - ', $info) ?: '-';
    }

    /**
     * Relasi ke Admin (creator)
     */
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    /**
     * Relasi ke Admin (updater)
     */
    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    /**
     * Format biaya ke Rupiah
     */
    public function getBiayaFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->biaya, 0, ',', '.');
    }

    /**
     * Get pengaturan yang aktif
     */
    public static function getActive(): ?self
    {
        return self::where('is_active', true)->first();
    }

    /**
     * Nonaktifkan semua pengaturan lain ketika satu diaktifkan
     */
    protected static function booted()
    {
        static::saving(function ($pengaturan) {
            if ($pengaturan->is_active) {
                // Nonaktifkan pengaturan lain
                self::where('id', '!=', $pengaturan->id ?? 0)
                    ->update(['is_active' => false]);
            }
        });
    }
}
