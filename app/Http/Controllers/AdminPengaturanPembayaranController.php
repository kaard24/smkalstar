<?php

namespace App\Http\Controllers;

use App\Models\PengaturanPembayaran;
use Illuminate\Http\Request;

class AdminPengaturanPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaturan = PengaturanPembayaran::with(['createdBy', 'updatedBy'])
            ->latest()
            ->paginate(10);
        
        return view('admin.pembayaran-pengaturan.index', compact('pengaturan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pembayaran-pengaturan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'nomor_rekening' => 'nullable|string|max:50',
            'bank' => 'nullable|string|max:50',
            'biaya' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
        ]);

        $validated['created_by'] = auth('admin')->id();
        $validated['updated_by'] = auth('admin')->id();
        $validated['is_active'] = $request->boolean('is_active', false);

        PengaturanPembayaran::create($validated);

        return redirect()->route('admin.pembayaran-pengaturan.index')
            ->with('success', 'Pengaturan pembayaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengaturanPembayaran $pengaturan)
    {
        return view('admin.pembayaran-pengaturan.show', compact('pengaturan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengaturanPembayaran $pengaturan)
    {
        return view('admin.pembayaran-pengaturan.edit', compact('pengaturan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengaturanPembayaran $pengaturan)
    {
        $validated = $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'nomor_rekening' => 'nullable|string|max:50',
            'bank' => 'nullable|string|max:50',
            'biaya' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
        ]);

        $validated['updated_by'] = auth('admin')->id();
        $validated['is_active'] = $request->boolean('is_active', false);

        $pengaturan->update($validated);

        return redirect()->route('admin.pembayaran-pengaturan.index')
            ->with('success', 'Pengaturan pembayaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengaturanPembayaran $pengaturan)
    {
        $pengaturan->delete();

        return redirect()->route('admin.pembayaran-pengaturan.index')
            ->with('success', 'Pengaturan pembayaran berhasil dihapus.');
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(PengaturanPembayaran $pengaturan)
    {
        $pengaturan->update([
            'is_active' => !$pengaturan->is_active,
            'updated_by' => auth('admin')->id(),
        ]);

        $status = $pengaturan->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->back()
            ->with('success', "Pengaturan pembayaran berhasil {$status}.");
    }
}
