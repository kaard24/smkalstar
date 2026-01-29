<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model CalonSiswa
 * 
 * Model untuk calon siswa yang mendaftar PPDB
 * Login menggunakan NISN + Password
 */
class CalonSiswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'calon_siswa';

    protected $fillable = [
        'nisn',
        'nama',
        'jk',
        'tgl_lahir',
        'alamat',
        'no_wa',
        'asal_sekolah',
        'password',
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
     * Mencari siswa berdasarkan NISN
     */
    public static function findByNisn(string $nisn): ?self
    {
        return static::where('nisn', $nisn)->first();
    }

    /**
     * Cek apakah data pendaftaran sudah lengkap
     */
    public function isRegistrationComplete(): bool
    {
        return !empty($this->nama) 
            && !empty($this->jk) 
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
     * Mendapatkan status verifikasi berkas
     */
    public function getStatusBerkas(): string
    {
        $berkas = $this->berkasPendaftaran;
        
        if ($berkas->isEmpty()) {
            return 'Belum Upload';
        }

        $pending = $berkas->where('status_verifikasi', BerkasPendaftaran::STATUS_PENDING)->count();
        $tidakValid = $berkas->where('status_verifikasi', BerkasPendaftaran::STATUS_TIDAK_VALID)->count();
        $valid = $berkas->where('status_verifikasi', BerkasPendaftaran::STATUS_VALID)->count();
        $total = count(BerkasPendaftaran::getJenisBerkas());

        if ($tidakValid > 0) {
            return 'Ada Berkas Tidak Valid';
        }

        if ($valid === $total) {
            return 'Semua Valid';
        }

        if ($pending > 0) {
            return 'Menunggu Verifikasi';
        }

        return 'Belum Lengkap';
    }
}

