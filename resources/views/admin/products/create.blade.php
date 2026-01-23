@extends('layouts.admin-layout')

@section('title', 'Tambah Produk')
@section('header_title', 'Tambah Produk Baru')

@section('content')
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p class="font-bold">Gagal Menyimpan:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- KOLOM KIRI: INFO UTAMA -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Card Informasi Dasar -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informasi Produk</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Produk</label>
                            <input type="text" name="product_name" value="{{ old('product_name') }}"
                                class="w-full px-3 py-2 border rounded focus:ring-primary focus:border-primary" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                            <select name="category_id"
                                class="w-full px-3 py-2 border rounded focus:ring-primary focus:border-primary">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4"
                            class="w-full px-3 py-2 border rounded focus:ring-primary focus:border-primary" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Berat (Gram)</label>
                            <input type="number" name="weight" value="{{ old('weight') }}" placeholder="Contoh: 500"
                                class="w-full px-3 py-2 border rounded focus:ring-primary focus:border-primary" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Foto Utama</label>
                            <input type="file" name="thumbnail"
                                class="w-full px-3 py-2 border rounded focus:ring-primary" accept="image/*" required>
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max: 2MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: VARIAN & HARGA -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Varian Ukuran</h3>
                    <p class="text-sm text-gray-500 mb-4">Centang ukuran yang tersedia.</p>

                    <div class="space-y-4">
                        @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                            <div class="border rounded p-3 bg-gray-50" x-data="{ active: false }">
                                <div class="flex items-center mb-2">
                                    <input type="checkbox" name="variants[{{ $size }}][enabled]"
                                        id="check_{{ $size }}"
                                        class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded"
                                        x-model="active">
                                    <label for="check_{{ $size }}"
                                        class="ml-2 block text-sm font-bold text-gray-900">
                                        Ukuran {{ $size }}
                                    </label>
                                </div>

                                <!-- Input Harga & Stok (Muncul jika dicentang) -->
                                <div x-show="active" x-transition class="grid grid-cols-2 gap-2 mt-2">
                                    <div>
                                        <label class="text-xs text-gray-600">Harga (Rp)</label>
                                        <input type="number" name="variants[{{ $size }}][price]" placeholder="0"
                                            class="w-full text-sm px-2 py-1 border rounded">
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-600">Stok</label>
                                        <input type="number" name="variants[{{ $size }}][stock]" placeholder="0"
                                            class="w-full text-sm px-2 py-1 border rounded">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 pt-4 border-t">
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg cursor-pointer transition shadow-lg">
                            Simpan Produk
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
