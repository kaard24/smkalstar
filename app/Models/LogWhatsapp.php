<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogWhatsapp extends Model
{
    use HasFactory;

    protected $table = 'log_whatsapp';

    protected $fillable = [
        'no_tujuan',
        'pesan',
        'status_kirim',
        'waktu_kirim'
    ];
}
