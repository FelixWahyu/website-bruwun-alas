@extends('layouts.admin-layout')
@section('title', 'Metode Pembayaran')
@section('header_title', 'Manajemen Rekning')
@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-800">Daftar Rekening</h3>
            <a href="{{ route('admin.payment-method.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Rekening
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3">Logo</th>
                        <th class="px-6 py-3">Bank / E-Wallet</th>
                        <th class="px-6 py-3">Nomor Rekening</th>
                        <th class="px-6 py-3">Atas Nama</th>
                        <th class="px-6 py-3 text-center">Status</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paymentMethods as $method)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">
                                @if ($method->logo)
                                    <img src="{{ asset('storage/' . $method->logo) }}" alt="Logo" class="h-8 w-auto">
                                @else
                                    <div
                                        class="h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center font-bold text-xs text-gray-500">
                                        {{ substr($method->bank_name, 0, 1) }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-900">{{ $method->bank_name }}</td>
                            <td class="px-6 py-4 font-mono">{{ $method->account_number }}</td>
                            <td class="px-6 py-4">{{ $method->account_name }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($method->is_active)
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Aktif</span>
                                @else
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">Non-Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.payment-method.edit', $method->id) }}"
                                        class="text-blue-600 hover:text-blue-900">Edit</a>
                                    <span class="text-gray-300">|</span>
                                    <form action="{{ route('admin.payment-method.destroy', $method->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus rekening ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data rekening.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
