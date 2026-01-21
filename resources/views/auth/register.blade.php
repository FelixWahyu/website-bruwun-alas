@extends('layouts.guest-layout')
@section('title', 'Registrasi - Wisata Edukasi Bruwun Alas')
@section('content')
    <div class="w-full">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Buat Akun Baru</h1>
            <p class="mt-2 text-sm text-gray-600">
                Bergabunglah bersama kami untuk menikmati kemudahan berbelanja produk lokal dan reservasi wisata.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg animate-fade-in-up">
                <div class="flex">
                    <div class="shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                        <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form class="space-y-5" action="{{ route('register.proses') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="space-y-1">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent sm:text-sm transition shadow-sm"
                            placeholder="Budi Santoso">
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="phone" class="block text-sm font-semibold text-gray-700">No. WhatsApp</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <input id="phone" name="phone" type="number" value="{{ old('phone') }}" required
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent sm:text-sm transition shadow-sm"
                            placeholder="08123456789">
                    </div>
                </div>
            </div>

            <div class="space-y-1">
                <label for="email" class="block text-sm font-semibold text-gray-700">Alamat Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent sm:text-sm transition shadow-sm"
                        placeholder="nama@email.com">
                </div>
            </div>

            <div x-data="{ show: false }">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-1">
                        <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" name="password" :type="show ? 'text' : 'password'" required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent sm:text-sm transition shadow-sm"
                                placeholder="Min. 8 karakter">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Ulangi
                            Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <input id="password_confirmation" name="password_confirmation"
                                :type="show ? 'text' : 'password'" required
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent sm:text-sm transition shadow-sm"
                                placeholder="Ketik ulang password">
                        </div>
                    </div>
                </div>

                <div class="flex items-center mt-2">
                    <input type="checkbox" id="showPass" @click="show = !show"
                        class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <label for="showPass" class="ml-2 block text-sm text-gray-600 cursor-pointer select-none">
                        Tampilkan Password
                    </label>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all transform hover:-translate-y-0.5">
                    Daftar Sekarang
                </button>
            </div>
        </form>

        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold text-green-600 hover:text-green-500 transition-colors">
                    Masuk di sini
                </a>
            </p>
        </div>
    </div>
@endsection
