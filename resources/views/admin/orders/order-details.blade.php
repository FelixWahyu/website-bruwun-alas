@extends('layouts.admin-layout')
@section('title', 'Detail Pesanan #' . $order->invoice_code)
@section('header_title', 'Detail Pesanan')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- KOLOM KIRI: INFO ITEM & ALAMAT -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Info Barang -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Item Pesanan</h3>
                <div class="space-y-4">
                    @foreach ($order->items as $item)
                        <div class="flex gap-4">
                            <div class="w-16 h-16 bg-gray-100 rounded-md overflow-hidden shrink-0">
                                @if ($item->product_variant_id)
                                    {{-- Logic ambil gambar via relasi agak panjang karena orderitem -> variant -> product --}}
                                    @php
                                        $img = \App\Models\ProductVariant::find($item->product_variant_id)?->product
                                            ->thumbnail;
                                    @endphp
                                    @if ($img)
                                        <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover">
                                    @endif
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">Del</div>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $item->product_name }}</h4>
                                <p class="text-sm text-gray-500">Size: {{ $item->product_size }} | {{ $item->quantity }} x
                                    Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="ml-auto font-bold text-gray-700">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 pt-4 border-t flex flex-col gap-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal Produk</span>
                        <span class="font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Ongkos Kirim (Otomatis)</span>
                        <span class="font-bold text-blue-600">Rp
                            {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-lg mt-2 pt-2 border-t">
                        <span class="font-bold text-gray-900">Total Dibayar</span>
                        <span class="font-bold text-green-600">Rp
                            {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Info Pengiriman & Catatan -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Pengiriman</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">Penerima</p>
                        <p class="text-gray-900 font-medium mt-1">{{ $order->user->name }}</p>
                        <p class="text-gray-600 text-sm">{{ $order->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold">Alamat Lengkap & Kurir</p>
                        <p class="text-gray-700 text-sm mt-1 leading-relaxed">{{ $order->shipping_address }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-xs text-gray-500 uppercase font-semibold">Catatan Pembeli</p>
                        <p class="text-gray-700 text-sm mt-1 italic">"{{ $order->note ?? 'Tidak ada catatan' }}"</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN: BUKTI & AKSI ADMIN -->
        <div class="lg:col-span-1 space-y-6">

            <!-- Bukti Pembayaran -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Bukti Pembayaran</h3>
                <div class="rounded-lg overflow-hidden border border-gray-200 cursor-pointer group relative"
                    onclick="window.open('{{ asset('storage/' . $order->proof_of_payment) }}', '_blank')">
                    <img src="{{ asset('storage/' . $order->proof_of_payment) }}"
                        class="w-full h-auto group-hover:opacity-90 transition">
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition bg-black/20">
                        <span class="text-white text-xs bg-black/50 px-2 py-1 rounded">Klik untuk perbesar</span>
                    </div>
                </div>
            </div>

            <!-- Form Update Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Proses Pesanan</h3>

                @if (session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded text-sm mb-3">{{ session('error') }}</div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded text-sm mb-3">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" x-data="{ status: '{{ $order->status }}' }">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Pesanan</label>
                        <select name="status" x-model="status"
                            class="w-full border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500">
                            <option value="menunggu_konfirmasi">Menunggu Konfirmasi</option>
                            <option value="diproses">Diproses (Sedang Dikemas)</option>
                            <option value="dikirim">Dikirim (Input Resi)</option>
                            <option value="selesai">Selesai</option>
                            <option value="dibatalkan">Dibatalkan</option>
                        </select>
                    </div>

                    <!-- Input Resi (Muncul jika status dikirim/selesai) -->
                    <div class="mb-6" x-show="status == 'dikirim' || status == 'selesai'" x-transition>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Resi Pengiriman</label>
                        <input type="text" name="resi_number" value="{{ old('resi_number', $order->resi_number) }}"
                            class="w-full border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 font-mono"
                            placeholder="Contoh: JP1234567890">
                        <p class="text-xs text-red-500 mt-1" x-show="status == 'dikirim'">*Wajib diisi jika status Dikirim
                        </p>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition">
                        Update Pesanan
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection
