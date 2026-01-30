<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Tampilkan form edit profil
     */
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update data profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|numeric',
            'address' => 'nullable|string',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'subdistrict' => 'nullable|string',
            'postal_code' => 'nullable|numeric',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // 1. Update Data Dasar
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // 2. Update Alamat
        $user->address = $request->address;
        $user->province = $request->province;
        $user->city = $request->city;
        $user->subdistrict = $request->subdistrict;
        $user->postal_code = $request->postal_code;

        // 3. Update Password (Hanya jika diisi)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
