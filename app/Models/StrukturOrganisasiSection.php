<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StrukturOrganisasiSection extends Model
{
    use HasFactory;

    protected $table = 'struktur_organisasi_sections';

    protected $fillable = [
        'nama',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the members of this section
     */
    public function members(): HasMany
    {
        return $this->hasMany(StrukturOrganisasiMember::class, 'section_id')->orderBy('urutan');
    }

    /**
     * Get only active members
     */
    public function activeMembers(): HasMany
    {
        return $this->members()->where('is_active', true);
    }

    /**
     * Scope for active sections
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
}
