@extends('layouts.app-layout')
@section('title', 'Pesanan Berhasil')
@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-12" x-data="{ show: false }"
        x-init="setTimeout(() => show = true, 200)">

        <div class="max-w-md w-full bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative transition-all duration-700 transform"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">

            <div class="absolute top-0 left-0 w-full h-2 bg-linear-to-r from-blue-400 via-teal-500 to-teal-600"></div>

            <div class="p-8 text-center">
                <div class="mb-6 relative inline-block">
                    <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto animate-pulse">
                        <div
                            class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center shadow-lg shadow-green-500/40">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <h1 class="text-2xl font-extrabold text-gray-900 mb-2">Pesanan Diterima!</h1>
                <p class="text-gray-500 text-sm mb-6">Terima kasih telah berbelanja di Bruwun Alas.</p>

                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 mb-8">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Kode Invoice / Order ID</p>
                    <p class="text-xl font-mono font-bold text-gray-800 tracking-wide select-all">
                        {{ $order->invoice_code }}
                    </p>
                </div>

                <div class="text-left mb-8">
                    <h3 class="text-sm font-bold text-gray-900 mb-4">Status Pesanan Saat Ini:</h3>

                    <div class="relative pl-4 border-l-2 border-gray-200 space-y-6">
                        <div class="relative">
                            <div
                                class="absolute -left-5.25 bg-green-500 h-4 w-4 rounded-full border-2 border-white ring-2 ring-green-100">
                            </div>
                            <p class="text-sm font-bold text-gray-800">Pembayaran Diupload</p>
                            <p class="text-xs text-gray-500">Bukti bayar berhasil dikirim.</p>
                        </div>

                        <div class="relative">
                            <div
                                class="absolute -left-5.25 bg-yellow-400 h-4 w-4 rounded-full border-2 border-white ring-2 ring-yellow-100 animate-pulse">
                            </div>
                            <p class="text-sm font-bold text-gray-800">Menunggu Konfirmasi Admin</p>
                            <p class="text-xs text-gray-500">Admin sedang mengecek pembayaran Anda.</p>
                        </div>

                        <div class="relative opacity-50">
                            <div class="absolute -left-5.25 bg-gray-300 h-4 w-4 rounded-full border-2 border-white"></div>
                            <p class="text-sm font-bold text-gray-800">Pesanan Diproses</p>
                            <p class="text-xs text-gray-500">Barang dikemas dan dikirim.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('orders.history') }}"
                        class="block w-full bg-blue-600 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-green-500/30 hover:bg-blue-700 hover:-translate-y-0.5 transition-all duration-200">
                        Cek Status Pesanan
                    </a>
                    <a href="{{ route('home') }}"
                        class="block w-full bg-white text-gray-600 font-bold py-3.5 rounded-xl border border-gray-200 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
