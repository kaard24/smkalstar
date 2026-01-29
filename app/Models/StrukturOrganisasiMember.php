<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StrukturOrganisasiMember extends Model
{
    use HasFactory;

    protected $table = 'struktur_organisasi_members';

    protected $fillable = [
        'section_id',
        'foto',
        'nama',
        'keterangan',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the section that owns the member
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(StrukturOrganisasiSection::class, 'section_id');
    }

    /**
     * Scope for active members
     */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordering
     */
    public function scopeUrut($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }

    /**
     * Get the foto URL
     */
    public function getFotoUrlAttribute(): ?string
    {
        if (!$this->foto) {
            return null;
        }
        
        if (str_starts_with($this->foto, 'http')) {
            return $this->foto;
        }
        
        return asset('storage/' . $this->foto);
    }
}
