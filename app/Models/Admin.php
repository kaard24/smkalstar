<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Model Admin
 * 
 * Digunakan untuk autentikasi admin dengan guard 'admin'
 */
class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin';

    protected $fillable = [
        'username',
        'name',
        'avatar',
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
     * Mendapatkan password untuk autentikasi
     */
    public function getAuthPassword(): string
    {
        return $this->password ?? '';
    }
}
