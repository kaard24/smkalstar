<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasiSection;
use App\Models\StrukturOrganisasiMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    /**
     * Display all sections with their members
     */
    public function index()
    {
        $sections = StrukturOrganisasiSection::urut()
            ->with(['members' => fn($q) => $q->orderBy('urutan')])
            ->get();
        
        return view('admin.profil-struktur', compact('sections'));
    }

    /**
     * Store a new section
     */
    public function storeSection(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'urutan' => 'nullable|integer',
        ]);

        $maxUrutan = StrukturOrganisasiSection::max('urutan') ?? 0;

        StrukturOrganisasiSection::create([
            'nama' => $request->nama,
            'urutan' => $request->urutan ?? ($maxUrutan + 1),
            'is_active' => true,
        ]);

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Section berhasil ditambahkan.');
    }

    /**
     * Update a section
     */
    public function updateSection(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'urutan' => 'nullable|integer',
        ]);

        $section = StrukturOrganisasiSection::findOrFail($id);
        $section->update([
            'nama' => $request->nama,
            'urutan' => $request->urutan ?? $section->urutan,
        ]);

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Section berhasil diperbarui.');
    }

    /**
     * Delete a section
     */
    public function destroySection($id)
    {
        $section = StrukturOrganisasiSection::findOrFail($id);
        
        // Delete all member photos
        foreach ($section->members as $member) {
            if ($member->foto && !str_starts_with($member->foto, 'http')) {
                Storage::disk('public')->delete($member->foto);
            }
        }
        
        $section->delete();

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Section berhasil dihapus.');
    }

    /**
     * Store a new member
     */
    public function storeMember(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:struktur_organisasi_sections,id',
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'nullable|integer',
        ]);

        $maxUrutan = StrukturOrganisasiMember::where('section_id', $request->section_id)->max('urutan') ?? 0;

        $data = [
            'section_id' => $request->section_id,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'urutan' => $request->urutan ?? ($maxUrutan + 1),
            'is_active' => true,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('struktur-organisasi', 'public');
        }

        StrukturOrganisasiMember::create($data);

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    /**
     * Update a member
     */
    public function updateMember(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan' => 'nullable|integer',
        ]);

        $member = StrukturOrganisasiMember::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'urutan' => $request->urutan ?? $member->urutan,
        ];

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($member->foto && !str_starts_with($member->foto, 'http')) {
                Storage::disk('public')->delete($member->foto);
            }
            $data['foto'] = $request->file('foto')->store('struktur-organisasi', 'public');
        }

        $member->update($data);

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Anggota berhasil diperbarui.');
    }

    /**
     * Delete a member
     */
    public function destroyMember($id)
    {
        $member = StrukturOrganisasiMember::findOrFail($id);
        
        if ($member->foto && !str_starts_with($member->foto, 'http')) {
            Storage::disk('public')->delete($member->foto);
        }
        
        $member->delete();

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
