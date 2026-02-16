<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KomentarBerita extends Model
{
    use HasFactory;

    protected $table = 'komentar_berita';

    protected $fillable = [
        'berita_id',
        'user_id',
        'username',
        'komentar',
        'show_username',
        'is_approved',
    ];

    protected $casts = [
        'show_username' => 'boolean',
        'is_approved' => 'boolean',
    ];

    /**
     * Get the berita that owns the comment
     */
    public function berita(): BelongsTo
    {
        return $this->belongsTo(Berita::class, 'berita_id');
    }

    /**
     * Get display name (username or "Anonim")
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->show_username ? $this->username : 'Anonim';
    }
}
