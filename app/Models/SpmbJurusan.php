<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmbJurusan extends Model
{
    use HasFactory;

    protected $table = 'spmb_jurusan';

    protected $fillable = [
        'kode',
        'nama',
        'logo',
        'gambar',
        'warna_border',
        'warna_bg',
        'warna_text',
        'warna_hover',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    /**
     * Scope untuk jurusan aktif
     */
    public function scopeActive($query)
    {
        return $query->where('aktif', true);
    }

    /**
     * Scope untuk urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    /**
     * Get logo URL
     */
    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return asset('images/logo/default.jpeg');
        }
        
        if (str_starts_with($this->logo, 'http')) {
            return $this->logo;
        }
        
        if (str_starts_with($this->logo, 'images/')) {
            return asset($this->logo);
        }
        
        return asset('storage/' . $this->logo);
    }

    /**
     * Get gambar URL
     */
    public function getGambarUrlAttribute()
    {
        if (!$this->gambar) {
            return asset('images/default-jurusan.png');
        }
        
        if (str_starts_with($this->gambar, 'http')) {
            return $this->gambar;
        }
        
        if (str_starts_with($this->gambar, 'images/')) {
            return asset($this->gambar);
        }
        
        return asset('storage/' . $this->gambar);
    }
}
