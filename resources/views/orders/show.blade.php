@extends('layouts.app-layout')

@section('title', 'Detail Pesanan #' . $order->invoice_code)

@section('content')
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <a href="{{ route('orders.history') }}" class="hover:text-blue-600 transition">Riwayat Pesanan</a>
                    <span class="text-gray-300">/</span>
                    <span class="text-gray-900 font-medium">Detail Pesanan</span>
                </div>
                <a href="{{ route('orders.history') }}"
                    class="flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            @if (session('success'))
                <div
                    class="mb-6 bg-green-50 border border-green-100 text-green-700 p-4 rounded-xl flex items-center shadow-sm animate-fade-in-up">
                    <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">No. Invoice</p>
                                <div class="flex items-center gap-2">
                                    <h2 class="text-lg font-bold text-gray-900">#{{ $order->invoice_code }}</h2>
                                    <button onclick="navigator.clipboard.writeText('{{ $order->invoice_code }}')"
                                        class="text-gray-400 hover:text-blue-600 transition" title="Salin Invoice">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Tanggal Pesanan</p>
                                <p class="text-sm font-medium text-gray-900">{{ $order->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="relative flex items-center justify-between w-full mt-8 mb-4">
                            <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-200 -z-10">
                            </div>

                            @php
                                $steps = ['menunggu_pembayaran', 'diproses', 'dikirim', 'selesai'];
                                $currentStatus = $order->status;
                                // Handle canceled status differently
                                if ($currentStatus == 'menunggu_konfirmasi') {
                                    $currentStatus = 'menunggu_pembayaran';
                                }
                            @endphp

                            <div class="flex flex-col items-center bg-white px-2">
                                <div
                                    class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold {{ in_array($currentStatus, $steps) ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                    1
                                </div>
                                <span class="text-xs mt-2 font-medium text-gray-600">Dipesan</span>
                            </div>

                            <div class="flex flex-col items-center bg-white px-2">
                                <div
                                    class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold {{ in_array($currentStatus, array_slice($steps, 1)) ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                    2
                                </div>
                                <span class="text-xs mt-2 font-medium text-gray-600">Diproses</span>
                            </div>

                            <div class="flex flex-col items-center bg-white px-2">
                                <div
                                    class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold {{ in_array($currentStatus, array_slice($steps, 2)) ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                    3
                                </div>
                                <span class="text-xs mt-2 font-medium text-gray-600">Dikirim</span>
                            </div>

                            <div class="flex flex-col items-center bg-white px-2">
                                <div
                                    class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold {{ $currentStatus == 'selesai' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                    4
                                </div>
                                <span class="text-xs mt-2 font-medium text-gray-600">Selesai</span>
                            </div>
                        </div>

                        @if ($order->status == 'dibatalkan')
                            <div
                                class="mt-4 p-3 bg-red-50 text-red-700 text-sm rounded-lg text-center font-medium border border-red-100">
                                Pesanan ini telah dibatalkan.
                            </div>
                        @endif
                    </div>

                    @if ($order->resi_number)
                        <div
                            class="bg-blue-50 border border-blue-100 rounded-2xl p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-blue-600 uppercase tracking-wide">Nomor Resi</p>
                                    <p class="text-lg font-mono font-bold text-gray-900 select-all tracking-wide">
                                        {{ $order->resi_number }}</p>
                                </div>
                            </div>
                            <button onclick="navigator.clipboard.writeText('{{ $order->resi_number }}')"
                                class="px-4 py-2 bg-white text-blue-600 text-sm font-bold rounded-lg border border-blue-200 hover:bg-blue-50 transition">
                                Salin Resi
                            </button>
                        </div>
                    @endif

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h3 class="text-lg font-bold text-gray-900">Daftar Produk</h3>
                        </div>
                        <div class="p-6 space-y-6">
                            @foreach ($order->items as $item)
                                <div class="flex gap-4 sm:gap-6 items-start">
                                    <div
                                        class="h-20 w-20 sm:h-24 sm:w-24 bg-gray-100 rounded-xl overflow-hidden shrink-0 border border-gray-200">
                                        @if ($item->variant && $item->variant->product)
                                            <img src="{{ asset('storage/' . $item->variant->product->thumbnail) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start">
                                            <div>
                                                <h4 class="text-base font-bold text-gray-900 line-clamp-2">
                                                    {{ $item->product_name }}</h4>
                                                <p class="text-sm text-gray-500 mt-1">Varian: <span
                                                        class="text-gray-700 font-medium">{{ $item->product_size }}</span>
                                                </p>
                                            </div>
                                            <p class="text-sm font-bold text-gray-900 mt-2 sm:mt-0 text-right">
                                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <div class="mt-2 text-sm text-gray-500 flex items-center">
                                            <span>{{ $item->quantity }} x Rp
                                                {{ number_format($item->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <hr class="border-gray-50">
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-1 space-y-6">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">Ringkasan Pembayaran</h3>

                        <div class="space-y-3 text-sm pb-6 border-b border-gray-100">
                            <div class="flex justify-between text-gray-600">
                                <span>Total Harga Barang</span>
                                <span class="font-medium text-gray-900">Rp
                                    {{ number_format($order->total_pice, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Ongkos Kirim</span>
                                <span class="font-medium text-gray-900">Rp
                                    {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center py-4">
                            <span class="text-base font-bold text-gray-800">Total Belanja</span>
                            <span class="text-xl font-extrabold text-blue-600">Rp
                                {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                        </div>

                        <div class="mt-4 space-y-3">
                            @if ($order->status == 'menunggu_pembayaran')
                                <a href="{{ route('checkout.payment', $order->id) }}"
                                    class="block w-full text-center px-4 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg hover:shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                                    Bayar Sekarang
                                </a>
                            @elseif($order->status == 'dikirim')
                                <form action="{{ route('orders.complete', $order->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button type="submit"
                                        onclick="return confirm('Pastikan barang sudah diterima dengan baik. Lanjutkan?')"
                                        class="w-full px-4 py-3 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 shadow-lg hover:shadow-green-500/30 transition transform hover:-translate-y-0.5">
                                        Konfirmasi Terima Barang
                                    </button>
                                </form>
                            @endif

                            @if (in_array($order->status, ['menunggu_pembayaran', 'menunggu_konfirmasi']))
                                <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button type="submit"
                                        onclick="return confirm('Yakin ingin membatalkan pesanan ini?')"
                                        class="w-full px-4 py-3 bg-white border border-red-200 text-red-600 font-bold rounded-xl hover:bg-red-50 transition">
                                        Batalkan Pesanan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4">Alamat Pengiriman</h3>
                        <div class="flex items-start gap-3">
                            <div class="mt-1">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-600 leading-relaxed mt-1">{{ $order->shipping_address }}</p>
                                @if ($order->phone)
                                    <p class="text-sm text-gray-600 mt-1 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        {{ $order->phone }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        @if ($order->note)
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <p class="text-xs text-gray-500 uppercase font-bold mb-1">Catatan</p>
                                <p
                                    class="text-sm text-gray-600 italic bg-yellow-50 p-2 rounded-lg border border-yellow-100">
                                    "{{ $order->note }}"</p>
                            </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
