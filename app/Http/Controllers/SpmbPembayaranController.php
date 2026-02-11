<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\BerkasPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpmbPembayaranController extends Controller
{
    /**
     * Display pembayaran page for siswa.
     */
    public function index()
    {
        $siswa = auth('spmb')->user();
        $pembayaran = $siswa->pembayaran;
        
        // Cek apakah berkas sudah lengkap (untuk informasi saja, tidak wajib)
        $berkasProgress = BerkasPendaftaran::getUploadProgress($siswa->id);
        $berkasLengkap = $berkasProgress['is_complete'];
        
        // Ambil biaya pendaftaran dari config
        $biayaPendaftaran = config('spmb.biaya_pendaftaran', 250000);
        
        return view('spmb.pembayaran', compact('siswa', 'pembayaran', 'berkasLengkap', 'biayaPendaftaran'));
    }

    /**
     * Store or update pembayaran.
     */
    public function store(Request $request)
    {
        $siswa = auth('spmb')->user();
        $pembayaran = $siswa->pembayaran;
        
        $validated = $request->validate([
            'bukti_pembayaran' => $pembayaran && $pembayaran->bukti_pembayaran ? 'nullable|image|mimes:jpeg,png,jpg|max:2048' : 'required|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string|max:255',
        ], [
            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diupload.',
            'bukti_pembayaran.image' => 'Bukti pembayaran harus berupa gambar.',
            'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berformat jpeg, png, atau jpg.',
            'bukti_pembayaran.max' => 'Ukuran bukti pembayaran maksimal 2MB.',
        ]);

        try {
            $data = [
                'jumlah' => config('spmb.biaya_pendaftaran', 250000),
                'status' => Pembayaran::STATUS_PENDING,
                'catatan_admin' => $validated['catatan'] ?? null,
            ];

            // Handle bukti pembayaran upload
            if ($request->hasFile('bukti_pembayaran')) {
                // Hapus file lama jika ada
                if ($pembayaran && $pembayaran->bukti_pembayaran) {
                    Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
                }
                
                $path = $request->file('bukti_pembayaran')->store('spmb/pembayaran', 'public');
                $data['bukti_pembayaran'] = $path;
            }

            Pembayaran::updateOrCreate(
                ['calon_siswa_id' => $siswa->id],
                $data
            );

            return redirect()->route('spmb.pembayaran')
                ->with('success', 'Bukti pembayaran berhasil diupload. Mohon tunggu verifikasi dari admin.');
        } catch (\Exception $e) {
            return redirect()->route('spmb.pembayaran')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Download bukti pembayaran.
     */
    public function download($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
        // Cek akses: hanya pemilik atau admin yang bisa download
        if (auth('spmb')->check() && $pembayaran->calon_siswa_id !== auth('spmb')->id()) {
            abort(403, 'Unauthorized access.');
        }
        
        if (!$pembayaran->bukti_pembayaran || !Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
            abort(404, 'File not found.');
        }
        
        return Storage::disk('public')->download($pembayaran->bukti_pembayaran, 'bukti-pembayaran-' . $pembayaran->calonSiswa->nisn . '.' . pathinfo($pembayaran->bukti_pembayaran, PATHINFO_EXTENSION));
    }

    /**
     * Preview bukti pembayaran.
     */
    public function preview($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
        // Cek akses: hanya pemilik atau admin yang bisa preview
        if (auth('spmb')->check() && $pembayaran->calon_siswa_id !== auth('spmb')->id()) {
            abort(403, 'Unauthorized access.');
        }
        
        if (!$pembayaran->bukti_pembayaran || !Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
            abort(404, 'File not found.');
        }
        
        return response()->file(storage_path('app/public/' . $pembayaran->bukti_pembayaran));
    }
}
