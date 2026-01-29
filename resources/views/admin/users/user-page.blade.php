@extends('layouts.admin-layout')

@section('title', 'Manajemen Pengguna')
@section('header_title', 'Data Pengguna')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
            <a href="{{ route('admin.users.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 flex items-center w-fit">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah User
            </a>

            <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-2">
                <!-- Tambahkan onchange disini -->
                <select name="role" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500"
                    onchange="this.form.submit()">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="owner" {{ request('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                    <option value="pelanggan" {{ request('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                </select>

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / Email..."
                    class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                <button type="submit"
                    class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-black">Cari</button>
            </form>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Email & Kontak</th>
                        <th class="px-6 py-3 text-center">Role</th>
                        <th class="px-6 py-3 text-center">Terdaftar</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                <div class="flex items-center">
                                    <div
                                        class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs mr-3">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-gray-900">{{ $user->email }}</div>
                                <div class="text-xs text-gray-500">{{ $user->phone ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $roleColor = match ($user->role) {
                                        'admin' => 'bg-purple-100 text-purple-800',
                                        'owner' => 'bg-blue-100 text-blue-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-bold uppercase {{ $roleColor }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center text-gray-500">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="text-blue-600 hover:text-blue-900 bg-blue-50 px-2 py-1 rounded">Edit</a>

                                    @if (auth()->id() !== $user->id)
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus user ini? Data pesanan terkait juga akan terhapus!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 bg-red-50 px-2 py-1 rounded">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection
