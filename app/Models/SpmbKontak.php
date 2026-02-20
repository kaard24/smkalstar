<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpmbKontak extends Model
{
    protected $table = 'spmb_kontak';

    protected $fillable = [
        'nama',
        'jabatan',
        'telepon',
        'whatsapp',
        'email',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'urutan' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('aktif', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }

    public function getWhatsappLinkAttribute(): string
    {
        $wa = preg_replace('/[^0-9]/', '', $this->whatsapp);
        return 'https://wa.me/62' . ltrim($wa, '0');
    }

    public function getTeleponFormattedAttribute(): string
    {
        if (!$this->telepon) return '-';
        // Format: 0812-3456-7890
        $telp = preg_replace('/[^0-9]/', '', $this->telepon);
        if (strlen($telp) === 11) {
            return substr($telp, 0, 4) . '-' . substr($telp, 4, 4) . '-' . substr($telp, 8);
        }
        return $this->telepon;
    }
}
