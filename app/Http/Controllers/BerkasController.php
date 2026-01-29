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
        $siswa = Auth::guard('ppdb')->user();
        $berkas = $siswa->berkasPendaftaran()->get()->keyBy('jenis_berkas');
        $jenisBerkas = BerkasPendaftaran::getJenisBerkas();

        return view('ppdb.berkas', compact('siswa', 'berkas', 'jenisBerkas'));
    }

    /**
     * Upload berkas baru
     */
    public function upload(Request $request)
    {
        $siswa = Auth::guard('ppdb')->user();

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

        // Jika sudah ada berkas yang sudah diverifikasi (Valid), tidak boleh upload ulang
        if ($existingBerkas && $existingBerkas->isValid()) {
            return back()->with('error', 'Berkas ini sudah diverifikasi Valid dan tidak dapat diubah.');
        }

        // Buat folder berdasarkan NISN
        $folder = "ppdb/berkas/{$siswa->nisn}";
        
        // Nama file dengan jenis berkas
        $jenis = $request->jenis_berkas;
        $extension = $request->file('file')->getClientOriginalExtension();
        $filename = "{$jenis}_{$siswa->nisn}.{$extension}";

        // Hapus file lama jika ada
        if ($existingBerkas && Storage::exists($existingBerkas->path_file)) {
            Storage::delete($existingBerkas->path_file);
        }

        // Simpan file baru
        $path = $request->file('file')->storeAs($folder, $filename);

        // Update atau create record berkas
        if ($existingBerkas) {
            $existingBerkas->update([
                'nama_file' => $request->file('file')->getClientOriginalName(),
                'path_file' => $path,
                'status_verifikasi' => BerkasPendaftaran::STATUS_PENDING,
                'catatan_admin' => null,
            ]);
        } else {
            BerkasPendaftaran::create([
                'calon_siswa_id' => $siswa->id,
                'jenis_berkas' => $request->jenis_berkas,
                'nama_file' => $request->file('file')->getClientOriginalName(),
                'path_file' => $path,
                'status_verifikasi' => BerkasPendaftaran::STATUS_PENDING,
            ]);
        }

        return back()->with('success', 'Berkas berhasil diupload.');
    }

    /**
     * Download berkas
     */
    public function download(BerkasPendaftaran $berkas)
    {
        $siswa = Auth::guard('ppdb')->user();
        
        // Cek kepemilikan berkas
        if ($berkas->calon_siswa_id !== $siswa->id) {
            abort(403);
        }

        if (!Storage::exists($berkas->path_file)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::download($berkas->path_file, $berkas->nama_file);
    }

    /**
     * Hapus berkas (hanya jika masih pending atau tidak valid)
     */
    public function destroy(BerkasPendaftaran $berkas)
    {
        $siswa = Auth::guard('ppdb')->user();
        
        // Cek kepemilikan berkas
        if ($berkas->calon_siswa_id !== $siswa->id) {
            abort(403);
        }

        // Tidak bisa hapus berkas yang sudah valid
        if ($berkas->isValid()) {
            return back()->with('error', 'Berkas yang sudah diverifikasi Valid tidak dapat dihapus.');
        }

        // Hapus file dari storage
        if (Storage::exists($berkas->path_file)) {
            Storage::delete($berkas->path_file);
        }

        $berkas->delete();

        return back()->with('success', 'Berkas berhasil dihapus.');
    }

    // ============================================
    // Admin Methods
    // ============================================

    /**
     * Menampilkan daftar berkas untuk verifikasi (Admin)
     */
    public function adminIndex(Request $request)
    {
        $query = BerkasPendaftaran::with('calonSiswa');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status_verifikasi', $request->status);
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
        if (!Storage::exists($berkas->path_file)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::download($berkas->path_file, $berkas->nama_file);
    }
}
