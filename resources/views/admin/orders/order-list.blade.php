@extends('layouts.admin-layout')
@section('title', 'Daftar Pesanan')
@section('header_title', 'Manajemen Pesanan')
@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <!-- Filter & Search -->
        <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
            <div class="flex gap-2 overflow-x-auto pb-2">
                <a href="{{ route('admin.orders.index') }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Semua
                </a>
                <a href="{{ route('admin.orders.index', ['status' => 'menunggu_konfirmasi']) }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap {{ request('status') == 'menunggu_konfirmasi' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Perlu Cek
                </a>
                <a href="{{ route('admin.orders.index', ['status' => 'diproses']) }}"
                    class="px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap {{ request('status') == 'diproses' ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Diproses
                </a>
            </div>

            <form action="{{ route('admin.orders.index') }}" method="GET" class="flex gap-2">
                @if (request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Invoice..."
                    class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                <button type="submit"
                    class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-black">Cari</button>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3">Invoice</th>
                        <th class="px-6 py-3">Pelanggan</th>
                        <th class="px-6 py-3">Total (Termasuk Ongkir)</th>
                        <th class="px-6 py-3">Resi</th>
                        <th class="px-6 py-3 text-center">Status</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-mono font-medium text-gray-900">{{ $order->invoice_code }}</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $order->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $order->created_at->format('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-700">Rp
                                {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 font-mono text-gray-500">{{ $order->resi_number ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $colors = [
                                        'menunggu_pembayaran' => 'bg-gray-200 text-gray-800',
                                        'menunggu_konfirmasi' => 'bg-yellow-100 text-yellow-800',
                                        'diproses' => 'bg-blue-100 text-blue-800',
                                        'dikirim' => 'bg-purple-100 text-purple-800',
                                        'selesai' => 'bg-green-100 text-green-800',
                                        'dibatalkan' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold {{ $colors[$order->status] ?? 'bg-gray-100' }}">
                                    {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="text-blue-600 hover:text-blue-900 font-bold border border-blue-200 px-3 py-1 rounded-lg hover:bg-blue-50 transition">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
