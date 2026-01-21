<aside :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-white border-r border-gray-200 lg:translate-x-0 lg:static lg:inset-0">

    <div class="flex items-center justify-center h-20 border-b border-gray-100">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center text-white shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            </div>
            <span class="text-xl font-bold text-gray-800">
                Bruwun<span class="text-green-600">Alas</span>
            </span>
        </a>
    </div>

    <nav class="mt-6 px-4 space-y-2">

        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>

        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-4 py-3 text-gray-600 transition-colors rounded-xl hover:bg-green-50 hover:text-green-700 group {{ request()->routeIs('admin.dashboard') ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-600" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            Dashboard
        </a>

        @if (Auth::user()->role == 'admin')
            <a href="#"
                class="flex items-center px-4 py-3 text-gray-600 transition-colors rounded-xl hover:bg-green-50 hover:text-green-700 group">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-600" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Kelola Produk
            </a>
            <a href="#"
                class="flex items-center px-4 py-3 text-gray-600 transition-colors rounded-xl hover:bg-green-50 hover:text-green-700 group">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-600" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Data Pengguna
            </a>
        @endif

        @if (Auth::user()->role == 'owner' || Auth::user()->role == 'admin')
            <a href="#"
                class="flex items-center px-4 py-3 text-gray-600 transition-colors rounded-xl hover:bg-green-50 hover:text-green-700 group">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-600" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Laporan Penjualan
            </a>
        @endif

        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-6 mb-2">Pengaturan</p>

        <a href="#"
            class="flex items-center px-4 py-3 text-gray-600 transition-colors rounded-xl hover:bg-green-50 hover:text-green-700 group">
            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-green-600" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Settings
        </a>
    </nav>
</aside>
