@extends('layouts.admin-layout')
@section('title', 'Detail Pesanan #' . $order->invoice_code)
@section('header_title', 'Detail Pesanan')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Item Pesanan</h3>
                    <span class="text-sm text-gray-500 font-mono">#{{ $order->invoice_code }}</span>
                </div>

                <div class="space-y-6">
                    @foreach ($order->items as $item)
                        <div class="flex gap-4 items-start">
                            <div class="w-20 h-20 bg-gray-50 rounded-xl overflow-hidden shrink-0 border border-gray-100">
                                @php
                                    $img = \App\Models\ProductVariant::find($item->product_variant_id)?->product
                                        ->thumbnail;
                                @endphp
                                @if ($img)
                                    <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 text-sm md:text-base">{{ $item->product_name }}</h4>
                                <div
                                    class="text-sm text-gray-500 mt-1 flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
                                    <span class="bg-gray-100 px-2 py-0.5 rounded text-xs font-medium">Size:
                                        {{ $item->product_size }}</span>
                                    <span>{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="font-bold text-gray-900 text-right">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 pt-6 border-t border-dashed border-gray-200 flex flex-col gap-3">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Subtotal Produk</span>
                        <span class="font-medium">Rp {{ number_format($order->total_pice, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Ongkos Kirim</span>
                        <span class="font-medium">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-lg pt-4 border-t border-gray-100 mt-2">
                        <span class="font-bold text-gray-900">Total Pembayaran</span>
                        <span class="font-extrabold text-green-600">Rp
                            {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Informasi Pengiriman
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-2">Penerima</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm">
                                {{ substr($order->user->name, 0, 2) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $order->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-2">Alamat Lengkap</p>
                        <p class="text-sm text-gray-700 leading-relaxed bg-gray-50 p-3 rounded-lg border border-gray-100">
                            {{ $order->shipping_address }}
                        </p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-2">Catatan Pembeli</p>
                        @if ($order->note)
                            <p class="text-sm text-gray-600 italic bg-yellow-50 p-3 rounded-lg border border-yellow-100">
                                "{{ $order->note }}"
                            </p>
                        @else
                            <p class="text-sm text-gray-400 italic">- Tidak ada catatan -</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <div class="lg:col-span-1 space-y-6">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    Proses Pesanan
                </h3>

                @if (session('error'))
                    <div
                        class="bg-red-50 text-red-700 p-3 rounded-lg text-sm mb-4 border border-red-100 flex items-start gap-2">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div
                        class="bg-green-50 text-green-700 p-3 rounded-lg text-sm mb-4 border border-green-100 flex items-start gap-2">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" x-data="{ status: '{{ $order->status }}' }">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Status
                            Pesanan</label>
                        <div class="relative">
                            <select name="status" x-model="status"
                                class="w-full appearance-none bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition cursor-pointer font-medium text-gray-700">
                                <option value="menunggu_konfirmasi">Menunggu Konfirmasi</option>
                                <option value="diproses">Diproses (Sedang Dikemas)</option>
                                <option value="dikirim">Dikirim (Input Resi)</option>
                                <option value="selesai">Selesai</option>
                                <option value="dibatalkan">Dibatalkan</option>
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6" x-show="status == 'dikirim' || status == 'selesai'" x-transition>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Nomor
                            Resi</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <input type="text" name="resi_number"
                                value="{{ old('resi_number', $order->resi_number) }}"
                                class="w-full pl-10 pr-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 font-mono tracking-wide placeholder-gray-400"
                                placeholder="Masukkan No. Resi">
                        </div>
                        <p class="text-xs text-blue-600 mt-2 flex items-center gap-1" x-show="status == 'dikirim'">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Wajib diisi untuk status Dikirim
                        </p>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition shadow-lg hover:shadow-blue-500/30 flex justify-center items-center gap-2">
                        <span>Simpan Perubahan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Bukti Pembayaran
                </h3>

                <div class="rounded-xl overflow-hidden border border-gray-200 cursor-zoom-in group relative shadow-sm"
                    onclick="window.open('{{ asset('storage/' . $order->proof_of_payment) }}', '_blank')">
                    <img src="{{ asset('storage/' . $order->proof_of_payment) }}"
                        class="w-full h-auto transform transition duration-500 group-hover:scale-105">

                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center text-white">
                        <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider">Perbesar</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
