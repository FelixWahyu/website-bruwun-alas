@extends('layouts.admin-layout')

@section('title', 'Tambah Kategori')
@section('header_title', 'Tambah Kategori Baru')

@section('content')
    <div class="max-w-2xl bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-lg font-semibold text-gray-700">Form Kategori</h4>
            <a href="{{ route('admin.category') }}" class="text-sm text-gray-500 hover:text-primary">
                &larr; Kembali
            </a>
        </div>

        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori</label>
                <input type="text" name="name" id="name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror"
                    placeholder="Contoh: Makanan Ringan" value="{{ old('name') }}" required>

                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs mt-1">Slug akan dibuat otomatis dari nama kategori.</p>
            </div>

            <div class="flex items-center justify-end mt-6">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg cursor-pointer focus:outline-none focus:shadow-outline transition">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
@endsection
