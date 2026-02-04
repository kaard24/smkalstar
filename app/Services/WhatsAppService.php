<?php

namespace App\Services;

use App\Models\LogWhatsapp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * WhatsApp Service untuk mengirim notifikasi via WhatsApp
 */
class WhatsAppService
{
    protected string $apiUrl;
    protected string $apiKey;

    public function __construct()
    {
        // Configure these in .env file
        $this->apiUrl = config('services.whatsapp.api_url', 'https://api.whatsapp-gateway.example.com/send');
        $this->apiKey = config('services.whatsapp.api_key', 'dummy-api-key');
    }

    /**
     * Send a WhatsApp message
     */
    public function sendMessage(string $noWa, string $message): bool
    {
        // Normalize phone number (ensure it starts with 62)
        $noWa = $this->normalizePhoneNumber($noWa);

        // Log the message first
        $log = $this->logMessage($noWa, $message, 'Pending');

        try {
            // DUMMY IMPLEMENTATION - Always succeeds
            // Replace with actual WhatsApp Gateway API call when integrating
            Log::info('WhatsApp Message Sent (DUMMY)', [
                'no_wa' => $noWa,
                'message' => $message,
            ]);

            $log->update([
                'status_kirim' => 'Terkirim',
                'waktu_kirim' => Carbon::now(),
            ]);
            return true;

        } catch (\Exception $e) {
            Log::error('WhatsApp Gateway Exception', [
                'error' => $e->getMessage(),
                'no_wa' => $noWa,
            ]);

            $log->update(['status_kirim' => 'Gagal']);
            return false;
        }
    }

    /**
     * Send OTP message
     */
    public function sendOtp(string $noWa, string $otp): bool
    {
        $message = "Kode OTP SPMB SMK Al-Hidayah Lestari: {$otp}. Berlaku 5 menit. Jangan bagikan ke siapapun.";
        return $this->sendMessage($noWa, $message);
    }

    /**
     * Send graduation notification
     */
    public function sendKelulusanNotification(string $noWa, string $nama, string $status, array $nilai = []): bool
    {
        $message = "Assalamualaikum, Ananda {$nama}.\n\n";
        $message .= "Berdasarkan hasil seleksi SPMB SMK Al-Hidayah Lestari, Anda dinyatakan: {$status}.\n\n";
        
        if (!empty($nilai)) {
            $message .= "Rincian Nilai:\n";
            if (isset($nilai['btq'])) $message .= "- BTQ: {$nilai['btq']}\n";
            if (isset($nilai['minat'])) $message .= "- Minat Bakat: {$nilai['minat']}\n";
            if (isset($nilai['kejuruan'])) $message .= "- Kejuruan: {$nilai['kejuruan']}\n";
            $message .= "\n";
        }
        
        $message .= "Silakan cek detail pengumuman di website resmi.";

        return $this->sendMessage($noWa, $message);
    }

    /**
     * Send verification notification
     */
    public function sendVerifikasiNotification(string $noWa, string $nama, string $status): bool
    {
        $statusText = $status === 'verified' ? 'TERVERIFIKASI' : 'BELUM LENGKAP';
        $message = "Assalamualaikum, Ananda {$nama}. Berkas pendaftaran SPMB Anda telah {$statusText}. Silakan cek status di website resmi.";

        return $this->sendMessage($noWa, $message);
    }

    /**
     * Log message to database
     */
    protected function logMessage(string $noWa, string $message, string $status): LogWhatsapp
    {
        return LogWhatsapp::create([
            'no_tujuan' => $noWa,
            'pesan' => $message,
            'status_kirim' => $status,
            'waktu_kirim' => null,
        ]);
    }

    /**
     * Normalize phone number to 62xxx format
     */
    protected function normalizePhoneNumber(string $phone): string
    {
        // Remove any non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Convert 08xxx to 628xxx
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        // Add 62 if not present
        if (!str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }

        return $phone;
    }
}
