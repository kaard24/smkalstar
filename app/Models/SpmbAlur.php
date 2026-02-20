<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpmbAlur extends Model
{
    protected $table = 'spmb_alur';

    protected $fillable = [
        'gelombang_id',
        'nomor',
        'judul',
        'deskripsi',
        'icon',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'urutan' => 'integer',
        'nomor' => 'integer',
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
}
