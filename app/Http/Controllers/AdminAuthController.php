<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Kajur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

/**
 * Controller untuk autentikasi Admin
 */
class AdminAuthController extends Controller
{
    /**
     * Menampilkan form login admin/kajur
     */
    public function showLoginForm()
    {
        // Jika sudah login sebagai admin, redirect ke admin dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // Jika sudah login sebagai kajur, redirect ke kajur dashboard
        if (Auth::guard('kajur')->check()) {
            return redirect()->route('kajur.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Proses login admin atau kajur
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Rate limiting
        $key = 'admin-login-attempt:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()
                ->withInput($request->only('username'))
                ->with('error', "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.");
        }

        // Coba login sebagai Kajur terlebih dahulu
        $kajur = Kajur::where('username', $request->username)
                       ->where('aktif', true)
                       ->first();

        if ($kajur && Hash::check($request->password, $kajur->password)) {
            RateLimiter::clear($key);
            Auth::guard('kajur')->login($kajur, $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->intended(route('kajur.dashboard'))
                ->with('success', 'Selamat datang, ' . $kajur->nama . '!');
        }

        // Jika bukan Kajur, coba login sebagai Admin
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang, ' . Auth::guard('admin')->user()->name . '!');
        }

        RateLimiter::hit($key, 60);

        return back()
            ->withInput($request->only('username'))
            ->with('error', 'Username atau password salah.');
    }

    /**
     * Proses logout admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Anda telah logout.');
    }
}
