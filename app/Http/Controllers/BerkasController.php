<?php

namespace App\Http\Controllers;

use App\Models\BerkasPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

/**
 * Controller untuk mengelola upload dan verifikasi berkas pendaftaran
 */
class BerkasController extends Controller
{
    /**
     * Menampilkan halaman upload berkas siswa
     */
    public function index()
    {
        $siswa = Auth::guard('spmb')->user();
        $berkas = $siswa->berkasPendaftaran()->get()->keyBy('jenis_berkas');
        $jenisBerkas = BerkasPendaftaran::getJenisBerkas();

        return view('spmb.berkas', compact('siswa', 'berkas', 'jenisBerkas'));
    }

    /**
     * Upload berkas baru - Tanpa verifikasi admin
     */
    public function upload(Request $request)
    {
        $siswa = Auth::guard('spmb')->user();

        $request->validate([
            'jenis_berkas' => ['required', Rule::in(array_keys(BerkasPendaftaran::getJenisBerkas()))],
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'jenis_berkas.required' => 'Jenis berkas harus dipilih.',
            'jenis_berkas.in' => 'Jenis berkas tidak valid.',
            'file.required' => 'File harus diupload.',
            'file.mimes' => 'File harus berformat PDF, JPG, JPEG, atau PNG.',
            'file.max' => 'Ukuran file maksimal 2MB.',
        ]);

        // Cek apakah berkas dengan jenis ini sudah ada
        $existingBerkas = $siswa->berkasPendaftaran()
            ->where('jenis_berkas', $request->jenis_berkas)
            ->first();

        // Buat folder berdasarkan NISN (gunakan disk public agar bisa diakses)
        $folder = "berkas/spmb/{$siswa->nisn}";
        
        // Nama file dengan jenis berkas
        $jenis = $request->jenis_berkas;
        $extension = strtolower($request->file('file')->getClientOriginalExtension());
        $filename = "{$jenis}_{$siswa->nisn}.{$extension}";

        // Hapus file lama jika ada (gunakan disk public)
        if ($existingBerkas && Storage::disk('public')->exists($existingBerkas->path_file)) {
            Storage::disk('public')->delete($existingBerkas->path_file);
        }

        // Simpan file baru ke disk public
        $path = $request->file('file')->storeAs($folder, $filename, 'public');

        // Update atau create record berkas (tanpa status verifikasi)
        if ($existingBerkas) {
            $existingBerkas->update([
                'nama_file' => $request->file('file')->getClientOriginalName(),
                'path_file' => $path,
            ]);
        } else {
            BerkasPendaftaran::create([
                'calon_siswa_id' => $siswa->id,
                'jenis_berkas' => $request->jenis_berkas,
                'nama_file' => $request->file('file')->getClientOriginalName(),
                'path_file' => $path,
            ]);
        }

        // Check if all berkas uploaded
        $progress = BerkasPendaftaran::getUploadProgress($siswa->id);
        if ($progress['is_complete']) {
            return back()->with('success', 'Berkas berhasil diupload. Semua dokumen telah lengkap! Jadwal tes akan diinformasikan melalui WhatsApp.');
        }

        return back()->with('success', 'Berkas berhasil diupload. Progress: ' . $progress['uploaded'] . '/' . $progress['total']);
    }

