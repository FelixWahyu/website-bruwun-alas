@extends('layouts.admin-layout')

@section('title', 'Edit Profil')
@section('header_title', 'Profil Saya')

@section('content')
    <div class="max-w-4xl mx-auto">

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r shadow-sm">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- KARTU 1: INFORMASI DASAR -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center border-b pb-4">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Informasi Akun
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500" required>
                        @error('email')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- No HP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                        <input type="number" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500">
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-100">
                    <h4 class="text-sm font-bold text-gray-800 mb-4 uppercase tracking-wide">Alamat (Opsional)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea name="address" rows="2" class="w-full border-gray-300 rounded-lg focus:ring-blue-500">{{ old('address', $user->address) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                            <input type="text" name="province" value="{{ old('province', $user->province) }}"
                                class="w-full border-gray-300 rounded-lg focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kota/Kabupaten</label>
                            <input type="text" name="city" value="{{ old('city', $user->city) }}"
                                class="w-full border-gray-300 rounded-lg focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                            <input type="text" name="subdistrict" value="{{ old('subdistrict', $user->subdistrict) }}"
                                class="w-full border-gray-300 rounded-lg focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                            <input type="number" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}"
                                class="w-full border-gray-300 rounded-lg focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>

            <!-- KARTU 2: GANTI PASSWORD -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center border-b pb-4">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                    Ganti Password
                </h3>

                <p class="text-sm text-gray-500 mb-4 bg-blue-50 p-3 rounded-lg">
                    <span class="font-bold text-blue-600">Info:</span> Biarkan kolom password kosong jika Anda tidak ingin
                    mengubah password saat ini.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <input type="password" name="password"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            minlength="8">
                        @error('password')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-blue-500/30 transition-all duration-200 transform hover:-translate-y-1">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
@endsection
