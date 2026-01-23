@extends('layouts.admin-layout')

@section('title', 'Edit Produk')
@section('header_title', 'Edit Produk')

@section('content')
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- INFO UTAMA -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informasi Produk</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Produk</label>
                            <input type="text" name="product_name"
                                value="{{ old('product_name', $product->product_name) }}"
                                class="w-full px-3 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                            <select name="category_id" class="w-full px-3 py-2 border rounded">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" class="w-full px-3 py-2 border rounded" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Berat (Gram)</label>
                            <input type="number" name="weight" value="{{ old('weight', $product->weight) }}"
                                class="w-full px-3 py-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Foto (Biarkan kosong jika tidak
                                ganti)</label>
                            <input type="file" name="thumbnail" class="w-full px-3 py-2 border rounded" accept="image/*">
                            @if ($product->thumbnail)
                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                    class="h-20 w-20 object-cover mt-2 rounded border">
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_active" class="form-checkbox h-5 w-5 text-primary"
                                {{ $product->is_active ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700 font-bold">Produk Aktif (Tampilkan di Katalog)</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- VARIAN UKURAN -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Varian Ukuran</h3>

                    <div class="space-y-4">
                        @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                            @php
                                // Cek apakah produk ini punya varian size ini
                                $variant = $product->variants->where('size', $size)->first();
                                $hasVariant = $variant ? true : false;
                            @endphp

                            <div class="border rounded p-3 bg-gray-50" x-data="{ active: {{ $hasVariant ? 'true' : 'false' }} }">
                                <div class="flex items-center mb-2">
                                    <input type="checkbox" name="variants[{{ $size }}][enabled]"
                                        id="check_{{ $size }}" class="h-4 w-4 text-primary rounded"
                                        x-model="active" {{ $hasVariant ? 'checked' : '' }}>
                                    <label for="check_{{ $size }}"
                                        class="ml-2 block text-sm font-bold text-gray-900">
                                        Ukuran {{ $size }}
                                    </label>
                                </div>

                                <div x-show="active" class="grid grid-cols-2 gap-2 mt-2">
                                    <div>
                                        <label class="text-xs text-gray-600">Harga</label>
                                        <input type="number" name="variants[{{ $size }}][price]"
                                            value="{{ $variant ? $variant->price : '' }}"
                                            class="w-full text-sm px-2 py-1 border rounded">
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-600">Stok</label>
                                        <input type="number" name="variants[{{ $size }}][stock]"
                                            value="{{ $variant ? $variant->stock : '' }}"
                                            class="w-full text-sm px-2 py-1 border rounded">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 pt-4 border-t">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded transition shadow-lg">
                            Update Produk
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
