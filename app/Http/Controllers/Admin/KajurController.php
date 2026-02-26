<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kajur;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KajurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kajur = Kajur::with('jurusan')->orderBy('nama')->get();
        return view('admin.kajur.index', compact('kajur'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = Jurusan::orderBy('nama')->get();
        return view('admin.kajur.create', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:kajur,username',
            'password' => 'required|string|min:6',
            'jurusan_id' => 'required|exists:jurusan,id',
            'aktif' => 'boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['aktif'] = $request->has('aktif');

        Kajur::create($validated);

        return redirect()->route('admin.kajur.index')
            ->with('success', 'Kepala Jurusan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kajur $kajur)
    {
        return view('admin.kajur.show', compact('kajur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kajur $kajur)
    {
        $jurusan = Jurusan::orderBy('nama')->get();
        return view('admin.kajur.edit', compact('kajur', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kajur $kajur)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:kajur,username,' . $kajur->id,
            'password' => 'nullable|string|min:6',
            'jurusan_id' => 'required|exists:jurusan,id',
            'aktif' => 'boolean',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['aktif'] = $request->has('aktif');

        $kajur->update($validated);

        return redirect()->route('admin.kajur.index')
            ->with('success', 'Kepala Jurusan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kajur $kajur)
    {
        $kajur->delete();

        return redirect()->route('admin.kajur.index')
            ->with('success', 'Kepala Jurusan berhasil dihapus.');
    }
}
