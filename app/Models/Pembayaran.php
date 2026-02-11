<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Pembayaran
 * 
 * Menyimpan data pembayaran pendaftaran calon siswa
 * File bukti pembayaran disimpan di: storage/app/public/spmb/pembayaran/
 */
class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    /**
     * Status pembayaran
     */
    const STATUS_PENDING = 'pending';
    const STATUS_VERIFIED = 'verified';
    const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'calon_siswa_id',
        'jumlah',
        'bukti_pembayaran',
        'status',
        'catatan_admin',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'verified_at' => 'datetime',
    ];

    /**
     * Daftar status pembayaran
     */
    public static function getStatusList(): array
    {
        return [
            self::STATUS_PENDING => 'Menunggu Verifikasi',
            self::STATUS_VERIFIED => 'Terverifikasi',
            self::STATUS_REJECTED => 'Ditolak',
        ];
    }

    /**
     * Get status badge color
     */
    public static function getStatusColor(string $status): string
    {
        return match($status) {
            self::STATUS_PENDING => 'amber',
            self::STATUS_VERIFIED => 'emerald',
            self::STATUS_REJECTED => 'red',
            default => 'slate',
        };
    }

    /**
     * Relasi ke CalonSiswa
     */
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }

    /**
     * Relasi ke Admin (verifier)
     */
    public function verifiedBy()
    {
        return $this->belongsTo(Admin::class, 'verified_by');
    }

    /**
     * Cek apakah pembayaran sudah diverifikasi
     */
    public function isVerified(): bool
    {
        return $this->status === self::STATUS_VERIFIED;
    }

    /**
     * Cek apakah pembayaran masih pending
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Cek apakah pembayaran ditolak
     */
    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return self::getStatusList()[$this->status] ?? $this->status;
    }

    /**
     * Get status badge color attribute
     */
    public function getStatusColorAttribute(): string
    {
        return self::getStatusColor($this->status);
    }

    /**
     * Mendapatkan URL file bukti pembayaran
     */
    public function getBuktiUrlAttribute(): string
    {
        return asset('storage/' . $this->bukti_pembayaran);
    }

    /**
     * Mendapatkan full path file bukti pembayaran
     */
    public function getBuktiFullPathAttribute(): string
    {
        return storage_path('app/public/' . $this->bukti_pembayaran);
    }

    /**
     * Format jumlah pembayaran ke Rupiah
     */
    public function getJumlahFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }

    /**
     * Mendapatkan ukuran file dalam format readable
     */
    public function getBuktiFileSize(): string
    {
        $path = $this->bukti_full_path;
        
        if (!file_exists($path)) {
            return '-';
        }
        
        $bytes = filesize($path);
        
        if ($bytes === 0) return '0 Bytes';
        
        $k = 1024;
        $sizes = ['Bytes', 'KB', 'MB'];
        $i = floor(log($bytes) / log($k));
        
        return round($bytes / pow($k, $i), 2) . ' ' . $sizes[$i];
    }

    /**
     * Cek apakah file bukti ada
     */
    public function buktiExists(): bool
    {
        return file_exists($this->bukti_full_path);
    }
}
