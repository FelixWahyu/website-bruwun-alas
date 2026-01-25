@extends('layouts.app-layout')
@section('title', 'Produk Detail - Bruwun Alas')
@section('content')
    <div class="bg-gray-50 min-h-screen py-10" x-data="productData()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex text-sm text-gray-500 mb-6">
                <a href="{{ route('home') }}" class="hover:text-red-600">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('katalogProduk') }}" class="hover:text-red-600">Katalog</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 font-medium">{{ $product->product_name }}</span>
            </nav>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 p-6 lg:p-10">

                    <div class="product-image-wrapper">
                        <div
                            class="aspect-w-1 aspect-h-1 rounded-2xl overflow-hidden bg-gray-100 border border-gray-200 relative group">
                            <span
                                class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-red-700 shadow-sm">
                                {{ $product->category->name }}
                            </span>

                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->product_name }}"
                                class="w-full h-full object-center object-cover transform transition duration-500 hover:scale-105 cursor-zoom-in">
                        </div>
                    </div>

                    <div class="mt-8 lg:mt-0 flex flex-col h-full">

                        <div class="mb-6 border-b border-gray-100 pb-6">
                            <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight mb-2">
                                {{ $product->product_name }}
                            </h1>
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span
                                    class="flex items-center gap-1 bg-red-50 text-red-700 px-2 py-1 rounded-md font-medium">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                    </svg>
                                    Berat: {{ $product->weight }}g
                                </span>
                                <span
                                    class="flex items-center gap-1 bg-blue-50 text-blue-700 px-2 py-1 rounded-md font-medium capitalize">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $product->gender }}
                                </span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <p class="text-sm text-gray-500 mb-1">Harga Satuan</p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-4xl font-extrabold text-red-600 tracking-tight"
                                    x-text="formatRupiah(currentPrice)"></span>
                                <span class="text-sm text-gray-400 font-medium" x-show="!selectedVariant">(Mulai
                                    dari)</span>
                            </div>
                        </div>

                        <div class="prose prose-sm text-gray-600 mb-8 leading-relaxed">
                            {!! nl2br(e($product->description)) !!}
                        </div>

                        <form action="{{ route('cart.store') }}" method="POST" class="mt-auto">
                            @csrf

                            <div class="mb-6">
                                <div class="flex justify-between items-center mb-3">
                                    <h3 class="text-sm font-bold text-gray-900">Pilih Ukuran</h3>
                                    <span class="text-xs font-medium"
                                        :class="{
                                            'text-red-500': stock > 0 && stock < 5,
                                            'text-blue-600': stock >=
                                                5,
                                            'text-gray-400': stock == 0
                                        }"
                                        x-text="stockInfo()">
                                    </span>
                                </div>

                                <div class="grid grid-cols-3 sm:grid-cols-5 gap-3">
                                    @foreach ($product->variants as $variant)
                                        <label
                                            class="group relative flex items-center justify-center rounded-xl border py-3 px-4 text-sm font-bold uppercase hover:bg-gray-50 focus:outline-none cursor-pointer shadow-sm transition-all duration-200"
                                            :class="{
                                                'ring-2 ring-red-500 border-transparent bg-red-50 text-red-700': selectedVariant ===
                                                    {{ $variant->id }},
                                                'border-gray-200 text-gray-900 bg-white': selectedVariant !==
                                                    {{ $variant->id }},
                                                'opacity-50 cursor-not-allowed bg-gray-50': {{ $variant->stock }} === 0
                                            }">

                                            <input type="radio" name="product_variant_id" value="{{ $variant->id }}"
                                                class="sr-only"
                                                @click="{{ $variant->stock }} > 0 ? selectVariant({{ $variant->id }}, {{ $variant->price }}, {{ $variant->stock }}) : null"
                                                {{ $variant->stock === 0 ? 'disabled' : '' }}>

                                            <span>{{ $variant->size }}</span>

                                            @if ($variant->stock === 0)
                                                <span class="absolute inset-0 border-2 border-gray-200 rounded-xl">
                                                    <svg class="absolute inset-0 w-full h-full text-gray-200 stroke-2"
                                                        viewBox="0 0 100 100" preserveAspectRatio="none"
                                                        stroke="currentColor">
                                                        <line x1="0" y1="100" x2="100" y2="0"
                                                            vector-effect="non-scaling-stroke" />
                                                    </svg>
                                                </span>
                                            @endif
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-100">
                                <div class="w-full sm:w-32 flex items-center border border-gray-300 rounded-xl">
                                    <button type="button" @click="qty > 1 ? qty-- : null"
                                        class="w-10 h-full text-gray-500 hover:text-red-600 focus:outline-none text-xl font-bold pb-1">-</button>
                                    <input type="number" name="quantity" x-model="qty" min="1"
                                        :max="stock"
                                        class="w-full text-center border-none focus:ring-0 text-gray-900 font-bold p-0 h-12 bg-transparent"
                                        readonly>
                                    <button type="button" @click="qty < stock ? qty++ : null"
                                        class="w-10 h-full text-gray-500 hover:text-red-600 focus:outline-none text-xl font-bold pb-1">+</button>
                                </div>

                                <button type="submit" :disabled="!selectedVariant || stock === 0"
                                    class="flex-1 w-full bg-red-600 border cursor-pointer border-transparent rounded-xl py-3 px-8 flex items-center justify-center text-base font-bold text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-200 transition-all shadow-lg hover:shadow-red-500/30 disabled:bg-gray-300 disabled:cursor-not-allowed disabled:shadow-none">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <span x-text="getButtonText()"></span>
                                </button>
                            </div>
                        </form>

                        <div class="mt-8 grid grid-cols-2 gap-4 text-xs text-gray-500">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Produk Asli UMKM</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Pengiriman Cepat</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function productData() {
            return {
                selectedVariant: null,
                currentPrice: {{ $product->variants->min('price') }},
                stock: 0,
                qty: 1,

                selectVariant(id, price, stock) {
                    this.selectedVariant = id;
                    this.currentPrice = price;
                    this.stock = stock;
                    this.qty = 1;
                },

                stockInfo() {
                    if (!this.selectedVariant) return 'Pilih varian untuk melihat stok';
                    if (this.stock === 0) return 'Stok Habis';
                    if (this.stock < 5) return 'Stok Menipis: Sisa ' + this.stock;
                    return 'Stok Tersedia: ' + this.stock;
                },

                getButtonText() {
                    if (!this.selectedVariant) return 'Pilih Ukuran Dulu';
                    if (this.stock === 0) return 'Stok Habis';
                    return 'Tambah ke Keranjang';
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(number);
                }
            }
        }
    </script>
@endsection
