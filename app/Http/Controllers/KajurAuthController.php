<?php

namespace App\Http\Controllers;

use App\Models\Kajur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KajurAuthController extends Controller
{
    /**
     * Handle Kajur logout
     */
    public function logout(Request $request)
    {
        Auth::guard('kajur')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    /**
     * Show Kajur dashboard
     */
    public function dashboard()
    {
        $kajur = Auth::guard('kajur')->user();
        $jurusan = $kajur->jurusan()->with(['kegiatan.gambar', 'infoProgram', 'kompetensiItems', 'mapelItems', 'karirItems'])->first();
        
        return view('kajur.dashboard', compact('kajur', 'jurusan'));
    }
}
