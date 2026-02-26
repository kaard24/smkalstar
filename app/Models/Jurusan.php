<?php

namespace App\Models;

use App\Traits\ClearsCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory, ClearsCache;

    protected $table = 'jurusan';

    protected $fillable = [
        'kode',
        'nama',
        'kategori',
        'deskripsi',
        'deskripsi_lengkap',
        'gambar',
        'logo',
        'peluang_karir',
        'deskripsi_peluang_karir',
        'kompetensi',
        'deskripsi_kompetensi',
        'mata_pelajaran',
        'deskripsi_mata_pelajaran',
        'durasi',
        'sertifikasi',
        'prakerin',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'peluang_karir' => 'array',
        'kompetensi' => 'array',
        'mata_pelajaran' => 'array',
        'aktif' => 'boolean',
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    /**
     * Relasi ke info program (dinamis)
     */
    public function infoProgram()
    {
        return $this->hasMany(JurusanInfo::class)->orderBy('urutan');
    }

    /**
     * Relasi ke detail items (kompetensi, mapel, karir dengan judul + deskripsi)
     */
    public function detailItems()
    {
        return $this->hasMany(JurusanDetailItem::class)->orderBy('urutan');
    }

    public function kompetensiItems()
    {
        return $this->hasMany(JurusanDetailItem::class)->where('tipe', 'kompetensi')->orderBy('urutan');
    }

    public function mapelItems()
    {
        return $this->hasMany(JurusanDetailItem::class)->where('tipe', 'mapel')->orderBy('urutan');
    }

    public function karirItems()
    {
        return $this->hasMany(JurusanDetailItem::class)->where('tipe', 'karir')->orderBy('urutan');
    }

    /**
     * Relasi ke kegiatan jurusan
     */
    public function kegiatan()
    {
        return $this->hasMany(JurusanKegiatan::class)->orderBy('urutan');
    }

    /**
     * Scope untuk jurusan aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    /**
     * Scope untuk urutan
     */
    public function scopeUrut($query)
    {
        return $query->orderBy('urutan');
    }

    /**
     * Get gambar URL
     */
    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) {
            return null;
        }
        
        if (str_starts_with($this->gambar, 'http')) {
            return $this->gambar;
        }
        
        // If path starts with 'images/', it's in public folder
        if (str_starts_with($this->gambar, 'images/')) {
            return asset($this->gambar);
        }
        
        // Otherwise assume it's in storage
        return asset('storage/' . $this->gambar);
    }

    /**
     * Get logo URL
     */
    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return null;
        }
        
        if (str_starts_with($this->logo, 'http')) {
            return $this->logo;
        }
        
        // If path starts with 'images/', it's in public folder
        if (str_starts_with($this->logo, 'images/')) {
            return asset($this->logo);
        }
        
        // Otherwise assume it's in storage
        return asset('storage/' . $this->logo);
    }

    /**
     * Get cache key to clear
     */
    public function getCacheKey()
    {
        return 'jurusan_aktif';
    }
}
