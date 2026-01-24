@extends('layouts.app-layout')
@section('title', 'Produk Detail - Bruwun Alas')
@section('content')
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">

            <div class="lg:grid lg:grid-cols-2 lg:gap-x-8" x-data="productData()">

                <div class="w-full aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->product_name }}"
                        class="w-full h-full object-center object-cover">
                </div>

                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->product_name }}</h1>

                    <div class="mt-3">
                        <p class="text-sm text-gray-500">{{ $product->category->name }} | Berat: {{ $product->weight }}g</p>
                    </div>

                    <div class="mt-4">
                        <p class="text-3xl text-red-600 font-bold">
                            <span x-text="formatRupiah(currentPrice)"></span>
                        </p>
                    </div>

                    <div class="mt-6">
                        <div class="text-base text-gray-700 space-y-6">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>

                    <form action="{{ route('cart.store') }}" method="POST" class="mt-8">
                        @csrf

                        <div class="mt-4">
                            <h3 class="text-sm text-gray-900 font-medium">Pilih Ukuran</h3>
                            <div class="mt-2 flex items-center space-x-3">
                                @foreach ($product->variants as $variant)
                                    <label
                                        class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer shadow-sm"
                                        :class="{
                                            'ring-2 ring-red-500 border-transparent': selectedVariant ===
                                                {{ $variant->id }},
                                            'border-gray-200': selectedVariant !==
                                                {{ $variant->id }}
                                        }">

                                        <input type="radio" name="product_variant_id" value="{{ $variant->id }}"
                                            class="sr-only"
                                            @click="selectVariant({{ $variant->id }}, {{ $variant->price }}, {{ $variant->stock }})">
                                        <span id="size-choice-{{ $variant->size }}-label">{{ $variant->size }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <p class="mt-2 text-sm text-red-600" x-show="stock > 0 && stock < 5">Stok menipis: <span
                                    x-text="stock"></span> tersisa!</p>
                            <p class="mt-2 text-sm text-gray-500" x-show="stock >= 5">Stok tersedia: <span
                                    x-text="stock"></span></p>
                        </div>

                        <div class="mt-8 flex items-center gap-4">
                            <div class="w-24">
                                <label for="quantity" class="sr-only">Quantity</label>
                                <input type="number" id="quantity" name="quantity" min="1" value="1"
                                    class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md p-3 border">
                            </div>

                            <button type="submit" :disabled="!selectedVariant || stock === 0"
                                class="w-full bg-red-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 disabled:bg-gray-400 disabled:cursor-not-allowed">
                                <span x-text="stock === 0 ? 'Stok Habis' : 'Tambah ke Keranjang'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function productData() {
            return {
                selectedVariant: null,
                currentPrice: {{ $product->variants->min('price') }}, // Default harga terendah
                stock: 0,

                selectVariant(id, price, stock) {
                    this.selectedVariant = id;
                    this.currentPrice = price;
                    this.stock = stock;
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
