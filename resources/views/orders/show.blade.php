@extends('layouts.app-layout')

@section('title', 'Detail Pesanan #' . $order->invoice_code)

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">Detail Pesanan</h1>
                <a href="{{ route('orders.history') }}" class="text-sm text-gray-500 hover:text-gray-900">&larr; Kembali</a>
            </div>

            @if (session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                    {{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <!-- Header Status -->
                <div
                    class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row justify-between md:items-center gap-4">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase">Status Pesanan</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span
                                class="text-lg font-bold text-gray-900 capitalize">{{ str_replace('_', ' ', $order->status) }}</span>
                            @if ($order->status == 'dikirim')
                                <span class="animate-pulse flex h-3 w-3 rounded-full bg-green-500"></span>
                            @endif
                        </div>
                    </div>

                    @if ($order->status == 'menunggu_pembayaran')
                        <a href="{{ route('checkout.payment', $order->id) }}"
                            class="px-5 py-2 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700 text-center">
                            Lanjut Pembayaran
                        </a>
                    @elseif($order->status == 'dikirim')
                        <form action="{{ route('orders.complete', $order->id) }}" method="POST">
                            @csrf @method('PUT')
                            <button type="submit"
                                onclick="return confirm('Pastikan barang sudah diterima dengan baik. Lanjutkan?')"
                                class="px-5 py-2 bg-green-600 text-white text-sm font-bold rounded-lg hover:bg-green-700 w-full md:w-auto">
                                Konfirmasi Terima Barang
                            </button>
                        </form>
                    @endif
                </div>

                <!-- Nomor Resi (Jika Ada) -->
                @if ($order->resi_number)
                    <div class="bg-blue-50 px-6 py-4 border-b border-blue-100">
                        <p class="text-xs font-bold text-blue-600 uppercase">Nomor Resi Pengiriman</p>
                        <p class="text-xl font-mono font-bold text-gray-900 mt-1 select-all">{{ $order->resi_number }}</p>
                        <p class="text-xs text-blue-500 mt-1">Silakan cek di website ekspedisi terkait.</p>
                    </div>
                @endif

                <!-- List Item -->
                <div class="p-6">
                    <h3 class="text-sm font-bold text-gray-900 mb-4">Produk Dibeli</h3>
                    <div class="space-y-4">
                        @foreach ($order->items as $item)
                            <div class="flex gap-4">
                                <div class="w-16 h-16 bg-gray-100 rounded-md overflow-hidden shrink-0">
                                    @if ($item->variant && $item->variant->product)
                                        <img src="{{ asset('storage/' . $item->variant->product->thumbnail) }}"
                                            class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $item->product_name }}</h4>
                                    <p class="text-xs text-gray-500">Size: {{ $item->product_size }}</p>
                                    <p class="text-xs text-gray-500">{{ $item->quantity }} x Rp
                                        {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-gray-900">Rp
                                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Rincian Biaya -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Harga Barang</span>
                            <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkos Kirim</span>
                            <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div
                            class="flex justify-between font-bold text-gray-900 text-base pt-2 border-t border-gray-200 mt-2">
                            <span>Total Bayar</span>
                            <span>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alamat Pengiriman -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                <h3 class="text-sm font-bold text-gray-900 mb-3">Info Pengiriman</h3>
                <p class="text-sm text-gray-600 leading-relaxed">{{ $order->shipping_address }}</p>
                @if ($order->note)
                    <p class="text-sm text-gray-500 mt-3 italic">Catatan: "{{ $order->note }}"</p>
                @endif
            </div>

            <!-- Tombol Batalkan (Hanya jika belum diproses) -->
            @if (in_array($order->status, ['menunggu_pembayaran', 'menunggu_konfirmasi']))
                <div class="text-center">
                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                        @csrf @method('PUT')
                        <button type="submit" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')"
                            class="text-sm text-red-600 hover:text-red-800 hover:underline">
                            Batalkan Pesanan
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>
@endsection
