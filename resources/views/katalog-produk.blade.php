@extends('layouts.app-layout')
@section('title', 'Katalog Produk - Bruwun Alas')
@section('content')
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 mb-8">Katalog Produk</h2>

            <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($products as $product)
                    <div
                        class="group relative bg-white border rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">
                        <div
                            class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden lg:h-80 lg:aspect-none">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->product_name }}"
                                class="w-full h-full object-center object-cover lg:w-full lg:h-full group-hover:opacity-75">
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm text-gray-700">
                                <a href="{{ route('product.detail', $product->slug) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product->product_name }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $product->category->name }}</p>

                            <p class="mt-2 text-lg font-medium text-red-600">
                                {{-- Tampilkan harga terendah dari varian --}}
                                Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
