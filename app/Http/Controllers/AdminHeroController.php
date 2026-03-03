<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AdminHeroController extends Controller
{
    private const DEFAULT_HERO_IMAGE = 'images/b1.webp';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroes = HeroSection::with(['creator', 'updater'])
            ->orderBy('created_at', 'desc')
            ->get();
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
            'remove_image' => 'nullable|boolean',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $this->storeHeroImage($request->file('hero_image'));
        }

        $validated['is_active'] = $request->boolean('is_active', false);

        // If this is set as active, deactivate others
        if ($validated['is_active']) {
            HeroSection::where('is_active', true)->update(['is_active' => false]);
        }

        $validated['created_by'] = Auth::guard('admin')->id();
        $validated['updated_by'] = Auth::guard('admin')->id();

        HeroSection::create($validated);
        $this->clearHeroCache();

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
            'remove_image' => 'nullable|boolean',
            'is_active' => 'boolean',
        ]);

        // Handle image upload / remove
        if ($request->hasFile('hero_image')) {
            $oldImage = $hero->hero_image;
            $validated['hero_image'] = $this->storeHeroImage($request->file('hero_image'));
            $this->deleteHeroImageIfCustom($oldImage);
        } elseif ($request->boolean('remove_image')) {
            $this->deleteHeroImageIfCustom($hero->hero_image);
            // Keep column non-null but empty so default image is not used anymore.
            $validated['hero_image'] = '';
        }

        $validated['is_active'] = $request->boolean('is_active', false);

        // If this is set as active, deactivate others
        if ($validated['is_active']) {
            HeroSection::where('is_active', true)->where('id', '!=', $hero->id)->update(['is_active' => false]);
        }

        $validated['updated_by'] = Auth::guard('admin')->id();

        $hero->update($validated);
        $this->clearHeroCache();

        return redirect()->route('admin.hero.index')
            ->with('success', 'Hero section berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroSection $hero)
    {
        $this->deleteHeroImageIfCustom($hero->hero_image);

        $hero->delete();
        $this->clearHeroCache();

        return redirect()->route('admin.hero.index')
            ->with('success', 'Hero section berhasil dihapus!');
    }

    /**
     * Set hero section as active
     */
    public function setActive(HeroSection $hero)
    {
        HeroSection::where('is_active', true)->update(['is_active' => false]);
        $hero->update([
            'is_active' => true,
            'updated_by' => Auth::guard('admin')->id(),
        ]);
        $this->clearHeroCache();

        return redirect()->route('admin.hero.index')
            ->with('success', 'Hero section berhasil diaktifkan!');
    }

    private function storeHeroImage($image): string
    {
        $extension = strtolower($image->getClientOriginalExtension() ?: 'jpg');
        $filename = 'hero_' . Str::uuid()->toString() . '.' . $extension;
        $image->move(public_path('images'), $filename);

        return 'images/' . $filename;
    }

    private function deleteHeroImageIfCustom(?string $imagePath): void
    {
        if (!$imagePath || $imagePath === self::DEFAULT_HERO_IMAGE) {
            return;
        }

        $fullPath = public_path($imagePath);
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }

    private function clearHeroCache(): void
    {
        Cache::forget('hero_section');
    }
}
