<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpmbPersyaratan extends Model
{
    protected $table = 'spmb_persyaratan';

    protected $fillable = [
        'gelombang_id',
        'nama',
        'keterangan',
        'wajib',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'wajib' => 'boolean',
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

    public function scopeWajib($query)
    {
        return $query->where('wajib', true);
    }

    public function scopeGlobal($query)
    {
        return $query->whereNull('gelombang_id');
    }
}
