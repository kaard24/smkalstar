<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tes extends Model
{
    use HasFactory;

    protected $table = 'tes';

    protected $fillable = [
        'pendaftaran_id',
        'nilai_btq',
        'nilai_minat_bakat',
        'nilai_kejuruan',
        'status_btq',
        'status_wawancara',
        'status_kelulusan'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
