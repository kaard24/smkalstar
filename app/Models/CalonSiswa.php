<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model CalonSiswa
 * 
 * Model untuk calon siswa yang mendaftar SPMB
 * Login menggunakan NISN + Password
 */
class CalonSiswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'calon_siswa';

    protected $fillable = [
        'nisn',
        'nik',
        'no_kk',
        'nama',
        'jk',
        'tempat_lahir',
        'tgl_lahir',
        'alamat',
        'no_wa',
        'asal_sekolah',
        'alamat_sekolah',
        'password',
        'foto',
        'agama',
        'golongan_darah',
        'anak_ke',
        'jumlah_saudara',
        'tinggi_badan',
        'berat_badan',
        'riwayat_penyakit',
        'npsn_sekolah',
        'minat_bakat',
    ];

    /**
     * Atribut yang disembunyikan saat serialisasi
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut
     */
    protected $casts = [
        'tgl_lahir' => 'date',
        'anak_ke' => 'integer',
        'jumlah_saudara' => 'integer',
        'tinggi_badan' => 'integer',
        'berat_badan' => 'integer',
    ];

    /**
     * Mendapatkan password untuk autentikasi
     */
    public function getAuthPassword(): string
    {
        return $this->password ?? '';
    }

    /**
     * Mendapatkan nama kolom untuk remember token
     */
    public function getRememberTokenName(): string
    {
        return 'remember_token';
    }

    /**
     * Relasi ke OrangTua
     */
    public function orangTua()
    {
        return $this->hasOne(OrangTua::class);
    }

    /**
     * Relasi ke Pendaftaran
     */
    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }

    /**
     * Relasi ke BerkasPendaftaran
     */
    public function berkasPendaftaran()
    {
        return $this->hasMany(BerkasPendaftaran::class);
    }

    /**
     * Relasi ke Pembayaran (hasOne)
     */
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    /**
     * Mencari siswa berdasarkan NISN
     */
    public static function findByNisn(string $nisn): ?self
    {
        return static::where('nisn', $nisn)->first();
    }

    /**
     * Mendapatkan URL foto profil
     */
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(public_path('storage/foto/' . $this->foto))) {
            return asset('storage/foto/' . $this->foto);
        }
        // Default avatar based on gender
        return $this->jk === 'P' 
            ? asset('images/avatar-female.svg') 
            : asset('images/avatar-male.svg');
    }

    /**
     * Cek apakah data pendaftaran sudah lengkap
     */
    public function isRegistrationComplete(): bool
    {
        return !empty($this->nama) 
            && !empty($this->jk) 
            && !empty($this->tempat_lahir)
            && !empty($this->tgl_lahir)
            && !empty($this->alamat)
            && !empty($this->asal_sekolah);
    }

    /**
     * Mendapatkan status lengkap pendaftaran
     */
    public function getRegistrationStatus(): array
    {
        $pendaftaran = $this->pendaftaran;
        $tes = $pendaftaran?->tes;

        return [
            'is_complete' => $this->isRegistrationComplete(),
            'status_pendaftaran' => $pendaftaran?->status_pendaftaran ?? 'Belum Lengkap',
            'status_berkas' => $this->getStatusBerkas(),
            'has_tes' => $tes !== null,
            'nilai_btq' => $tes?->nilai_btq,
            'nilai_minat_bakat' => $tes?->nilai_minat_bakat,
            'status_kelulusan' => $tes?->status_kelulusan ?? 'Pending',
        ];
    }

    /**
     * Mendapatkan status verifikasi berkas (diubah untuk tracking upload saja)
     */
    public function getStatusBerkas(): string
    {
        $progress = BerkasPendaftaran::getUploadProgress($this->id);
        
        if ($progress['uploaded'] === 0) {
            return 'Belum Upload';
        }

        if ($progress['is_complete']) {
            return 'Lengkap';
        }

        return 'Proses Upload (' . $progress['uploaded'] . '/' . $progress['total'] . ')';
    }

    /**
     * Cek apakah siswa sudah menyelesaikan semua tahapan
     */
    public function isSelesai(): bool
    {
        return BerkasPendaftaran::isAllUploaded($this->id);
    }

    /**
     * Mendapatkan status lengkap untuk timeline
     */
    public function getStatusDetail(): array
    {
        $pendaftaran = $this->pendaftaran;
        $berkasProgress = BerkasPendaftaran::getUploadProgress($this->id);

        return [
            'biodata_lengkap' => $this->isRegistrationComplete(),
            'orang_tua_lengkap' => $this->orangTua !== null,
            'jurusan_terpilih' => $pendaftaran?->jurusan_id !== null,
            'berkas_progress' => $berkasProgress,
            'semua_berkas_uploaded' => $berkasProgress['is_complete'],
            'status_tes' => $berkasProgress['is_complete'] ? 'Menunggu Jadwal via WA' : 'Belum Siap',
        ];
    }
}

