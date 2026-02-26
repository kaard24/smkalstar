<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FooterSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'nama_sekolah',
        'tagline',
        'alamat',
        'telepon',
        'whatsapp',
        'whatsapp_link',
        'spmb_title',
        'spmb_description',
        'spmb_button_text',
        'spmb_button_link',
        'show_spmb',
    ];

    protected $casts = [
        'show_spmb' => 'boolean',
    ];

    public static function getSettings()
    {
        $settings = self::first();
        if (!$settings) {
            $settings = self::create([
                'nama_sekolah' => 'SMK Al-Hidayah Lestari',
                'tagline' => 'Mewujudkan generasi unggul, berakhlak mulia, dan siap kerja dengan kompetensi masa depan.',
                'alamat' => 'JL. KANA LESTARI BLOK K/I, Lb. Bulus, Jakarta Selatan 12440',
                'telepon' => '(021) 7661343',
                'whatsapp' => 'Chat Pak Kaffa',
                'whatsapp_link' => 'https://wa.me/628812489572',
                'spmb_title' => 'Info SPMB',
                'spmb_description' => 'Sistem Penerimaan Murid Baru tahun ajaran 2026/2027 telah dibuka.',
                'spmb_button_text' => 'Daftar Sekarang',
                'spmb_button_link' => '/spmb',
                'show_spmb' => true,
            ]);
        }
        return $settings;
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return Storage::disk('public')->url($this->logo);
        }
        return null;
    }
}
