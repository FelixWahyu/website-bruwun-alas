@extends('layouts.app-layout')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">Akun Saya</h1>

            <div class="flex flex-col lg:flex-row gap-8">

                <aside class="lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                        <div class="p-6 bg-linear-to-br from-blue-600 to-blue-700 text-center">
                            <div class="inline-flex h-20 w-20 rounded-full bg-white p-1 mb-3 shadow-md">
                                <div
                                    class="h-full w-full rounded-full bg-blue-100 flex items-center justify-center text-2xl font-bold text-blue-700">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </div>
                            </div>
                            <h3 class="text-lg font-bold text-white truncate">{{ Auth::user()->name }}</h3>
                            <p class="text-blue-100 text-sm truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <nav class="p-3 space-y-1">
                            <a href="{{ route('profile') }}"
                                class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium rounded-xl transition">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Edit Profil
                            </a>
                            <a href="{{ route('orders.history') }}"
                                class="flex items-center px-4 py-3 bg-blue-50 text-blue-700 font-bold rounded-xl transition">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                Riwayat Pesanan
                            </a>
                            <form method="POST" action="{{ route('logout') }}" id="form-logout-pesanan">
                                @csrf
                                <button type="submit" onclick="confirmLogout(event,'form-logout-pesanan')"
                                    class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 font-medium rounded-xl transition">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </nav>
                    </div>
                </aside>

                <div class="lg:w-3/4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 min-h-125">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">Riwayat Pesanan</h2>

                        @if ($orders->isEmpty())
                            <div class="flex flex-col items-center justify-center py-16 text-center">
                                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Belum ada pesanan</h3>
                                <p class="text-gray-500 mt-1 mb-6">Yuk mulai belanja produk lokal berkualitas!</p>
                                <a href="{{ route('katalogProduk') }}"
                                    class="px-6 py-3 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition shadow-lg hover:-translate-y-0.5">
                                    Mulai Belanja
                                </a>
                            </div>
                        @else
                            <div class="space-y-6">
                                @foreach ($orders as $order)
                                    <div
                                        class="border border-gray-200 rounded-xl overflow-hidden hover:border-blue-300 transition duration-300">

                                        <div
                                            class="bg-gray-50 px-6 py-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200">
                                            <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-6">
                                                <div>
                                                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">
                                                        Tanggal</p>
                                                    <p class="text-sm font-medium text-gray-900">
                                                        {{ $order->created_at->format('d M Y') }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">
                                                        Invoice</p>
                                                    <p class="text-sm font-mono font-medium text-gray-900">
                                                        #{{ $order->invoice_code }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">
                                                        Total</p>
                                                    <p class="text-sm font-bold text-gray-900">Rp
                                                        {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                                                </div>
                                            </div>

                                            <div>
                                                @php
                                                    $statusStyles = [
                                                        'menunggu_pembayaran' =>
                                                            'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                        'menunggu_konfirmasi' =>
                                                            'bg-orange-100 text-orange-800 border-orange-200',
                                                        'diproses' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                        'dikirim' => 'bg-purple-100 text-purple-800 border-purple-200',
                                                        'selesai' => 'bg-green-100 text-green-800 border-green-200',
                                                        'dibatalkan' => 'bg-red-100 text-red-800 border-red-200',
                                                    ];
                                                @endphp
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-bold uppercase border {{ $statusStyles[$order->status] ?? 'bg-gray-100 text-gray-600' }}">
                                                    {{ str_replace('_', ' ', $order->status) }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="p-6">
                                            <div class="flex flex-col md:flex-row gap-6 items-center">

                                                @php $firstItem = $order->items->first(); @endphp
                                                <div class="flex-1 w-full flex items-center gap-4">
                                                    @if ($firstItem && $firstItem->variant && $firstItem->variant->product)
                                                        <div
                                                            class="h-20 w-20 bg-gray-100 rounded-lg overflow-hidden shrink-0 border border-gray-200">
                                                            <img src="{{ asset('storage/' . $firstItem->variant->product->thumbnail) }}"
                                                                class="w-full h-full object-cover">
                                                        </div>
                                                        <div>
                                                            <h4 class="font-bold text-gray-900 line-clamp-1">
                                                                {{ $firstItem->product_name }}</h4>
                                                            <p class="text-sm text-gray-500 mt-1">
                                                                Size: {{ $firstItem->variant->size }} | Qty:
                                                                {{ $firstItem->quantity }}
                                                            </p>
                                                            @if ($order->items->count() > 1)
                                                                <p class="text-xs text-blue-600 font-medium mt-2">
                                                                    +{{ $order->items->count() - 1 }} produk lainnya
                                                                </p>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="text-sm text-gray-400 italic">Info produk tidak tersedia
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="w-full md:w-auto flex flex-col sm:flex-row gap-3">
                                                    @if ($order->status == 'menunggu_pembayaran')
                                                        <a href="{{ route('checkout.payment', $order->id) }}"
                                                            class="px-5 py-2.5 bg-green-600 text-white text-sm font-bold rounded-xl hover:bg-green-700 shadow-md hover:-translate-y-0.5 transition text-center whitespace-nowrap">
                                                            Bayar Sekarang
                                                        </a>
                                                    @endif

                                                    <a href="{{ route('orders.details', $order->id) }}"
                                                        class="px-5 py-2.5 border border-gray-300 text-gray-700 text-sm font-bold rounded-xl hover:bg-gray-50 hover:text-gray-900 transition text-center whitespace-nowrap">
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

            </div>
        </div>
    </div>
@endsection
