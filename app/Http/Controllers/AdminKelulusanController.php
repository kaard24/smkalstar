<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Tes;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class AdminKelulusanController extends Controller
{
    protected $whatsappService;

    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function index()
    {
        // Get applicants who have completed tests
        $pendaftar = Pendaftaran::with(['calonSiswa', 'jurusan', 'tes'])
            ->where('status_pendaftaran', 'Selesai Tes')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.kelulusan', compact('pendaftar'));
    }
    
    public function sendNotification($id)
    {
        $pendaftaran = Pendaftaran::with(['calonSiswa', 'tes'])->findOrFail($id);
        
        if ($pendaftaran->tes && $pendaftaran->tes->status_kelulusan !== 'Pending') {
            $this->whatsappService->sendKelulusanNotification(
                $pendaftaran->calonSiswa->no_wa,
                $pendaftaran->calonSiswa->nama,
                strtoupper($pendaftaran->tes->status_kelulusan)
            );
            
            return redirect()->back()
                ->with('success', 'Notifikasi WhatsApp berhasil dikirim.');
        }
        
        return redirect()->back()
            ->with('error', 'Status kelulusan belum ditentukan.');
    }
}
