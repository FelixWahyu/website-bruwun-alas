@extends('layouts.admin-layout')
@section('title', 'Tambah Metode Pembayaran')
@section('header_title', 'Tambah Metode Pembayaran Baru')
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
                    <h2 class="text-xl font-bold text-gray-900">Form Rekening Baru</h2>
                    <p class="text-sm text-gray-500">Tambahkan bank atau e-wallet untuk pembayaran.</p>
                </div>
            </div>
            <form action="{{ route('admin.payment-method.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6 md:p-8">
                @csrf

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
                            <input type="text" name="bank_name" placeholder="Contoh: BCA, BRI, DANA"
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
                                <input type="number" name="account_number" placeholder="Nomor rekening..."
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
                                <input type="text" name="account_name" placeholder="Nama pemilik rekening"
                                    class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Logo Bank (Opsional)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-blue-50 hover:border-blue-400 transition group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                    <svg class="w-8 h-8 mb-2 text-gray-400 group-hover:text-blue-500 transition"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-1 text-sm text-gray-500"><span class="font-bold text-gray-700">Klik
                                            upload</span> atau drag and drop</p>
                                    <p class="text-xs text-gray-400">PNG, JPG (Max 1MB)</p>
                                </div>
                                <input id="dropzone-file" type="file" name="logo" class="hidden" accept="image/*"
                                    onchange="previewImage(event)" />
                            </label>
                        </div>
                        <div id="image-preview" class="mt-4 hidden p-2 border border-gray-200 rounded-lg w-fit bg-white">
                            <img src="" alt="Preview" class="h-16 w-auto object-contain">
                        </div>
                    </div>

                </div>

                <div class="pt-6 mt-8 border-t border-gray-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.payment-method.index') }}"
                        class="px-6 py-3 bg-white border border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition text-sm">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-green-600 cursor-pointer text-white font-bold rounded-xl hover:bg-green-700 hover:-translate-y-0.5 transition-all shadow-lg hover:shadow-green-500/30 text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Simpan Rekening
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.querySelector('#image-preview img');
                const container = document.getElementById('image-preview');
                output.src = reader.result;
                container.classList.remove('hidden');
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
