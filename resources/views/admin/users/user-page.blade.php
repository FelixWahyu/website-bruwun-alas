@extends('layouts.admin-layout')

@section('title', 'Manajemen Pengguna')
@section('header_title', 'Data Pengguna')

@section('content')
    <div class="space-y-6">

        <div
            class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-4 rounded-2xl shadow-sm border border-gray-100">

            <form action="{{ route('admin.users.index') }}" method="GET" class="w-full md:w-96 relative group">
                <input type="hidden" name="role" value="{{ request('role') }}">
                <div
                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-600 transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama, email, atau no.hp..."
                    class="block w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition"
                    onblur="this.form.submit()">
            </form>

            <div class="flex items-center gap-3 w-full md:w-auto">
                <div class="relative w-full md:w-48">
                    <form action="{{ route('admin.users.index') }}" method="GET">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <select name="role" onchange="this.form.submit()"
                            class="w-full appearance-none bg-white border border-gray-200 text-gray-700 py-2.5 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm font-medium cursor-pointer">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="owner" {{ request('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                            <option value="pelanggan" {{ request('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan
                            </option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </form>
                </div>

                <a href="{{ route('admin.users.create') }}"
                    class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-0.5 whitespace-nowrap">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah User
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-xl bg-green-50 border border-green-100"
                role="alert">
                <svg class="shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                            <th class="px-6 py-4">Pengguna</th>
                            <th class="px-6 py-4">Kontak</th>
                            <th class="px-6 py-4 text-center">Role</th>
                            <th class="px-6 py-4 text-center">Terdaftar</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50/50 transition duration-150">

                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="h-10 w-10 rounded-full bg-linear-to-br from-blue-100 to-blue-200 flex items-center justify-center text-blue-700 font-bold text-sm shadow-sm ring-2 ring-white">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    @if ($user->phone)
                                        <div
                                            class="flex items-center text-sm text-gray-600 bg-gray-50 px-3 py-1 rounded-lg w-fit border border-gray-100">
                                            <svg class="w-3 h-3 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            {{ $user->phone }}
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400 italic">Tidak ada no.hp</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @php
                                        $badges = [
                                            'admin' => [
                                                'bg' => 'bg-purple-50',
                                                'text' => 'text-purple-700',
                                                'border' => 'border-purple-100',
                                            ],
                                            'owner' => [
                                                'bg' => 'bg-blue-50',
                                                'text' => 'text-blue-700',
                                                'border' => 'border-blue-100',
                                            ],
                                            'pelanggan' => [
                                                'bg' => 'bg-green-50',
                                                'text' => 'text-green-700',
                                                'border' => 'border-green-100',
                                            ],
                                        ];
                                        $style = $badges[$user->role] ?? [
                                            'bg' => 'bg-gray-50',
                                            'text' => 'text-gray-600',
                                            'border' => 'border-gray-200',
                                        ];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wide {{ $style['bg'] }} {{ $style['text'] }} border {{ $style['border'] }}">
                                        {{ $user->role }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="text-xs font-medium text-gray-500 bg-gray-50 px-2 py-1 rounded">
                                        {{ $user->created_at->format('d M Y') }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="p-2 bg-white border border-gray-200 rounded-lg text-gray-500 hover:text-yellow-600 hover:border-yellow-300 hover:shadow-sm transition"
                                            title="Edit Pengguna">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        @if (auth()->id() !== $user->id)
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="confirmDelete(event)"
                                                    class="p-2 bg-white border border-gray-200 cursor-pointer rounded-lg text-gray-500 hover:text-red-600 hover:border-red-300 hover:shadow-sm transition"
                                                    title="Hapus Pengguna">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <span
                                                class="p-2 bg-white border border-gray-200 rounded-lg text-gray-300 cursor-not-allowed"
                                                title="Anda sedang login">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-gray-900 font-medium text-lg">Tidak ada pengguna ditemukan</h3>
                                        <p class="text-gray-500 text-sm mt-1">Coba ubah kata kunci pencarian atau filter
                                            role.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
