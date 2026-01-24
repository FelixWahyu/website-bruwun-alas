@extends('layouts.app-layout')
@section('title', 'Katalog Produk - Bruwun Alas')
@section('content')
    <div class="bg-red-50 py-16 border-b border-red-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-2">
                Katalog Produk Lokal
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto text-sm md:text-base">
                Temukan berbagai olahan makanan, kerajinan, dan cinderamata otentik karya masyarakat Bruwun Alas.
            </p>
        </div>
    </div>

    <div class="bg-white min-h-screen">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
                <div class="w-full md:w-1/3 relative">
                    <form action="" method="GET">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" placeholder="Cari produk..."
                            class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-full text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition bg-gray-50 hover:bg-white focus:bg-white"
                            value="{{ request('search') }}">
                    </form>
                </div>

                <div class="flex items-center gap-3 w-full md:w-auto overflow-x-auto pb-2 md:pb-0 no-scrollbar">
                    <a href="#"
                        class="px-4 py-2 text-sm font-medium rounded-full bg-red-600 text-white shadow-md transition whitespace-nowrap">
                        Semua
                    </a>
                    <a href="#"
                        class="px-4 py-2 text-sm font-medium rounded-full bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 hover:border-red-300 transition whitespace-nowrap">
                        Makanan
                    </a>
                    <a href="#"
                        class="px-4 py-2 text-sm font-medium rounded-full bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 hover:border-red-300 transition whitespace-nowrap">
                        Kerajinan
                    </a>
                    <a href="#"
                        class="px-4 py-2 text-sm font-medium rounded-full bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 hover:border-red-300 transition whitespace-nowrap">
                        Fashion
                    </a>
                </div>
            </div>

            @if ($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-10 gap-x-8">
                    @foreach ($products as $product)
                        <div
                            class="group relative bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 flex flex-col h-full hover:-translate-y-1">

                            <div
                                class="relative w-full aspect-w-1 aspect-h-1 bg-gray-100 rounded-t-2xl overflow-hidden h-64">
                                <span
                                    class="absolute top-3 left-3 z-10 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider text-red-700 shadow-sm">
                                    {{ $product->category->name }}
                                </span>

                                <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://placehold.co/400x400?text=No+Image' }}"
                                    alt="{{ $product->product_name }}"
                                    class="w-full h-full object-center object-cover transition-transform duration-700 group-hover:scale-110">

                                <div
                                    class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <a href="{{ route('product.detail', $product->slug) }}"
                                        class="px-6 py-2 bg-white text-gray-900 font-bold rounded-full transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-red-600 hover:text-white shadow-lg text-sm">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>

                            <div class="p-5 flex-1 flex flex-col">
                                <h3
                                    class="text-lg font-bold text-gray-900 mb-1 line-clamp-1 group-hover:text-red-700 transition-colors">
                                    <a href="{{ route('product.detail', $product->slug) }}">
                                        {{ $product->product_name }}
                                    </a>
                                </h3>

                                <p class="text-sm text-gray-500 mb-4 line-clamp-2 flex-1">
                                    {{ Str::limit(strip_tags($product->description), 60) }}
                                </p>

                                <div class="flex items-center justify-between mt-auto pt-4">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-400">Harga mulai</span>
                                        <span class="text-lg font-extrabold text-red-600">
                                            Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-20 bg-gray-50 rounded-3xl border border-dashed border-gray-300">
                    <div
                        class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Produk Tidak Ditemukan</h3>
                    <p class="text-gray-500 mt-2">Coba kata kunci lain atau reset filter pencarian Anda.</p>
                    <a href="{{ url()->current() }}"
                        class="inline-block mt-6 px-6 py-2 bg-white border border-gray-300 rounded-full text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Reset Pencarian
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
