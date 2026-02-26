<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Kajur extends Authenticatable
{
    use HasFactory;

    protected $table = 'kajur';

    protected $fillable = [
        'nama',
        'username',
        'password',
        'jurusan_id',
        'aktif',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    /**
     * Relasi ke jurusan
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Scope untuk kajur aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }
}
