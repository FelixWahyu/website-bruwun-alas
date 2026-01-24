@extends('layouts.admin-layout')

@section('title', 'Daftar Produk')
@section('header_title', 'Manajemen Produk')

@section('content')
    <div class="space-y-6">
        <div
            class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
            <form action="{{ route('admin.products.index') }}" method="GET" class="w-full md:w-96 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    placeholder="Cari nama produk...">
            </form>

            <a href="{{ route('admin.products.create') }}"
                class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Produk
            </a>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                            <th class="px-6 py-4">Informasi Produk</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4 text-center">Stok</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50/80 transition duration-150 ease-in-out group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="h-14 w-14 rounded-lg bg-gray-100 border border-gray-200 overflow-hidden shrink-0">
                                            <img class="h-full w-full object-cover group-hover:scale-105 transition duration-300"
                                                src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://placehold.co/100?text=No+Image' }}"
                                                alt="{{ $product->product_name }}">
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-gray-900">{{ $product->product_name }}</div>
                                            <div class="text-xs text-gray-500 mt-0.5">ID: #{{ $product->id }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                        {{ $product->category->name ?? 'Uncategorized' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @php $totalStock = $product->variants->sum('stock'); @endphp
                                    <div class="flex flex-col items-center">
                                        <span
                                            class="text-sm font-bold {{ $totalStock == 0 ? 'text-red-600' : 'text-gray-900' }}">
                                            {{ $totalStock }}
                                        </span>
                                        <span class="text-[10px] text-gray-400 mt-0.5">
                                            {{ $product->variants->count() }} Varian
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($product->is_active)
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-600 mr-1.5"></span> Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-600 mr-1.5"></span> Non-Aktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="p-2 bg-white border border-gray-200 rounded-lg text-gray-500 hover:text-yellow-600 hover:border-yellow-300 hover:shadow-sm transition"
                                            title="Edit Produk">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="confirmDelete(event)"
                                                class="p-2 bg-white border border-gray-200 cursor-pointer rounded-lg text-gray-500 hover:text-red-600 hover:border-red-300 hover:shadow-sm transition"
                                                title="Hapus Produk">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                        </div>
                                        <h3 class="text-gray-900 font-medium text-lg">Tidak ada produk ditemukan</h3>
                                        <p class="text-gray-500 text-sm mt-1 mb-6">Mulai dengan menambahkan produk baru ke
                                            inventaris Anda.</p>
                                        <a href="{{ route('admin.products.create') }}"
                                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition">
                                            + Tambah Produk Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($products->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-2xl">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
