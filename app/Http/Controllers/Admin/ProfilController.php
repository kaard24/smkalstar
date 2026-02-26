<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfilController extends Controller
{
    /**
     * Show the profile edit form
     */
    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profil.edit', compact('admin'));
    }

    /**
     * Update the profile
     */
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admin,username,' . $admin->id,
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update name and username
        $admin->name = $validated['name'];
        $admin->username = $validated['username'];

        // Update password if provided
        if (!empty($validated['password'])) {
            // Verify current password
            if (empty($validated['current_password']) || !Hash::check($validated['current_password'], $admin->password)) {
                throw ValidationException::withMessages([
                    'current_password' => 'Password saat ini tidak sesuai.',
                ]);
            }
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()->route('admin.profil.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
