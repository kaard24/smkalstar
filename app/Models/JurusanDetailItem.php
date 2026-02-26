<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanDetailItem extends Model
{
    use HasFactory;

    protected $table = 'jurusan_detail_items';

    protected $fillable = [
        'jurusan_id',
        'tipe',
        'judul',
        'deskripsi',
        'urutan',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
