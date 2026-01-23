@extends('layouts.admin-layout')

@section('title', 'Edit Kategori')
@section('header_title', 'Edit Kategori')

@section('content')
    <div class="max-w-2xl bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-lg font-semibold text-gray-700">Edit Data Kategori</h4>
            <a href="{{ route('admin.category') }}" class="text-sm text-gray-500 hover:text-primary">
                &larr; Kembali
            </a>
        </div>

        <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori</label>
                <input type="text" name="name" id="name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror"
                    value="{{ old('name', $category->name) }}" required>

                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-6">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition">
                    Update Kategori
                </button>
            </div>
        </form>
    </div>
@endsection
