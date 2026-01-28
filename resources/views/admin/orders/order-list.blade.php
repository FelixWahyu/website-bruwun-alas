@extends('layouts.admin-layout')
@section('title', 'Daftar Pesanan')
@section('header_title', 'Manajemen Pesanan')
@section('content')
    <div class="space-y-6">
        <div
            class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <div class="flex overflow-x-auto pb-2 lg:pb-0 hide-scrollbar gap-2 w-full lg:w-auto">
                @php
                    $tabs = [
                        '' => 'Semua',
                        'menunggu_konfirmasi' => 'Perlu Cek',
                        'diproses' => 'Diproses',
                        'dikirim' => 'Dikirim',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Batal',
                    ];
                @endphp

                @foreach ($tabs as $key => $label)
                    <a href="{{ route('admin.orders.index', ['status' => $key]) }}"
                        class="px-4 py-2 rounded-xl text-sm font-medium transition-all whitespace-nowrap
                       {{ request('status') == $key ? 'bg-gray-900 text-white shadow-md' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <form action="{{ route('admin.orders.index') }}" method="GET" class="w-full lg:w-auto relative">
                @if (request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Invoice / Nama..."
                    class="pl-10 pr-4 py-2.5 w-full lg:w-64 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent bg-gray-50 hover:bg-white transition">
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                            <th class="px-6 py-4">Invoice & Tanggal</th>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Resi</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50/50 transition duration-150">

                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-bold text-gray-900 font-mono">#{{ $order->invoice_code }}</span>
                                        <span class="text-xs text-gray-500 mt-1 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-linear-to-br from-blue-100 to-blue-200 text-blue-700 flex items-center justify-center text-xs font-bold border border-blue-200">
                                            {{ substr($order->user->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-green-700 bg-green-50 px-2 py-1 rounded-md">
                                        Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusStyles = [
                                            'menunggu_pembayaran' => [
                                                'bg' => 'bg-gray-100',
                                                'text' => 'text-gray-600',
                                            ],
                                            'menunggu_konfirmasi' => [
                                                'bg' => 'bg-yellow-100',
                                                'text' => 'text-yellow-700',
                                            ],
                                            'diproses' => [
                                                'bg' => 'bg-blue-100',
                                                'text' => 'text-blue-700',
                                            ],
                                            'dikirim' => [
                                                'bg' => 'bg-purple-100',
                                                'text' => 'text-purple-700',
                                            ],
                                            'selesai' => [
                                                'bg' => 'bg-green-100',
                                                'text' => 'text-green-700',
                                            ],
                                            'dibatalkan' => [
                                                'bg' => 'bg-red-100',
                                                'text' => 'text-red-700',
                                            ],
                                        ];
                                        $style = $statusStyles[$order->status] ?? $statusStyles['menunggu_pembayaran'];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $style['bg'] }} {{ $style['text'] }} border border-opacity-20 border-gray-400">
                                        {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($order->resi_number)
                                        <div class="flex items-center justify-center gap-1 group cursor-pointer relative">
                                            <span
                                                class="font-mono text-sm text-gray-700 bg-gray-100 px-2 py-1 rounded select-all">{{ $order->resi_number }}</span>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400 italic">-</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 border border-transparent hover:border-blue-200 transition"
                                        title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                            </svg>
                                        </div>
                                        <h3 class="text-gray-900 font-medium text-lg">Belum ada pesanan</h3>
                                        <p class="text-gray-500 text-sm mt-1">Pesanan yang masuk akan muncul di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($orders->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
