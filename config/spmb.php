<?php

/**
 * Konfigurasi SPMB (Sistem Penerimaan Murid Baru)
 */

return [
    /**
     * Biaya pendaftaran dalam Rupiah
     */
    'biaya_pendaftaran' => env('SPMB_BIAYA_PENDAFTARAN', 50000),

    /**
     * Informasi rekening sekolah untuk pembayaran
     */
    'rekening_bank' => env('SPMB_REKENING_BANK', 'Bank DKI/Jakarta'),
    'rekening_nomor' => env('SPMB_REKENING_NOMOR', '61112000900'),
    'rekening_atas_nama' => env('SPMB_REKENING_ATAS_NAMA', 'SMK Al Hidayah Lestari'),

    /**
     * Rekening tujuan untuk pembayaran (multiple)
     */
    'rekening_tujuan' => [
        [
            'nama_bank' => env('SPMB_REKENING_BANK', 'Bank DKI/Jakarta'),
            'no_rekening' => env('SPMB_REKENING_NOMOR', '61112000900'),
            'atas_nama' => env('SPMB_REKENING_ATAS_NAMA', 'SMK Al Hidayah Lestari'),
        ],
    ],

    /**
     * Metode pembayaran yang tersedia
     */
    'metode_pembayaran' => [
        'Transfer Bank',
        'Setor Tunai',
        'E-Wallet',
    ],

    /**
     * Tahun ajaran pendaftaran
     */
    'tahun_ajaran' => env('SPMB_TAHUN_AJARAN', '2026/2027'),
];
