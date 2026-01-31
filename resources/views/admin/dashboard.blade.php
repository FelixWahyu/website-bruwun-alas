@extends('layouts.admin-layout')
@section('title', 'Dashboard')
@section('content')
    <div class="space-y-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-50 rounded-xl text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Pendapatan</p>
                <h3 class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Pesanan</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ $totalPesanan }}</h3>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-50 rounded-xl text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium text-gray-500 mb-1">Produk Aktif</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ $totalProduk }}</h3>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-orange-50 rounded-xl text-orange-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium text-gray-500 mb-1">Pelanggan Terdaftar</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ $totalPelanggan }}</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
            <div
                class="xl:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col h-full">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/30">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Pesanan Masuk Terbaru</h3>
                        <p class="text-sm text-gray-500">Pantau transaksi yang baru masuk.</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}"
                        class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition">
                        Lihat Semua
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 font-semibold border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4">Invoice</th>
                                <th class="px-6 py-4">Pelanggan</th>
                                <th class="px-6 py-4">Total</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($pesananTerbaru as $order)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4">
                                        <span class="font-mono font-medium text-gray-700">#{{ $order->invoice_code }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-linear-to-br from-blue-100 to-blue-200 flex items-center justify-center text-xs font-bold text-blue-700">
                                                {{ substr($order->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $order->user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-900">
                                        Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $statusStyles = [
                                                'menunggu_pembayaran' => 'bg-gray-100 text-gray-600',
                                                'menunggu_konfirmasi' =>
                                                    'bg-yellow-100 text-yellow-700 border border-yellow-200',
                                                'diproses' => 'bg-blue-100 text-blue-700 border border-blue-200',
                                                'dikirim' => 'bg-purple-100 text-purple-700 border border-purple-200',
                                                'selesai' => 'bg-green-100 text-green-700 border border-green-200',
                                                'dibatalkan' => 'bg-red-100 text-red-700 border border-red-200',
                                            ];
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $statusStyles[$order->status] ?? 'bg-gray-100 text-gray-600' }}">
                                            {{ str_replace('_', ' ', ucfirst($order->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                            class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-10 h-10 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                            </svg>
                                            <p>Belum ada pesanan masuk.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-8">

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                        <span class="p-1.5 bg-yellow-100 text-yellow-600 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </span>
                        Produk Terlaris
                    </h3>

                    <div class="space-y-5">
                        @forelse($produkTerlaris as $index => $item)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-500 font-bold text-xs group-hover:bg-yellow-100 group-hover:text-yellow-700 transition">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-gray-800 line-clamp-1 w-32"
                                            title="{{ $item->product_name }}">
                                            {{ $item->product_name }}
                                        </span>
                                        <div class="w-full bg-gray-100 rounded-full h-1.5 mt-1.5">
                                            <div class="bg-yellow-400 h-1.5 rounded-full"
                                                style="width: {{ rand(40, 90) }}%"></div>
                                        </div>
                                    </div>
                                </div>
                                <span
                                    class="text-xs font-bold text-gray-600 bg-gray-100 px-2 py-1 rounded-lg">{{ $item->total_terjual }}
                                    Sold</span>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 text-center py-4">Belum ada data penjualan.</p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                        <span class="p-1.5 bg-red-100 text-red-600 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </span>
                        Stok Menipis
                    </h3>

                    <div class="space-y-3">
                        @forelse($stokMenipis as $varian)
                            <div
                                class="flex items-center justify-between p-3 rounded-xl border border-red-100 bg-red-50/50 hover:bg-red-50 transition">
                                <div>
                                    <p class="text-sm font-bold text-gray-800 line-clamp-1 w-40">
                                        {{ $varian->product->product_name ?? 'Produk Dihapus' }}
                                    </p>
                                    <p class="text-xs text-red-500 font-medium mt-0.5">Varian: {{ $varian->size }}</p>
                                </div>
                                <div class="text-right">
                                    <span
                                        class="block text-sm font-extrabold {{ $varian->stock == 0 ? 'text-red-600' : 'text-orange-500' }}">
                                        {{ $varian->stock }}
                                    </span>
                                    <span class="text-[10px] text-gray-400 uppercase font-bold">Stok</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <svg class="w-10 h-10 text-green-200 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm text-green-600 font-medium">Semua stok aman!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
