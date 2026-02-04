<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\Jurusan;
use App\Models\Pendaftaran;
use App\Models\Tes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegisterForm()
    {
        if (Auth::guard('spmb')->check()) {
            return redirect()->route('spmb.dashboard');
        }

        $jurusan = Jurusan::aktif()->urut()->get();
        return view('auth.register', compact('jurusan'));
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'nisn' => 'required|string|size:10|unique:calon_siswa,nisn',
            'nama_lengkap' => 'required|string|min:3|max:100',
            'jurusan_id' => 'required|exists:jurusan,id',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date|before_or_equal:' . now()->subYears(13)->format('Y-m-d') . '|after_or_equal:' . now()->subYears(20)->format('Y-m-d'),
            'asal_sekolah' => 'required|string|max:100',
            'no_wa' => 'required|string|regex:/^62[0-9]{10,12}$/',
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.size' => 'NISN harus 10 digit.',
            'nisn.unique' => 'NISN sudah terdaftar. Silakan login.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.min' => 'Nama lengkap minimal 3 karakter.',
            'jurusan_id.required' => 'Pilihan jurusan wajib dipilih.',
            'jurusan_id.exists' => 'Jurusan yang dipilih tidak valid.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tgl_lahir.before_or_equal' => 'Umur minimal harus 13 tahun.',
            'tgl_lahir.after_or_equal' => 'Umur maksimal adalah 20 tahun.',
            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi.',
            'no_wa.regex' => 'Nomor WhatsApp harus 12-14 digit diawali dengan 62 (contoh: 6281234567890).',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except(['password', 'password_confirmation']))
                ->with('password', $request->password)
                ->with('password_confirmation', $request->password_confirmation);
        }

        // Normalize phone number
        $noWa = $this->normalizePhoneNumber($request->no_wa);

        try {
            DB::transaction(function () use ($request, $noWa) {
                // Create CalonSiswa dengan data lengkap
                $calonSiswa = CalonSiswa::create([
                    'nisn' => $request->nisn,
                    'nama' => $request->nama_lengkap,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir' => $request->tgl_lahir,
                    'asal_sekolah' => $request->asal_sekolah,
                    'no_wa' => $noWa,
                    'password' => Hash::make($request->password),
                ]);

                // Create Pendaftaran dengan jurusan yang dipilih
                $pendaftaran = Pendaftaran::create([
                    'calon_siswa_id' => $calonSiswa->id,
                    'jurusan_id' => $request->jurusan_id,
                    'gelombang' => 'Gelombang 1',
                    'status_pendaftaran' => 'Terdaftar',
                ]);

                // Create Tes record
                Tes::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'status_kelulusan' => 'Pending',
                ]);
            });

            // Simpan session flash untuk login form
            Session::flash('registration_success', true);
            Session::flash('registered_nisn', $request->nisn);
            Session::flash('registered_nama_lengkap', $request->nama_lengkap);
            Session::flash('registered_password', $request->password);

            // Redirect ke halaman login
            return redirect()->route('login');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage())
                ->withInput($request->except(['password', 'password_confirmation']))
                ->with('password', $request->password)
                ->with('password_confirmation', $request->password_confirmation);
        }
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        if (Auth::guard('spmb')->check()) {
            return redirect()->route('spmb.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string',
            'password' => 'required|string',
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Rate limiting
        $key = 'login-attempt:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()
                ->withInput($request->only('nisn'))
                ->with('error', "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.");
        }

        // Attempt login
        $credentials = [
            'nisn' => $request->nisn,
            'password' => $request->password,
        ];

        if (Auth::guard('spmb')->attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();

            return redirect()->intended(route('spmb.dashboard'))
                ->with('success', 'Selamat datang kembali, ' . Auth::guard('spmb')->user()->nama . '!');
        }

        RateLimiter::hit($key, 60); // 1 minute decay

        return back()
            ->withInput($request->only('nisn'))
            ->with('error', 'NISN atau password salah.');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::guard('spmb')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }

    /**
     * Normalize phone number to 62xxx format
     */
    protected function normalizePhoneNumber(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        if (!str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }

        return $phone;
    }
}
