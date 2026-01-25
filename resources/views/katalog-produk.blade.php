@extends('layouts.app-layout')
@section('title', 'Katalog Produk - Bruwun Alas')
@section('content')
    <div class="bg-red-50/50 py-20 border-b border-red-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-4">
                    Katalog Produk <span class="text-red-600">Lokal</span>
                </h1>
                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                    Jelajahi ragam olahan makanan, kerajinan tangan, dan cinderamata otentik hasil karya tangan terampil
                    masyarakat Bruwun Alas.
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white min-h-screen" x-data="{ showMobileFilter: false }">

        <div class="sticky top-20 z-30 bg-white/95 backdrop-blur-sm border-b border-gray-100 shadow-sm lg:hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
                <button @click="showMobileFilter = true"
                    class="flex items-center text-gray-600 cursor-pointer hover:text-red-600 font-medium text-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    Filter & Pencarian
                </button>
                <span class="text-xs text-gray-400">Menampilkan {{ $products->count() }} Produk</span>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
            <div class="flex flex-col lg:flex-row gap-10">

                <aside class="lg:w-1/4 shrink-0">
                    <div x-show="showMobileFilter" x-transition:enter="transition-opacity ease-linear duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition-opacity ease-linear duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="fixed inset-0 bg-black/50 z-40 lg:hidden" @click="showMobileFilter = false" x-cloak></div>

                    <div :class="{ 'translate-x-0': showMobileFilter, '-translate-x-full': !showMobileFilter }"
                        class="fixed inset-y-0 left-0 w-80 bg-white shadow-2xl z-50 p-6 overflow-y-auto transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:w-full lg:shadow-none lg:p-0 lg:bg-transparent lg:z-auto lg:overflow-visible">

                        <div class="flex justify-between items-center mb-6 lg:hidden">
                            <h2 class="text-xl font-bold text-gray-900">Filter Produk</h2>
                            <button @click="showMobileFilter = false"
                                class="p-2 rounded-full hover:bg-gray-100 text-gray-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('katalogProduk') }}" method="GET" class="space-y-8">
                            <div>
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3">Pencarian</h3>
                                <div class="relative">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:outline-0 focus:ring-red-500 focus:border-transparent transition"
                                        placeholder="Cari produk...">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-gray-100">
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Kategori</h3>
                                <div class="space-y-3">
                                    @foreach ($categories as $cat)
                                        <label class="flex items-center group cursor-pointer">
                                            <input type="checkbox" name="category[]" value="{{ $cat->id }}"
                                                class="h-5 w-5 text-red-600 focus:ring-red-500 border-gray-300 rounded transition cursor-pointer"
                                                {{ in_array($cat->id, request('category', [])) ? 'checked' : '' }}>
                                            <span
                                                class="ml-3 text-gray-600 group-hover:text-red-700 text-sm transition">{{ $cat->name }}</span>
                                            <span
                                                class="ml-auto text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $cat->products_count }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="pt-6 border-t border-gray-100">
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Peruntukan</h3>
                                <div class="space-y-3">
                                    @foreach (['pria' => 'Pria', 'wanita' => 'Wanita', 'anak' => 'Anak-anak', 'unisex' => 'Unisex'] as $key => $label)
                                        <label class="flex items-center group cursor-pointer">
                                            <input type="checkbox" name="gender[]" value="{{ $key }}"
                                                class="h-5 w-5 text-red-600 focus:ring-red-500 border-gray-300 rounded transition cursor-pointer"
                                                {{ in_array($key, request('gender', [])) ? 'checked' : '' }}>
                                            <span
                                                class="ml-3 text-gray-600 group-hover:text-red-700 text-sm transition">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="pt-6 border-t border-gray-100 space-y-3">
                                <button type="submit"
                                    class="w-full bg-red-600 cursor-pointer text-white font-bold py-3 rounded-xl hover:bg-red-700 transition shadow-lg shadow-red-500/30">
                                    Terapkan Filter
                                </button>
                                @if (request()->has('search') || request()->has('category') || request()->has('gender'))
                                    <a href="{{ route('katalogProduk') }}"
                                        class="block w-full text-center py-2.5 text-sm text-gray-500 font-medium hover:text-red-600 hover:bg-red-50 rounded-xl transition">
                                        Reset Filter
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </aside>

                <div class="flex-1">
                    @if ($products->isEmpty())
                        <div
                            class="flex flex-col items-center justify-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-sm mb-4">
                                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Produk tidak ditemukan</h3>
                            <p class="text-gray-500 text-sm mt-2 max-w-xs text-center">Maaf, kami tidak dapat menemukan
                                produk yang sesuai dengan filter Anda.</p>
                            <a href="{{ route('katalogProduk') }}"
                                class="mt-6 text-red-600 font-semibold hover:text-red-800 flex items-center">
                                Hapus semua filter <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8">
                            @foreach ($products as $product)
                                <div
                                    class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full overflow-hidden">
                                    <div class="relative w-full pt-[100%] bg-gray-100 overflow-hidden">
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                            alt="{{ $product->product_name }}"
                                            class="absolute top-0 left-0 w-full h-full object-center object-cover transition-transform duration-700 group-hover:scale-110">
                                        <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                                            <span
                                                class="bg-white/95 backdrop-blur-sm text-red-800 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                                {{ $product->category->name }}
                                            </span>
                                        </div>

                                        @php
                                            $colors = [
                                                'pria' => 'bg-blue-500',
                                                'wanita' => 'bg-pink-500',
                                                'anak' => 'bg-yellow-500',
                                                'unisex' => 'bg-purple-500',
                                            ];
                                        @endphp
                                        <div
                                            class="absolute top-3 right-3 {{ $colors[$product->gender] ?? 'bg-gray-500' }} text-white text-[10px] font-bold px-2 py-1 rounded uppercase shadow-sm">
                                            {{ $product->gender }}
                                        </div>

                                        <div
                                            class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                            <a href="{{ route('product.detail', $product->slug) }}"
                                                class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 bg-white text-gray-900 font-bold py-2 px-6 rounded-full shadow-lg hover:bg-red-600 hover:text-white text-sm">
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>

                                    <div class="p-5 flex flex-col grow">
                                        <h3
                                            class="text-lg font-bold text-gray-900 mb-1 leading-snug line-clamp-2 group-hover:text-red-600 transition-colors">
                                            <a href="{{ route('product.detail', $product->slug) }}">
                                                {{ $product->product_name }}
                                            </a>
                                        </h3>

                                        <div
                                            class="mt-auto pt-4 flex items-center justify-between border-t border-gray-50">
                                            <div>
                                                <p class="text-xs text-gray-400 mb-0.5">Mulai dari</p>
                                                <p class="text-xl font-extrabold text-red-600">
                                                    Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}
                                                </p>
                                            </div>
                                            <a href="{{ route('product.detail', $product->slug) }}"
                                                class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-red-600 group-hover:text-white transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-12">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
