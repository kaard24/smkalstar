<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPembayaranController extends Controller
{
    /**
     * Display list of pembayaran for admin.
     */
    public function index(Request $request)
    {
        $query = Pembayaran::with('calonSiswa.pendaftaran.jurusan');
        
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('calonSiswa', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }
        
        $pembayaran = $query->latest()->paginate(20)->withQueryString();
        
        return view('admin.pembayaran', compact('pembayaran'));
    }

    /**
     * Display detail pembayaran.
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::with('calonSiswa.pendaftaran.jurusan')->findOrFail($id);
        return view('admin.pembayaran-show', compact('pembayaran'));
    }

    /**
     * Verify pembayaran (terima/tolak).
     */
    public function verify(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:' . Pembayaran::STATUS_VERIFIED . ',' . Pembayaran::STATUS_REJECTED,
            'catatan_admin' => 'nullable|string|max:500',
        ]);
        
        $pembayaran->update([
            'status' => $validated['status'],
            'catatan_admin' => $validated['catatan_admin'] ?? $pembayaran->catatan_admin,
            'verified_at' => now(),
            'verified_by' => auth('admin')->id(),
        ]);
        
        $message = $validated['status'] === Pembayaran::STATUS_VERIFIED 
            ? 'Pembayaran berhasil diterima.' 
            : 'Pembayaran ditolak.';
        
        return redirect()->back()->with('success', $message);
    }

    /**
     * Bulk verify pembayaran.
     */
    public function bulkVerify(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:pembayaran,id',
            'status' => 'required|in:' . Pembayaran::STATUS_VERIFIED . ',' . Pembayaran::STATUS_REJECTED,
        ]);
        
        $count = Pembayaran::whereIn('id', $validated['ids'])
            ->update([
                'status' => $validated['status'],
                'verified_at' => now(),
                'verified_by' => auth('admin')->id(),
            ]);
        
        $message = $validated['status'] === Pembayaran::STATUS_VERIFIED 
            ? "{$count} pembayaran berhasil diterima." 
            : "{$count} pembayaran ditolak.";
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'count' => $count,
        ]);
    }

    /**
     * Download bukti pembayaran.
     */
    public function download($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
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
        
        if (!$pembayaran->bukti_pembayaran || !Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
            abort(404, 'File not found.');
        }
        
        return response()->file(storage_path('app/public/' . $pembayaran->bukti_pembayaran));
    }
}
