<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model BerkasPendaftaran
 * 
 * Menyimpan dokumen-dokumen yang diupload oleh calon siswa
 * File disimpan di: storage/app/ppdb/berkas/{nisn}/
 */
class BerkasPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'berkas_pendaftaran';

    /**
     * Jenis berkas yang dapat diupload
     */
    const JENIS_KK = 'KK';
    const JENIS_AKTA = 'AKTA';
    const JENIS_SKL = 'SKL';
    const JENIS_IJAZAH = 'IJAZAH';

    /**
     * Status verifikasi berkas
     */
    const STATUS_PENDING = 'Pending';
    const STATUS_VALID = 'Valid';
    const STATUS_TIDAK_VALID = 'Tidak Valid';

    protected $fillable = [
        'calon_siswa_id',
        'jenis_berkas',
        'nama_file',
        'path_file',
        'status_verifikasi',
        'catatan_admin',
    ];

    /**
     * Daftar jenis berkas yang tersedia
     */
    public static function getJenisBerkas(): array
    {
        return [
            self::JENIS_KK => 'Kartu Keluarga',
            self::JENIS_AKTA => 'Akta Kelahiran',
            self::JENIS_SKL => 'Surat Keterangan Lulus',
            self::JENIS_IJAZAH => 'Ijazah',
        ];
    }

    /**
     * Daftar status verifikasi
     */
    public static function getStatusVerifikasi(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_VALID => 'Valid',
            self::STATUS_TIDAK_VALID => 'Tidak Valid',
        ];
    }

    /**
     * Relasi ke CalonSiswa
     */
    public function calonSiswa()
    {
        return $this->belongsTo(CalonSiswa::class);
    }

    /**
     * Cek apakah berkas sudah diverifikasi valid
     */
    public function isValid(): bool
    {
        return $this->status_verifikasi === self::STATUS_VALID;
    }

    /**
     * Cek apakah berkas masih pending
     */
    public function isPending(): bool
    {
        return $this->status_verifikasi === self::STATUS_PENDING;
    }

    /**
     * Cek apakah berkas tidak valid
     */
    public function isTidakValid(): bool
    {
        return $this->status_verifikasi === self::STATUS_TIDAK_VALID;
    }

    /**
     * Mendapatkan nama jenis berkas yang readable
     */
    public function getNamaJenisAttribute(): string
    {
        return self::getJenisBerkas()[$this->jenis_berkas] ?? $this->jenis_berkas;
    }

    /**
     * Mendapatkan full path file di storage
     */
    public function getFullPathAttribute(): string
    {
        return storage_path('app/' . $this->path_file);
    }
}
