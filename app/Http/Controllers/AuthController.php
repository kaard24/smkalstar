<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use App\Models\Tes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegisterForm()
    {
        if (Auth::guard('ppdb')->check()) {
            return redirect()->route('ppdb.dashboard');
        }

        return view('auth.register');
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|size:10|unique:calon_siswa,nisn',
            'nama_lengkap' => 'required|string|max:100',
            'no_wa' => 'required|string|regex:/^62[0-9]{9,13}$/',
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.size' => 'NISN harus 10 digit.',
            'nisn.unique' => 'NISN sudah terdaftar. Silakan login.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi.',
            'no_wa.regex' => 'Format nomor WhatsApp tidak valid (contoh: 6281234567890).',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        // Normalize phone number
        $noWa = $this->normalizePhoneNumber($request->no_wa);

        // Create CalonSiswa - hanya data dari registrasi
        // jk, tgl_lahir, alamat, asal_sekolah akan diisi di form "Lengkapi Data"
        $calonSiswa = CalonSiswa::create([
            'nisn' => $request->nisn,
            'nama' => $request->nama_lengkap,
            'no_wa' => $noWa,
            'password' => Hash::make($request->password),
        ]);

        // Note: Pendaftaran will be created when user completes their data
        // (jurusan_id is required and cannot be null)

        // Redirect ke halaman login dengan data untuk auto-fill
        return redirect()->route('login')
            ->with('registration_success', true)
            ->with('registered_nisn', $request->nisn)
            ->with('registered_password', $request->password);
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        if (Auth::guard('ppdb')->check()) {
            return redirect()->route('ppdb.dashboard');
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

        if (Auth::guard('ppdb')->attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();

            return redirect()->intended(route('ppdb.dashboard'))
                ->with('success', 'Selamat datang kembali, ' . Auth::guard('ppdb')->user()->nama . '!');
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
        Auth::guard('ppdb')->logout();

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
