@extends('layouts.app-layout')

@section('title', 'Profil Saya')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold text-gray-900 mb-8">Akun Saya</h1>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- SIDEBAR MENU -->
                <aside class="lg:w-1/4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-gray-50">
                            <div class="flex items-center gap-4">
                                <div
                                    class="h-12 w-12 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xl">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <nav class="p-2 space-y-1">
                            <a href="{{ route('profile') }}"
                                class="flex items-center px-4 py-3 bg-blue-50 text-blue-700 font-medium rounded-lg">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Edit Profil
                            </a>
                            <a href="{{ route('orders.history') }}"
                                class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium rounded-lg transition">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                Riwayat Pesanan
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" onclick="return confirm('Keluar dari akun?')"
                                    class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 font-medium rounded-lg transition">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </nav>
                    </div>
                </aside>

                <!-- FORM CONTENT -->
                <div class="lg:w-3/4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sm:p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">Informasi Pribadi &
                            Alamat</h2>

                        @if (session('success'))
                            <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-lg flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Nama -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                    @error('name')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                    @error('email')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor HP / WhatsApp</label>
                                    <input type="number" name="phone" value="{{ old('phone', $user->phone) }}"
                                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                </div>
                            </div>

                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 mt-8">Alamat Pengiriman
                                Default</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Provinsi -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                    <input type="text" name="province" value="{{ old('province', $user->province) }}"
                                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Contoh: Jawa Tengah" required>
                                </div>

                                <!-- Kota -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota / Kabupaten</label>
                                    <input type="text" name="city" value="{{ old('city', $user->city) }}"
                                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Contoh: Banyumas" required>
                                </div>

                                <!-- Kecamatan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                    <input type="text" name="subdistrict"
                                        value="{{ old('subdistrict', $user->subdistrict) }}"
                                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Contoh: Kembaran" required>
                                </div>

                                <!-- Kode Pos -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                                    <input type="number" name="postal_code"
                                        value="{{ old('postal_code', $user->postal_code) }}"
                                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Contoh: 53181" required>
                                </div>

                                <!-- Alamat Lengkap -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap (Jalan,
                                        RT/RW, No Rumah)</label>
                                    <textarea name="address" rows="3"
                                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Contoh: Jl. Raya Kembaran No. 5, RT 01 RW 02" required>{{ old('address', $user->address) }}</textarea>
                                </div>
                            </div>

                            <div class="border-t border-gray-100 pt-6 mt-6">
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Ubah Password
                                    (Opsional)</h3>
                                <p class="text-xs text-gray-500 mb-4">Biarkan kosong jika tidak ingin mengubah password.
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
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi
                                            Password</label>
                                        <input type="password" name="password_confirmation"
                                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end">
                                <button type="submit"
                                    class="bg-blue-600 text-white cursor-pointer px-6 py-3 rounded-xl font-bold hover:bg-blue-700 shadow-lg hover:shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                                    Simpan Perubahan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
