@extends('layouts.admin-layout')

@section('title', 'Laporan Penjualan')
@section('header_title', 'Laporan Penjualan')

@section('content')
    <div class="space-y-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div
                class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between hover:shadow-md transition duration-200">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Pendapatan (Selesai/Dikirim)</p>
                    <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Rp
                        {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                    <p class="text-xs text-gray-400 mt-1">Dalam periode terpilih</p>
                </div>
                <div class="p-4 bg-green-50 rounded-2xl text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <div
                class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between hover:shadow-md transition duration-200">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Jumlah Transaksi</p>
                    <h3 class="text-2xl font-bold text-gray-900 tracking-tight">{{ $totalTransaksi }} <span
                            class="text-sm font-normal text-gray-400">Pesanan</span></h3>
                    <p class="text-xs text-gray-400 mt-1">Sesuai filter status</p>
                </div>
                <div class="p-4 bg-blue-50 rounded-2xl text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('admin.reports.index') }}" method="GET"
                class="flex flex-col xl:flex-row xl:items-end gap-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 flex-1">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Dari
                            Tanggal</label>
                        <input type="date" name="start_date" value="{{ $startDate }}"
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-gray-50 hover:bg-white cursor-pointer">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Sampai
                            Tanggal</label>
                        <input type="date" name="end_date" value="{{ $endDate }}"
                            class="block w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-gray-50 hover:bg-white cursor-pointer">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Status
                            Pesanan</label>
                        <div class="relative">
                            <select name="status"
                                class="block w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition appearance-none bg-gray-50 hover:bg-white cursor-pointer pr-10">
                                <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Semua Status</option>
                                <option value="menunggu_pembayaran"
                                    {{ $status == 'menunggu_pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                <option value="menunggu_konfirmasi"
                                    {{ $status == 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                <option value="diproses" {{ $status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="dikirim" {{ $status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="selesai" {{ $status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ $status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan
                                </option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 w-full xl:w-auto mt-2 xl:mt-0">
                    <button type="submit"
                        class="flex-1 cursor-pointer xl:flex-none justify-center inline-flex items-center px-6 py-2.5 bg-gray-800 hover:bg-gray-900 text-white text-sm font-bold rounded-xl transition shadow-lg hover:shadow-gray-500/30">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Terapkan Filter
                    </button>

                    <a href="{{ route('admin.reports.export', ['start_date' => $startDate, 'end_date' => $endDate, 'status' => $status]) }}"
                        class="flex-1 xl:flex-none justify-center inline-flex items-center px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-xl transition shadow-lg hover:shadow-green-500/30 whitespace-nowrap">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0l-4 4m4-4v12" />
                        </svg>
                        Export Excel
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-bold">
                            <th class="px-6 py-4">Tanggal & Invoice</th>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-right">Subtotal</th>
                            <th class="px-6 py-4 text-right">Ongkir</th>
                            <th class="px-6 py-4 text-right">Grand Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50/50 transition duration-150 group">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $order->created_at->format('d M Y') }}</span>
                                        <span
                                            class="text-xs font-mono text-gray-500 mt-0.5 group-hover:text-blue-600 transition">#{{ $order->invoice_code }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $badges = [
                                            'menunggu_pembayaran' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-600'],
                                            'menunggu_konfirmasi' => [
                                                'bg' => 'bg-yellow-100',
                                                'text' => 'text-yellow-700',
                                            ],
                                            'diproses' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700'],
                                            'dikirim' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-700'],
                                            'selesai' => ['bg' => 'bg-green-100', 'text' => 'text-green-700'],
                                            'dibatalkan' => ['bg' => 'bg-red-100', 'text' => 'text-red-700'],
                                        ];
                                        $style = $badges[$order->status] ?? $badges['menunggu_pembayaran'];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold uppercase tracking-wide {{ $style['bg'] }} {{ $style['text'] }}">
                                        {{ str_replace('_', ' ', $order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-sm text-gray-600">
                                    Rp {{ number_format($order->total_pice, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-right text-sm text-gray-600">
                                    Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-sm font-bold text-gray-900">
                                        Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-gray-900 font-medium text-lg">Data Tidak Ditemukan</h3>
                                        <p class="text-gray-500 text-sm mt-1">Coba sesuaikan filter tanggal atau status
                                            pesanan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    @if ($orders->count() > 0)
                        <tfoot class="bg-gray-50 border-t border-gray-200 font-bold text-gray-900 text-sm">
                            <tr>
                                <td colspan="5"
                                    class="px-6 py-4 text-right uppercase tracking-wider text-xs text-gray-500">Total
                                    Halaman Ini</td>
                                <td class="px-6 py-4 text-right text-base text-green-600">
                                    Rp {{ number_format($orders->sum('grand_total'), 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
