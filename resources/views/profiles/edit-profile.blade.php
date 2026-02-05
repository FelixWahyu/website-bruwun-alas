@extends('layouts.app-layout')

@section('title', 'Profil Saya')

@section('content')
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">Pengaturan Akun</h1>

            <div class="flex flex-col lg:flex-row gap-8">

                <aside class="lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                        <div class="p-6 bg-linear-to-br from-blue-600 to-blue-700 text-center">
                            <div class="inline-flex h-20 w-20 rounded-full bg-white p-1 mb-3 shadow-md">
                                <div
                                    class="h-full w-full rounded-full bg-blue-100 flex items-center justify-center text-2xl font-bold text-blue-700">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-white truncate">{{ Auth::user()->name }}</h3>
                            <p class="text-blue-100 text-sm truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <nav class="p-3 space-y-1">
                            <a href="{{ route('profile') }}"
                                class="flex items-center px-4 py-3 bg-blue-50 text-blue-700 font-bold rounded-xl transition">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Edit Profil
                            </a>
                            <a href="{{ route('orders.history') }}"
                                class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium rounded-xl transition">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                Riwayat Pesanan
                            </a>
                            <form method="POST" action="{{ route('logout') }}" id="form-logout-profile">
                                @csrf
                                <button type="submit" onclick="confirmLogout(event,'form-logout-profile')"
                                    class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 font-medium rounded-xl transition">
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

                <div class="lg:w-3/4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">

                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Edit Profil</h2>
                                <p class="text-sm text-gray-500">Perbarui informasi pribadi dan alamat pengiriman Anda.</p>
                            </div>
                        </div>

                        @if (session('success'))
                            <div
                                class="mb-6 bg-green-50 border border-green-100 text-green-700 p-4 rounded-xl flex items-center shadow-sm">
                                <div class="bg-green-100 rounded-full p-1 mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="space-y-5">
                                <label class="text-sm font-bold text-gray-900 uppercase tracking-wide">Data Diri</label>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                                class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                                required>
                                        </div>
                                        @error('name')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                                class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                                required>
                                        </div>
                                        @error('email')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">No. WhatsApp</label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                    </path>
                                                </svg>
                                            </span>
                                            <input type="number" name="phone"
                                                value="{{ old('phone', $user->phone) }}"
                                                class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-8 border-gray-100">

                            <div class="space-y-5">
                                <label class="text-sm font-bold text-gray-900 uppercase tracking-wide">Detail
                                    Alamat</label>
                                <div
                                    class="bg-gray-50 p-5 rounded-xl border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div class="md:col-span-2">
                                        <textarea name="address" rows="2"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                            placeholder="Nama Jalan, RT/RW, No. Rumah">{{ old('address', $user->address) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-8 border-gray-100">

                            <div class="space-y-5">
                                <div class="flex items-center justify-between">
                                    <label class="text-sm font-bold text-gray-900 uppercase tracking-wide">Ubah
                                        Password</label>
                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Opsional</span>
                                </div>

                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5 border border-orange-100 bg-orange-50/30 rounded-xl">
                                    <div class="md:col-span-2 text-xs text-orange-600 mb-1">
                                        * Kosongkan jika tidak ingin mengubah password.
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                                        <input type="password" name="password" minlength="8"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition bg-white">
                                        @error('password')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi
                                            Password</label>
                                        <input type="password" name="password_confirmation"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-transparent transition bg-white">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end">
                                <button type="submit"
                                    class="w-full sm:w-auto bg-blue-600 text-white cursor-pointer px-8 py-3.5 rounded-xl font-bold hover:bg-blue-700 shadow-lg hover:shadow-blue-500/30 transition transform hover:-translate-y-0.5 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
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
