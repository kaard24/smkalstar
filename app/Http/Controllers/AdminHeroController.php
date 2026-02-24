<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroes = HeroSection::orderBy('created_at', 'desc')->get();
        return view('admin.hero.index', compact('heroes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hero.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'required|string|max:100',
            'title_line1' => 'required|string|max:100',
            'title_highlight' => 'required|string|max:50',
            'title_line2' => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'button_primary_text' => 'required|string|max:50',
            'button_primary_url' => 'required|string|max:200',
            'button_secondary_text' => 'required|string|max:50',
            'button_secondary_url' => 'required|string|max:200',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('hero_image')) {
            $image = $request->file('hero_image');
            $filename = 'hero_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $validated['hero_image'] = 'images/' . $filename;
        }

        $validated['is_active'] = $request->boolean('is_active', false);

        // If this is set as active, deactivate others
        if ($validated['is_active']) {
            HeroSection::where('is_active', true)->update(['is_active' => false]);
        }

        HeroSection::create($validated);

        return redirect()->route('admin.hero.index')
            ->with('success', 'Hero section berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroSection $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroSection $hero)
    {
        $validated = $request->validate([
            'badge_text' => 'required|string|max:100',
            'title_line1' => 'required|string|max:100',
            'title_highlight' => 'required|string|max:50',
            'title_line2' => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'button_primary_text' => 'required|string|max:50',
            'button_primary_url' => 'required|string|max:200',
            'button_secondary_text' => 'required|string|max:50',
            'button_secondary_url' => 'required|string|max:200',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('hero_image')) {
            // Delete old image if exists and not default
            if ($hero->hero_image && file_exists(public_path($hero->hero_image))) {
                unlink(public_path($hero->hero_image));
            }

            $image = $request->file('hero_image');
            $filename = 'hero_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $validated['hero_image'] = 'images/' . $filename;
        }

        $validated['is_active'] = $request->boolean('is_active', false);

        // If this is set as active, deactivate others
        if ($validated['is_active']) {
            HeroSection::where('is_active', true)->where('id', '!=', $hero->id)->update(['is_active' => false]);
        }

        $hero->update($validated);

        return redirect()->route('admin.hero.index')
            ->with('success', 'Hero section berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroSection $hero)
    {
        // Delete image if exists and not default
        if ($hero->hero_image && file_exists(public_path($hero->hero_image))) {
            unlink(public_path($hero->hero_image));
        }

        $hero->delete();

        return redirect()->route('admin.hero.index')
            ->with('success', 'Hero section berhasil dihapus!');
    }

    /**
     * Set hero section as active
     */
    public function setActive(HeroSection $hero)
    {
        HeroSection::where('is_active', true)->update(['is_active' => false]);
        $hero->update(['is_active' => true]);

        return redirect()->route('admin.hero.index')
            ->with('success', 'Hero section berhasil diaktifkan!');
    }
}
