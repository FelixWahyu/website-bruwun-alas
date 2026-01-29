<aside :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-white border-r border-gray-200 lg:translate-x-0 lg:static lg:inset-0">

    <div class="flex items-center justify-center h-20 border-b border-gray-100">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center text-white shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            </div>
            <span class="text-xl font-bold text-gray-800">
                Bruwun<span class="text-red-600">Alas</span>
            </span>
        </a>
    </div>

    <nav class="mt-6 px-4 space-y-2">

        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Manajemen</p>

        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center text-sm px-4 py-3 text-gray-600 transition-colors rounded-xl hover:bg-red-50 hover:text-red-700 group {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-600 font-semibold' : '' }}">
            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-600 {{ request()->routeIs('admin.dashboard') || request()->routeIs('owner.dashboard') ? 'text-red-600' : '' }}"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            Dashboard
        </a>

        @if (Auth::user()->role == 'admin')
            <a href="{{ route('admin.category.index') }}"
                class="flex items-center text-sm px-4 py-3 text-gray-600 transition-colors rounded-xl hover:bg-red-50 hover:text-red-700 group {{ request()->routeIs('admin.category.*') ? 'bg-red-50 text-red-600 font-semibold' : '' }}">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-600 {{ request()->routeIs('admin.category.*') ? 'text-red-600' : '' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                    </path>
                </svg>
                Kelola Kategori
            </a>
            <a href="{{ route('admin.products.index') }}"
                class="flex items-center text-sm px-4 py-3 text-gray-600 transition-colors rounded-xl hover:bg-red-50 hover:text-red-700 group {{ request()->routeIs('admin.products.*') ? 'bg-red-50 text-red-600 font-semibold' : '' }}">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-600 {{ request()->routeIs('admin.products.*') ? 'text-red-600' : '' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Kelola Produk
            </a>
            <a href="{{ route('admin.orders.index') }}"
                class="flex items-center text-sm px-4 py-3 text-gray-600 transition-colors rounded-xl hover:bg-red-50 hover:text-red-700 group {{ request()->routeIs('admin.orders.*') ? 'bg-red-50 text-red-600 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor"
                    class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-600 {{ request()->routeIs('admin.orders.*') ? 'text-red-600' : '' }}">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
                Pesanan Masuk
            </a>
            <a href="{{ route('admin.payment-method.index') }}"
                class="flex items-center text-sm px-4 py-3 text-gray-600 transition-colors rounded-xl hover:bg-red-50 hover:text-red-700 group {{ request()->routeIs('admin.payment-method.*') ? 'bg-red-50 text-red-600 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor"
                    class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-600 {{ request()->routeIs('admin.payment-method.*') ? 'text-red-600' : '' }}">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>
                Metode Pembayaran
            </a>
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center text-sm px-4 py-3 text-gray-600 transition-colors rounded-xl hover:bg-red-50 hover:text-red-700 group {{ request()->routeIs('admin.users.*') ? 'bg-red-50 text-red-600 font-semibold' : '' }}">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-600 {{ request()->routeIs('admin.users.*') ? 'text-red-600 font-semibold' : '' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Data Pengguna
            </a>
        @endif

        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-6 mb-2">Laporan</p>

        <a href="#"
            class="flex items-center text-sm px-4 py-3 text-gray-600 transition-colors rounded-xl hover:bg-red-50 hover:text-red-700 group">
            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-600" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Laporan Penjualan
        </a>

        <a href="#"
            class="flex items-center text-sm px-4 py-3 text-gray-600 transition-colors rounded-xl hover:bg-red-50 hover:text-red-700 group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
            </svg>
            Grafik
        </a>
    </nav>
</aside>
