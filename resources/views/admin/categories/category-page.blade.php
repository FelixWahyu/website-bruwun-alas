@extends('layouts.admin-layout')
@section('title', 'Kategori Product')
@section('header_title', 'Manajmen Kategori')
@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-700">Daftar Kategori</h3>
            <a href="{{ route('admin.category.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                + Tambah Kategori
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            No
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama Kategori
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Slug
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Jumlah Produk
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-medium">
                                {{ $category->name }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-500">
                                {{ $category->slug }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <span class="bg-gray-100 text-gray-600 py-1 px-3 rounded-full text-xs">
                                    {{ $category->products->count() }}
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.category.edit', $category->id) }}"
                                        class="text-yellow-600 hover:text-yellow-700 bg-yellow-100 hover:bg-yellow-200 py-1 px-2 rounded-lg">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.category.destroy', $category->id) }}" id="form-hapus"
                                        method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-700 cursor-pointer bg-red-100 hover:bg-red-200 py-1 px-2 rounded-lg">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-gray-500">
                                Belum ada data kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
