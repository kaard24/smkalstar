<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpmbBiaya extends Model
{
    protected $table = 'spmb_biaya';

    protected $fillable = [
        'gelombang_id',
        'nama',
        'nominal',
        'keterangan',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'nominal' => 'integer',
        'aktif' => 'boolean',
        'urutan' => 'integer',
    ];

    public function gelombang(): BelongsTo
    {
        return $this->belongsTo(SpmbGelombang::class, 'gelombang_id');
    }

    public function scopeActive($query)
    {
        return $query->where('aktif', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('id');
    }

    public function scopeGlobal($query)
    {
        return $query->whereNull('gelombang_id');
    }

    public function getNominalFormattedAttribute(): string
    {
        return 'Rp ' . number_format($this->nominal, 0, ',', '.');
    }
}
