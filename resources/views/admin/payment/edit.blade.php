@extends('layouts.admin-layout')

@section('title', 'Edit Rekening')
@section('header_title', 'Edit Metode Pembayaran')

@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 p-8">

        <div class="mb-6 border-b pb-4 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Edit Data Rekening</h2>
                <p class="text-sm text-gray-500">Perbarui informasi pembayaran.</p>
            </div>
            @if ($paymentMethod->logo)
                <img src="{{ asset('storage/' . $paymentMethod->logo) }}" class="h-10 w-auto">
            @endif
        </div>

        <form action="{{ route('admin.payment-method.update', $paymentMethod->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Nama Bank -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bank / E-Wallet</label>
                    <input type="text" name="bank_name" value="{{ old('bank_name', $paymentMethod->bank_name) }}"
                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nomor Rekening -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                        <input type="text" name="account_number"
                            value="{{ old('account_number', $paymentMethod->account_number) }}"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <!-- Atas Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Atas Nama</label>
                        <input type="text" name="account_name"
                            value="{{ old('account_name', $paymentMethod->account_name) }}"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                </div>

                <!-- Upload Logo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Logo (Opsional)</label>
                    <input type="file" name="logo"
                        class="w-full border border-gray-300 rounded-lg p-2 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        accept="image/*">
                </div>

                <!-- Status Aktif -->
                <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <input type="checkbox" name="is_active" id="is_active"
                        class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                        {{ $paymentMethod->is_active ? 'checked' : '' }}>
                    <label for="is_active" class="ml-3 text-sm font-medium text-gray-700 cursor-pointer">
                        Aktifkan Metode Pembayaran Ini
                    </label>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('admin.payment-method.index') }}"
                    class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
                <button type="submit"
                    class="px-5 py-2.5 text-sm font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-md">Simpan
                    Perubahan</button>
            </div>
        </form>
    </div>
@endsection
