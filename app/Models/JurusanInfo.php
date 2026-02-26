<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanInfo extends Model
{
    use HasFactory;

    protected $table = 'jurusan_info';

    protected $fillable = [
        'jurusan_id',
        'label',
        'value',
        'urutan',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