    /**
     * Download berkas
     */
    public function download(BerkasPendaftaran $berkas)
    {
        $siswa = Auth::guard('spmb')->user();
        
        // Cek kepemilikan berkas
        if ($berkas->calon_siswa_id !== $siswa->id) {
            abort(403);
        }

        if (!Storage::disk('public')->exists($berkas->path_file)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($berkas->path_file, $berkas->nama_file);
    }

    /**
     * Hapus berkas (boleh dihapus kapan saja)
     */
    public function destroy(BerkasPendaftaran $berkas)
    {
        $siswa = Auth::guard('spmb')->user();
        
        // Cek kepemilikan berkas
        if ($berkas->calon_siswa_id !== $siswa->id) {
            abort(403);
        }

        // Hapus file dari storage (gunakan disk public)
        if (Storage::disk('public')->exists($berkas->path_file)) {
            Storage::disk('public')->delete($berkas->path_file);
        }

        $berkas->delete();

        return back()->with('success', 'Berkas berhasil dihapus.');
    }

    // ============================================
    // Admin Methods
    // ============================================

    /**
     * Menampilkan daftar berkas (Admin - view only, no verification)
     */
    public function adminIndex(Request $request)
    {
        $query = BerkasPendaftaran::with('calonSiswa');

        // Filter berdasarkan jenis berkas
        if ($request->has('jenis') && $request->jenis) {
            $query->where('jenis_berkas', $request->jenis);
        }

        // Filter berdasarkan NISN
        if ($request->has('nisn') && $request->nisn) {
            $query->whereHas('calonSiswa', function ($q) use ($request) {
                $q->where('nisn', 'like', "%{$request->nisn}%");
            });
        }

        $berkasList = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.berkas-verifikasi', compact('berkasList'));
    }

    /**
     * Verifikasi berkas oleh admin
     */
    public function adminVerify(Request $request, BerkasPendaftaran $berkas)
    {
        $request->validate([
            'status' => ['required', Rule::in([
                BerkasPendaftaran::STATUS_VALID,
                BerkasPendaftaran::STATUS_TIDAK_VALID,
            ])],
            'catatan' => 'nullable|string|max:500',
        ]);

        $berkas->update([
            'status_verifikasi' => $request->status,
            'catatan_admin' => $request->catatan,
        ]);

        return back()->with('success', 'Status berkas berhasil diperbarui.');
    }

    /**
     * Download berkas (Admin)
     */
    public function adminDownload(BerkasPendaftaran $berkas)
    {
        if (!Storage::disk('public')->exists($berkas->path_file)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($berkas->path_file, $berkas->nama_file);
    }

    /**
     * Upload berkas oleh admin untuk siswa
     */
    public function adminUpload(Request $request)
    {
        $request->validate([
            'calon_siswa_id' => 'required|exists:calon_siswa,id',
            'jenis_berkas' => ['required', Rule::in(array_keys(BerkasPendaftaran::getJenisBerkas()))],
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'calon_siswa_id.required' => 'ID siswa harus diisi.',
            'calon_siswa_id.exists' => 'Siswa tidak ditemukan.',
            'jenis_berkas.required' => 'Jenis berkas harus dipilih.',
            'jenis_berkas.in' => 'Jenis berkas tidak valid.',
            'file.required' => 'File harus diupload.',
            'file.mimes' => 'File harus berformat PDF, JPG, JPEG, atau PNG.',
            'file.max' => 'Ukuran file maksimal 2MB.',
        ]);

        $siswa = \App\Models\CalonSiswa::findOrFail($request->calon_siswa_id);

        // Cek apakah berkas dengan jenis ini sudah ada
        $existingBerkas = $siswa->berkasPendaftaran()
            ->where('jenis_berkas', $request->jenis_berkas)
            ->first();

        // Buat folder berdasarkan NISN
        $folder = "berkas/spmb/{$siswa->nisn}";
        
        // Nama file dengan jenis berkas
        $jenis = $request->jenis_berkas;
        $extension = strtolower($request->file('file')->getClientOriginalExtension());
        $filename = "{$jenis}_{$siswa->nisn}.{$extension}";

        // Hapus file lama jika ada
        if ($existingBerkas && Storage::disk('public')->exists($existingBerkas->path_file)) {
            Storage::disk('public')->delete($existingBerkas->path_file);
        }

        // Simpan file baru
        $path = $request->file('file')->storeAs($folder, $filename, 'public');

        // Update atau create record berkas
        if ($existingBerkas) {
            $existingBerkas->update([
                'nama_file' => $request->file('file')->getClientOriginalName(),
                'path_file' => $path,
            ]);
        } else {
            BerkasPendaftaran::create([
                'calon_siswa_id' => $siswa->id,
                'jenis_berkas' => $request->jenis_berkas,
                'nama_file' => $request->file('file')->getClientOriginalName(),
                'path_file' => $path,
            ]);
        }

        return back()->with('success', 'Berkas berhasil diupload.');
    }

    /**
     * Hapus berkas oleh admin
     */
    public function adminDestroy(BerkasPendaftaran $berkas)
    {
        // Hapus file dari storage
        if (Storage::disk('public')->exists($berkas->path_file)) {
            Storage::disk('public')->delete($berkas->path_file);
        }

        $berkas->delete();

        return back()->with('success', 'Berkas berhasil dihapus.');
    }
}
