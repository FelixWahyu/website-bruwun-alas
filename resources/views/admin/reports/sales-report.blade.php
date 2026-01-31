@extends('layouts.admin-layout')

@section('title', 'Laporan Penjualan')
@section('header_title', 'Laporan Penjualan')

@section('content')
    <div class="space-y-6">
        <!-- Card Ringkasan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex items-center">
                <div class="p-3 bg-green-50 rounded-xl text-green-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Pendapatan Periode Ini</p>
                    <h3 class="text-xl font-bold text-gray-900">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex items-center">
                <div class="p-3 bg-blue-50 rounded-xl text-blue-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Transaksi Selesai</p>
                    <h3 class="text-xl font-bold text-gray-900">{{ $totalTransaksi }}</h3>
                </div>
            </div>
        </div>

        <!-- Filter & Export -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('admin.reports.index') }}" method="GET"
                class="flex flex-col md:flex-row items-end gap-4 mb-6">
                <div class="w-full md:w-auto">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                    <input type="date" name="start_date" value="{{ $startDate }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500">
                </div>
                <div class="w-full md:w-auto">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                    <input type="date" name="end_date" value="{{ $endDate }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500">
                </div>
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit"
                        class="bg-blue-600 cursor-pointer text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition w-full md:w-auto">
                        Filter Data
                    </button>

                    <a href="{{ route('admin.reports.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-green-700 transition flex items-center justify-center w-full md:w-auto">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0l-4 4m4-4v12"></path>
                        </svg>
                        Export Excel
                    </a>
                </div>
            </form>

            <!-- Table Data -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Invoice</th>
                            <th class="px-6 py-3">Pelanggan</th>
                            <th class="px-6 py-3 text-right">Total Belanja</th>
                            <th class="px-6 py-3 text-right">Ongkir</th>
                            <th class="px-6 py-3 text-right">Grand Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-900">{{ $order->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 font-mono font-medium">{{ $order->invoice_code }}</td>
                                <td class="px-6 py-4">{{ $order->user->name }}</td>
                                <td class="px-6 py-4 text-right">Rp {{ number_format($order->total_pice, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-right">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-green-600">Rp
                                    {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">Tidak ada data penjualan pada
                                    periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
