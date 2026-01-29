<?php

namespace App\Services;

use App\Models\LogWhatsapp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappGatewayService
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
            // TODO: Replace with actual WhatsApp Gateway API call
            // Example implementation for Fonnte, Wablas, or similar services:
            
            /*
            $response = Http::withHeaders([
                'Authorization' => $this->apiKey,
            ])->post($this->apiUrl, [
                'target' => $noWa,
                'message' => $message,
            ]);

            if ($response->successful()) {
                $log->update(['status_kirim' => 'Terkirim']);
                return true;
            }

            $log->update(['status_kirim' => 'Gagal']);
            Log::error('WhatsApp Gateway Error', [
                'response' => $response->body(),
                'no_wa' => $noWa,
            ]);
            return false;
            */

            // DUMMY IMPLEMENTATION - Always succeeds
            // Remove this block and uncomment above when integrating real gateway
            Log::info('WhatsApp OTP Sent (DUMMY)', [
                'no_wa' => $noWa,
                'message' => $message,
            ]);

            $log->update(['status_kirim' => 'Terkirim']);
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
        $message = "Kode OTP PPDB SMK Al-Hidayah Lestari: {$otp}. Berlaku 5 menit. Jangan bagikan ke siapapun.";
        return $this->sendMessage($noWa, $message);
    }

    /**
     * Send graduation notification
     */
    public function sendKelulusanNotification(string $noWa, string $nama, string $status, array $nilai = []): bool
    {
        $message = "Assalamualaikum, Ananda {$nama}. Berdasarkan hasil seleksi PPDB SMK Al-Hidayah Lestari, dinyatakan {$status}. Silakan cek detail nilai dan pengumuman di website resmi.";

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
            'waktu_kirim' => Carbon::now(),
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
