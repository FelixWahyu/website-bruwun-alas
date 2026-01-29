@extends('layouts.admin-layout')
@section('title', 'Tambah Metode Pembayaran')
@section('header_title', 'Tambah Metode Pembayaran Baru')
@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 p-8">

        <div class="mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-gray-800">Informasi Rekening</h2>
            <p class="text-sm text-gray-500">Tambahkan bank atau e-wallet baru untuk penerimaan pembayaran.</p>
        </div>

        <form action="{{ route('admin.payment-method.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <!-- Nama Bank -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bank / E-Wallet</label>
                    <input type="text" name="bank_name"
                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Contoh: BCA, DANA, GOPAY" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nomor Rekening -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                        <input type="number" name="account_number"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="0123456789" required>
                    </div>

                    <!-- Atas Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Atas Nama</label>
                        <input type="text" name="account_name"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Admin Bruwun Alas" required>
                    </div>
                </div>

                <!-- Upload Logo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Logo Bank (Opsional)</label>
                    <input type="file" name="logo"
                        class="w-full border border-gray-300 rounded-lg p-2 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        accept="image/*">
                    <p class="mt-1 text-xs text-gray-500">Format: PNG, JPG (Max 1MB)</p>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('admin.payment-method.index') }}"
                    class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                <button type="submit"
                    class="px-5 py-2.5 text-sm font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-md">Simpan
                    Rekening</button>
            </div>
        </form>
    </div>
@endsection
