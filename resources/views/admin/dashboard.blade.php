@extends('layouts.admin-layout')
@section('title', 'Dashboard')
@section('content')
    <div class="space-y-6">
        <!-- 1. KARTU STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Pendapatan -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center">
                <div class="p-3 bg-green-50 rounded-xl text-green-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
                    <h3 class="text-xl font-bold text-gray-900">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                </div>
            </div>

            <!-- Total Pesanan -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center">
                <div class="p-3 bg-blue-50 rounded-xl text-blue-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pesanan</p>
                    <h3 class="text-xl font-bold text-gray-900">{{ $totalPesanan }}</h3>
                </div>
            </div>

            <!-- Total Produk -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center">
                <div class="p-3 bg-purple-50 rounded-xl text-purple-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Produk</p>
                    <h3 class="text-xl font-bold text-gray-900">{{ $totalProduk }}</h3>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center">
                <div class="p-3 bg-orange-50 rounded-xl text-orange-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Pelanggan</p>
                    <h3 class="text-xl font-bold text-gray-900">{{ $totalPelanggan }}</h3>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- 2. PESANAN TERBARU (KOLOM KIRI - LEBAR) -->
            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Pesanan Masuk Terbaru</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat
                        Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 rounded-lg">
                            <tr>
                                <th class="px-4 py-3">Invoice</th>
                                <th class="px-4 py-3">Pelanggan</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($pesananTerbaru as $order)
                                <tr class="hover:bg-gray-50 cursor-pointer"
                                    onclick="window.location='{{ route('admin.orders.show', $order->id) }}'">
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $order->invoice_code }}</td>
                                    <td class="px-4 py-3">{{ $order->user->name }}</td>
                                    <td class="px-4 py-3 font-bold text-gray-700">Rp
                                        {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @php
                                            $colors = [
                                                'menunggu_pembayaran' => 'bg-gray-100 text-gray-600',
                                                'menunggu_konfirmasi' => 'bg-yellow-100 text-yellow-700',
                                                'diproses' => 'bg-blue-100 text-blue-700',
                                                'dikirim' => 'bg-purple-100 text-purple-700',
                                                'selesai' => 'bg-green-100 text-green-700',
                                                'dibatalkan' => 'bg-red-100 text-red-700',
                                            ];
                                        @endphp
                                        <span
                                            class="px-2 py-1 rounded text-xs font-semibold {{ $colors[$order->status] ?? 'bg-gray-100' }}">
                                            {{ str_replace('_', ' ', ucfirst($order->status)) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">Belum ada pesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 3. SIDEBAR KANAN -->
            <div class="lg:col-span-1 space-y-6">

                <!-- Produk Terlaris -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                        Top 5 Produk Terlaris
                    </h3>
                    <ul class="space-y-4">
                        @forelse($produkTerlaris as $index => $item)
                            <li class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span
                                        class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold mr-3">{{ $index + 1 }}</span>
                                    <span
                                        class="text-sm font-medium text-gray-700 truncate w-32">{{ $item->product_name }}</span>
                                </div>
                                <span class="text-sm font-bold text-green-600">{{ $item->total_terjual }} Sold</span>
                            </li>
                        @empty
                            <li class="text-sm text-gray-500 text-center">Belum ada data penjualan.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Stok Menipis -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                        Stok Menipis / Habis
                    </h3>
                    <ul class="space-y-3">
                        @forelse($stokMenipis as $varian)
                            <li class="flex items-center justify-between bg-red-50 p-2 rounded-lg border border-red-100">
                                <div class="text-sm">
                                    <p class="font-medium text-gray-800">
                                        {{ $varian->product->product_name ?? 'Produk Dihapus' }}</p>
                                    <p class="text-xs text-gray-500">Ukuran: <b>{{ $varian->size }}</b></p>
                                </div>
                                <div class="text-right">
                                    <span
                                        class="text-sm font-bold {{ $varian->stock == 0 ? 'text-red-600' : 'text-orange-600' }}">
                                        {{ $varian->stock }}
                                    </span>
                                    <span class="text-[10px] text-gray-500">Pcs</span>
                                </div>
                            </li>
                        @empty
                            <li class="text-sm text-gray-500 text-center">Stok produk aman.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
