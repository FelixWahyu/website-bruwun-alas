@extends('layouts.admin-layout')

@section('title', 'Edit Produk')
@section('header_title', 'Edit Produk : ' . $product->product_name)

@section('content')
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 text-red-700 animate-fade-in-up">
            <div class="flex">
                <div class="shrink-0">
                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Gagal memperbarui produk:</h3>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <div class="lg:col-span-2 space-y-8">

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Informasi Dasar
                    </h3>

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                            <input type="text" name="product_name"
                                value="{{ old('product_name', $product->product_name) }}" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-sm">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <div class="relative">
                                    <select name="category_id"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-sm appearance-none bg-white">
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Berat (Gram)</label>
                                <div class="relative">
                                    <input type="number" name="weight" value="{{ old('weight', $product->weight) }}"
                                        required
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-sm">
                                    <div
                                        class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400 text-sm">
                                        gr
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                            <div class="relative">
                                <select name="gender"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-sm appearance-none bg-white">

                                    <option value="unisex"
                                        {{ old('gender', $product->gender) == 'unisex' ? 'selected' : '' }}>
                                        Unisex (Semua)
                                    </option>

                                    <option value="pria"
                                        {{ old('gender', $product->gender) == 'pria' ? 'selected' : '' }}>
                                        Pria
                                    </option>

                                    <option value="wanita"
                                        {{ old('gender', $product->gender) == 'wanita' ? 'selected' : '' }}>
                                        Wanita
                                    </option>

                                    <option value="anak"
                                        {{ old('gender', $product->gender) == 'anak' ? 'selected' : '' }}>
                                        Anak-anak
                                    </option>

                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Produk</label>
                            <textarea name="description" rows="5" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition text-sm">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="pt-4">
                            <label class="flex items-center cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" name="is_active" id="is_active" class="sr-only peer"
                                        {{ $product->is_active ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                    </div>
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-900">Tampilkan produk ini di katalog toko
                                    (Aktif)</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Foto Produk
                    </h3>

                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        @if ($product->thumbnail)
                            <div
                                class="shrink-0 w-32 h-32 rounded-xl border border-gray-200 overflow-hidden relative group">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Preview"
                                    class="w-full h-full object-cover">
                                <div
                                    class="absolute inset-0 bg-black/50 flex items-center justify-center text-white text-xs opacity-0 group-hover:opacity-100 transition">
                                    Foto Saat Ini
                                </div>
                            </div>
                        @endif

                        <div
                            class="grow w-full border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-gray-50 transition cursor-pointer relative flex flex-col justify-center min-h-32">
                            <input type="file" name="thumbnail"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                            <div class="space-y-1">
                                <div class="mx-auto h-10 w-10 text-gray-400">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <span class="font-medium text-blue-600 hover:text-blue-500">Ganti Foto</span>
                                    (Opsional)
                                </div>
                                <p class="text-xs text-gray-400">Biarkan kosong jika tidak ingin mengubah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Varian & Harga
                    </h3>
                    <p class="text-sm text-gray-500 mb-6">Atur harga dan stok untuk setiap ukuran.</p>

                    <div class="space-y-3">
                        @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                            @php
                                $variant = $product->variants->where('size', $size)->first();
                                $hasVariant = $variant ? true : false;
                            @endphp

                            <div class="border border-gray-200 rounded-xl p-3 bg-white hover:border-blue-200 transition"
                                x-data="{ active: {{ $hasVariant ? 'true' : 'false' }} }">

                                <div class="flex items-center justify-between">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="variants[{{ $size }}][enabled]"
                                            class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition"
                                            x-model="active" {{ $hasVariant ? 'checked' : '' }}>
                                        <span class="ml-3 font-semibold text-gray-700">Ukuran {{ $size }}</span>
                                    </label>
                                </div>

                                <div x-show="active" x-transition
                                    class="mt-4 pt-3 border-t border-gray-100 grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-xs font-semibold text-gray-500 uppercase">Harga (Rp)</label>
                                        <input type="number" name="variants[{{ $size }}][price]"
                                            value="{{ $variant ? $variant->price : '' }}" placeholder="0"
                                            class="w-full mt-1 px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="text-xs font-semibold text-gray-500 uppercase">Stok</label>
                                        <input type="number" name="variants[{{ $size }}][stock]"
                                            value="{{ $variant ? $variant->stock : '' }}" placeholder="0"
                                            class="w-full mt-1 px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-6">
                    <button type="submit"
                        class="w-full flex justify-center items-center px-6 py-3.5 cursor-pointer bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg hover:shadow-blue-500/30 hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Perbarui Produk
                    </button>
                    <a href="{{ route('admin.products.index') }}"
                        class="w-full mt-3 flex justify-center items-center px-6 py-3 bg-gray-50 hover:bg-gray-100 text-gray-600 font-semibold rounded-xl border border-gray-200 transition">
                        Batal
                    </a>
                </div>

            </div>
        </div>
    </form>
@endsection
