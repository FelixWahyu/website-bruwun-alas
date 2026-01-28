@extends('layouts.app-layout')
@section('title', 'Pembayaran')
@section('content')
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Selesaikan Pembayaran</h2>
                <p class="text-sm text-gray-500 mt-2">Order ID: #{{ $order->invoice_code }}</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Total Amount -->
                <div class="bg-blue-600 px-6 py-8 text-center text-white">
                    <p class="text-sm font-medium opacity-90 mb-1">Total yang harus dibayar</p>
                    <h1 class="text-4xl font-bold">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</h1>
                    <p class="text-xs mt-2 bg-blue-700/50 inline-block px-3 py-1 rounded-full text-blue-100">
                        Batas waktu: 8 Jam
                    </p>
                </div>

                <!-- Bank Info -->
                <div class="p-6 border-b border-gray-100">
                    <p class="text-sm text-gray-500 mb-4">Silakan transfer ke rekening berikut:</p>
                    <div class="flex items-center p-4 border border-blue-100 bg-blue-50 rounded-xl">
                        @if ($bank->logo)
                            <img src="{{ asset('storage/' . $bank->logo) }}" class="h-8 w-auto mr-4">
                        @else
                            <div
                                class="h-10 w-10 bg-blue-200 rounded-full flex items-center justify-center font-bold text-blue-700 mr-4">
                                {{ substr($bank->bank_name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <p class="font-bold text-gray-900 text-lg">{{ $bank->bank_name }}</p>
                            <p class="font-mono text-xl text-gray-800 tracking-wide select-all">{{ $bank->account_number }}
                            </p>
                            <p class="text-xs text-gray-500 uppercase">A.N. {{ $bank->account_name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Upload Form -->
                <div class="p-6">
                    <form action="{{ route('checkout.updatePayment', $order->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sudah Transfer? Upload Bukti
                                Disini</label>

                            <label for="proof"
                                class="mt-1 flex flex-col justify-center items-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition cursor-pointer">

                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="text-sm text-gray-600">
                                        <span class="font-medium text-blue-600 hover:text-blue-500">Upload file</span>
                                        <span class="pl-1">atau drag and drop</span>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                </div>

                                {{-- Input File dipindah kesini --}}
                                <input id="proof" name="proof_of_payment" type="file" class="sr-only" required
                                    accept="image/*" @change="fileName = $event.target.files[0].name">
                            </label>

                            {{-- Menampilkan nama file yang dipilih (UX Improvement) --}}
                            <div x-show="fileName"
                                class="mt-3 p-3 bg-green-50 text-green-700 text-sm rounded-lg flex items-center justify-center animate-fade-in-up">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span x-text="fileName"></span>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                            Konfirmasi Pembayaran
                        </button>

                        <div class="mt-4 text-center">
                            <a href="{{ route('orders.history') }}"
                                class="text-sm text-gray-500 hover:text-gray-900 underline">Bayar Nanti (Masuk ke
                                Riwayat)</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
