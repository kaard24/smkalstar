<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class AdminVerifikasiController extends Controller
{
    public function index()
    {
        // Get applicants needing verification
        $pendaftar = Pendaftaran::with(['calonSiswa', 'jurusan'])
            ->where('status_pendaftaran', 'Terdaftar')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.verifikasi', compact('pendaftar'));
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['calonSiswa', 'jurusan', 'calonSiswa.orangTua'])
            ->findOrFail($id);
            
        return view('admin.verifikasi', compact('pendaftaran'));
    }
    
    public function verify(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        
        $pendaftaran->update([
            'status_pendaftaran' => 'Diverifikasi'
        ]);
        
        return redirect()->route('admin.verifikasi.index')
            ->with('success', 'Dokumen berhasil diverifikasi.');
    }
}
