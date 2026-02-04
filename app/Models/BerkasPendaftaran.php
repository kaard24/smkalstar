<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model BerkasPendaftaran
 * 
 * Menyimpan dokumen-dokumen yang diupload oleh calon siswa
 * File disimpan di: storage/app/spmb/berkas/{nisn}/
 */
class BerkasPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'berkas_pendaftaran';

    /**
     * Jenis berkas yang dapat diupload
     * SKL dan Ijazah digabung menjadi satu kategori
     */
    const JENIS_KK = 'KK';
    const JENIS_AKTA = 'AKTA';
    const JENIS_SKL_IJAZAH = 'SKL_IJAZAH'; // Gabungan SKL atau Ijazah

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
     * SKL dan Ijazah digabung - siswa cukup upload salah satu
     */
    public static function getJenisBerkas(): array
    {
        return [
            self::JENIS_KK => 'Kartu Keluarga',
            self::JENIS_AKTA => 'Akta Kelahiran',
            self::JENIS_SKL_IJAZAH => 'SKL atau Ijazah',
        ];
    }

    /**
     * Keterangan tambahan untuk SKL/Ijazah
     */
    public static function getKeteranganJenis(string $jenis): string
    {
        $keterangan = [
            self::JENIS_KK => 'Scan Kartu Keluarga yang masih berlaku',
            self::JENIS_AKTA => 'Scan Akta Kelahiran',
            self::JENIS_SKL_IJAZAH => 'Upload SKL (jika belum lulus) atau Ijazah (jika sudah lulus)',
        ];
        
        return $keterangan[$jenis] ?? '';
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
     * Mendapatkan full path file di storage (gunakan disk public)
     */
    public function getFullPathAttribute(): string
    {
        return storage_path('app/public/' . $this->path_file);
    }
    
    /**
     * Mendapatkan URL file (gunakan disk public)
     */
    public function getFileUrlAttribute(): string
    {
        return asset('storage/' . $this->path_file);
    }

    /**
     * Mendapatkan progress upload berkas dalam persen
     */
    public static function getUploadProgress(int $calonSiswaId): array
    {
        $totalBerkas = count(self::getJenisBerkas());
        $uploadedBerkas = self::where('calon_siswa_id', $calonSiswaId)->count();
        
        $percentage = $totalBerkas > 0 ? (int) round(($uploadedBerkas / $totalBerkas) * 100) : 0;
        
        // Get detail per jenis berkas
        $uploadedTypes = self::where('calon_siswa_id', $calonSiswaId)
            ->pluck('jenis_berkas')
            ->toArray();
        
        $detail = [];
        foreach (self::getJenisBerkas() as $key => $label) {
            $detail[$key] = [
                'label' => $label,
                'uploaded' => in_array($key, $uploadedTypes),
                'keterangan' => self::getKeteranganJenis($key),
            ];
        }
        
        return [
            'percentage' => $percentage,
            'uploaded' => $uploadedBerkas,
            'total' => $totalBerkas,
            'is_complete' => $uploadedBerkas === $totalBerkas,
            'detail' => $detail,
        ];
    }

    /**
     * Cek apakah semua berkas sudah diupload
     */
    public static function isAllUploaded(int $calonSiswaId): bool
    {
        $progress = self::getUploadProgress($calonSiswaId);
        return $progress['is_complete'];
    }

    /**
     * Mendapatkan ukuran file dalam format readable (KB/MB)
     */
    public function getFileSize(): string
    {
        $path = $this->path_file;
        $fullPath = storage_path('app/public/' . $path);
        
        if (!file_exists($fullPath)) {
            return '-';
        }
        
        $bytes = filesize($fullPath);
        
        if ($bytes === 0) return '0 Bytes';
        
        $k = 1024;
        $sizes = ['Bytes', 'KB', 'MB'];
        $i = floor(log($bytes) / log($k));
        
        return round($bytes / pow($k, $i), 2) . ' ' . $sizes[$i];
    }
}
