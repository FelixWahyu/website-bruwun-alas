@extends('layouts.admin-layout')

@section('title', 'Edit Rekening')
@section('header_title', 'Edit Metode Pembayaran')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="mb-3 px-8 pt-4 flex items-center gap-3">
                <div class="p-2 bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Edit Data Rekening</h2>
                    <p class="text-sm text-gray-500">Perbarui informasi pembayaran untuk <span
                            class="font-semibold text-gray-800">{{ $paymentMethod->bank_name }}</span>.</p>
                </div>
            </div>
            <form action="{{ route('admin.payment-method.update', $paymentMethod->id) }}" method="POST"
                enctype="multipart/form-data" class="p-6 md:p-8">
                @csrf
                @method('PUT')

                <div class="space-y-6">

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Bank / E-Wallet</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <input type="text" name="bank_name" value="{{ old('bank_name', $paymentMethod->bank_name) }}"
                                class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Nomor Rekening</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                                <input type="text" name="account_number"
                                    value="{{ old('account_number', $paymentMethod->account_number) }}"
                                    class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition font-mono"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5">Atas Nama</label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="account_name"
                                    value="{{ old('account_name', $paymentMethod->account_name) }}"
                                    class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Logo Bank (Opsional)</label>

                        <div class="flex items-start gap-4">
                            @if ($paymentMethod->logo)
                                <div
                                    class="shrink-0 w-24 h-24 border border-gray-200 rounded-xl p-2 bg-white flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $paymentMethod->logo) }}" alt="Logo Saat Ini"
                                        class="max-w-full max-h-full object-contain">
                                </div>
                            @endif

                            <div class="flex-1">
                                <input type="file" name="logo"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-200 rounded-xl cursor-pointer bg-gray-50 focus:outline-none"
                                    accept="image/*">
                                <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengganti logo.</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <label class="flex items-center cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" name="is_active" class="sr-only peer"
                                    {{ $paymentMethod->is_active ? 'checked' : '' }}>
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                </div>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900">Aktifkan Metode Pembayaran Ini</span>
                        </label>
                    </div>

                </div>

                <div class="pt-6 mt-8 border-t border-gray-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.payment-method.index') }}"
                        class="px-6 py-3 bg-white border border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition text-sm">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 cursor-pointer text-white font-bold rounded-xl hover:bg-blue-700 hover:-translate-y-0.5 transition-all shadow-lg hover:shadow-blue-500/30 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
