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
        // Rate limiting for registration
        $key = 'register-attempt:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return back()
                ->withInput($request->except(['password', 'password_confirmation']))
                ->with('error', "Terlalu banyak percobaan registrasi. Coba lagi dalam {$seconds} detik.");
        }

        // Normalize phone number first for validation
        $noWa = $this->normalizePhoneNumber($request->no_wa);
        $request->merge(['no_wa' => $noWa]);

        $validator = \Validator::make($request->all(), [
            'nisn' => 'required|string|size:10|unique:calon_siswa,nisn',
            'nama_lengkap' => 'required|string|min:3|max:39|regex:/^[a-zA-Z\s\'\-]+$/u',
            'jk' => 'required|in:L,P',
            'jurusan_id' => 'required|exists:jurusan,id',
            'jurusan_id_2' => 'required|exists:jurusan,id|different:jurusan_id',
            'tempat_lahir' => 'required|string|min:3|max:50|regex:/^[a-zA-Z\s\-]+$/u',
            'tgl_lahir' => 'required|date|before_or_equal:' . now()->subYears(13)->format('Y-m-d') . '|after_or_equal:' . now()->subYears(20)->format('Y-m-d'),
            'asal_sekolah' => 'required|string|min:5|max:100|regex:/^[a-zA-Z0-9\s\-\.]+$/u',
            'no_wa' => 'required|string|regex:/^62[0-9]{9,12}$/|unique:calon_siswa,no_wa',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.size' => 'NISN harus 10 digit.',
            'nisn.unique' => 'NISN ini sudah terdaftar. Silakan login jika sudah memiliki akun.',
            
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.min' => 'Nama lengkap minimal 3 karakter.',
            'nama_lengkap.max' => 'Nama lengkap maksimal 39 karakter.',
            'nama_lengkap.regex' => 'Nama lengkap hanya boleh berisi huruf, spasi, tanda petik, dan tanda hubung.',
            
            'jk.required' => 'Jenis kelamin wajib dipilih.',
            'jk.in' => 'Jenis kelamin tidak valid.',
            
            'jurusan_id.required' => 'Pilihan jurusan 1 wajib dipilih.',
            'jurusan_id.exists' => 'Jurusan yang dipilih tidak valid.',
            'jurusan_id_2.required' => 'Pilihan jurusan 2 wajib dipilih.',
            'jurusan_id_2.exists' => 'Jurusan yang dipilih tidak valid.',
            'jurusan_id_2.different' => 'Pilihan jurusan 2 harus berbeda dengan pilihan 1.',
            
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tempat_lahir.min' => 'Tempat lahir minimal 3 karakter.',
            'tempat_lahir.max' => 'Tempat lahir maksimal 50 karakter.',
            'tempat_lahir.regex' => 'Tempat lahir hanya boleh berisi huruf, spasi, dan tanda hubung.',
            
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tgl_lahir.before_or_equal' => 'Umur minimal harus 13 tahun.',
            'tgl_lahir.after_or_equal' => 'Umur maksimal adalah 20 tahun.',
            
            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
            'asal_sekolah.min' => 'Asal sekolah minimal 5 karakter.',
            'asal_sekolah.max' => 'Asal sekolah maksimal 100 karakter.',
            'asal_sekolah.regex' => 'Asal sekolah hanya boleh berisi huruf, angka, spasi, titik, dan tanda hubung.',
            
            'no_wa.required' => 'Nomor WhatsApp wajib diisi.',
            'no_wa.regex' => 'Nomor WhatsApp harus diawali dengan 62 dan terdiri dari 11-14 digit (contoh: 6281234567890).',
            'no_wa.unique' => 'Nomor WhatsApp ini sudah terdaftar. Gunakan nomor lain atau login jika sudah memiliki akun.',
            
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok. Pastikan kedua password sama.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.mixed_case' => 'Password harus mengandung huruf besar dan huruf kecil.',
            'password.numbers' => 'Password harus mengandung minimal 1 angka.',
            'password.symbols' => 'Password harus mengandung minimal 1 simbol.',
        ]);

        if ($validator->fails()) {
            RateLimiter::hit($key, 300); // 5 menit decay
            return back()
                ->withErrors($validator)
                ->withInput($request->except(['password', 'password_confirmation']));
        }

        // Normalize phone number
        $noWa = $this->normalizePhoneNumber($request->no_wa);

        try {
            DB::transaction(function () use ($request, $noWa) {
                // Create CalonSiswa dengan data lengkap
                $calonSiswa = CalonSiswa::create([
                    'nisn' => $request->nisn,
                    'nama' => $request->nama_lengkap,
                    'jk' => $request->jk,
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
                    'jurusan_id_2' => $request->jurusan_id_2,
                    'gelombang' => 'Gelombang 1',
                    'status_pendaftaran' => 'Terdaftar',
                ]);

                // Create Tes record
                Tes::create([
                    'pendaftaran_id' => $pendaftaran->id,
                    'status_kelulusan' => 'Pending',
                ]);
            });

            // Clear rate limiter on success
            RateLimiter::clear($key);

            // Simpan session flash untuk login form
            Session::flash('registration_success', true);
            Session::flash('registered_nisn', $request->nisn);
            Session::flash('registered_nama_lengkap', $request->nama_lengkap);
            Session::flash('registered_password', $request->password);

            // Redirect ke halaman login
            return redirect()->route('login');
        } catch (\Exception $e) {
            RateLimiter::hit($key, 300);
            \Log::error('Registration error: ' . $e->getMessage(), ['ip' => $request->ip()]);
            return back()
                ->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.')
                ->withInput($request->except(['password', 'password_confirmation']));
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
