@extends('layouts.app-layout')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Riwayat Pesanan</h1>
                <a href="{{ route('katalogProduk') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                    &larr; Lanjut Belanja
                </a>
            </div>

            @if ($orders->isEmpty())
                <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-100">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pesanan</h3>
                    <p class="mt-1 text-sm text-gray-500">Yuk mulai belanja produk lokal berkualitas!</p>
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div
                            class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Invoice</p>
                                        <p class="font-mono text-sm font-bold text-gray-900">{{ $order->invoice_code }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $order->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        @php
                                            $statusClasses = [
                                                'menunggu_pembayaran' => 'bg-yellow-100 text-yellow-800',
                                                'menunggu_konfirmasi' => 'bg-orange-100 text-orange-800',
                                                'diproses' => 'bg-blue-100 text-blue-800',
                                                'dikirim' => 'bg-purple-100 text-purple-800',
                                                'selesai' => 'bg-green-100 text-green-800',
                                                'dibatalkan' => 'bg-red-100 text-red-800',
                                            ];
                                            $label = str_replace('_', ' ', $order->status);
                                        @endphp
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $statusClasses[$order->status] ?? 'bg-gray-100' }}">
                                            {{ $label }}
                                        </span>
                                    </div>
                                </div>

                                <div class="border-t border-b border-gray-50 py-4 my-4">
                                    <div class="flex items-center gap-4">
                                        {{-- Tampilkan 1 gambar produk pertama sebagai preview --}}
                                        @php $firstItem = $order->items->first(); @endphp
                                        @if ($firstItem && $firstItem->variant && $firstItem->variant->product)
                                            <div class="h-16 w-16 bg-gray-100 rounded-md overflow-hidden shrink-0">
                                                <img src="{{ asset('storage/' . $firstItem->variant->product->thumbnail) }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900">{{ $firstItem->product_name }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    @if ($order->items->count() > 1)
                                                        + {{ $order->items->count() - 1 }} produk lainnya
                                                    @else
                                                        x {{ $firstItem->quantity }}
                                                    @endif
                                                </p>
                                            </div>
                                        @else
                                            <div class="text-sm text-gray-400 italic">Produk telah dihapus</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                                    <div>
                                        <p class="text-xs text-gray-500">Total Belanja</p>
                                        <p class="text-lg font-bold text-blue-600">Rp
                                            {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                                    </div>

                                    <div class="flex gap-3 w-full md:w-auto">
                                        @if ($order->status == 'menunggu_pembayaran')
                                            <a href="{{ route('checkout.payment', $order->id) }}"
                                                class="flex-1 md:flex-none text-center px-4 py-2 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700">
                                                Bayar Sekarang
                                            </a>
                                        @endif

                                        <a href="{{ route('orders.details', $order->id) }}"
                                            class="flex-1 md:flex-none text-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-bold rounded-lg hover:bg-gray-50">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
