@extends('layouts.admin-layout')

@section('title', 'Tambah Pengguna')
@section('header_title', 'Tambah Pengguna Baru')

@section('content')
    <div class="max-w-2xl bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border-gray-300 rounded-lg focus:ring-blue-500" required>
                    @error('name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500" required>
                        @error('email')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                        <input type="number" name="phone" value="{{ old('phone') }}"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role (Hak Akses)</label>
                    <select name="role" class="w-full border-gray-300 rounded-lg focus:ring-blue-500" required>
                        <option value="pelanggan">Pelanggan</option>
                        <option value="admin">Admin</option>
                        <option value="owner">Owner</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" class="w-full border-gray-300 rounded-lg focus:ring-blue-500"
                            required minlength="8">
                        @error('password')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500" required>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}"
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Batal</a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-bold">Simpan User</button>
            </div>
        </form>
    </div>
@endsection
