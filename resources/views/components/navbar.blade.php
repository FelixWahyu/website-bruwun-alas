<nav x-data="{ mobileMenuOpen: false, userDropdownOpen: false }"
    class="w-full bg-white/95 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50 transition-all duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <div
                        class="w-10 h-10 bg-linear-to-br from-red-600 to-red-800 rounded-xl flex items-center justify-center text-white shadow-lg group-hover:shadow-red-500/30 transition-all duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span
                            class="text-xl font-bold text-gray-900 tracking-tight leading-none group-hover:text-red-700 transition-colors">
                            Bruwun<span class="text-red-600">Alas</span>
                        </span>
                        <span class="text-[10px] uppercase tracking-widest text-gray-400 font-medium">Authentic
                            Taste</span>
                    </div>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-1">
                @foreach ([['label' => 'Beranda', 'route' => 'home', 'hash' => ''], ['label' => 'Tentang Kami', 'route' => 'about', 'hash' => ''], ['label' => 'Produk', 'route' => 'katalogProduk', 'hash' => ''], ['label' => 'Kontak', 'route' => '', 'hash' => '#contact']] as $link)
                    <a href="{{ $link['hash'] ? $link['hash'] : route($link['route']) }}"
                        class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-200 
                       {{ request()->routeIs($link['route']) && !$link['hash'] ? 'bg-red-50 text-red-700' : 'text-gray-600 hover:text-red-700 hover:bg-red-50' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            <div class="flex items-center gap-3">
                @php
                    $cartCount = 0;
                    // Jika login sebagai pelanggan
                    if (auth()->check() && auth()->user()->role == 'pelanggan') {
                        $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                    }
                    // Jika belum login (Guest)
                    elseif (!auth()->check()) {
                        $guestId = \Illuminate\Support\Facades\Cookie::get('bruwun_guest_id');
                        if ($guestId) {
                            $cartCount = \App\Models\Cart::where('guest_id', $guestId)->count();
                        }
                    }
                @endphp

                <!-- ICON KERANJANG (Selalu Muncul kecuali Admin/Owner) -->
                @if (!auth()->check() || auth()->user()->role == 'pelanggan')
                    <a href="{{ route('cart.index') }}"
                        class="relative p-2 text-gray-500 hover:text-red-600 hover:bg-gray-100 rounded-full transition-all duration-200 group mr-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>

                        <!-- Badge Jumlah -->
                        @if ($cartCount > 0)
                            <span class="absolute top-0 right-0 flex h-5 w-5 -mt-1 -mr-1">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span
                                    class="relative inline-flex rounded-full h-5 w-5 bg-red-600 text-[10px] font-bold text-white justify-center items-center">
                                    {{ $cartCount > 99 ? '99+' : $cartCount }}
                                </span>
                            </span>
                        @endif
                    </a>
                @endif

                <div class="h-6 w-px bg-gray-200 hidden md:block"></div>

                @guest
                    <div class="hidden md:flex items-center gap-3">
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-semibold text-gray-600 hover:text-red-600 transition">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="px-5 py-2.5 text-sm font-semibold text-white bg-red-600 rounded-full shadow-md hover:bg-red-700 hover:shadow-lg hover:-translate-y-0.5 transition-all">Daftar</a>
                    </div>
                @endguest

                @auth
                    <div class="relative hidden md:block" @click.away="userDropdownOpen = false">
                        <button @click="userDropdownOpen = !userDropdownOpen"
                            class="flex items-center gap-2 p-1 pl-3 pr-1 rounded-full border border-gray-200 hover:border-red-300 hover:shadow-sm transition-all bg-white group focus:outline-none">
                            <div class="text-right hidden lg:block">
                                <p class="text-xs font-bold text-gray-700 leading-none group-hover:text-red-700">
                                    {{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-gray-400 leading-none mt-1 capitalize">{{ Auth::user()->role }}
                                </p>
                            </div>
                            <div
                                class="h-9 w-9 rounded-full bg-linear-to-br from-gray-700 to-gray-900 text-white flex items-center justify-center font-bold text-sm ring-2 ring-white shadow-sm">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 transition-transform duration-200 mr-1"
                                :class="{ 'rotate-180': userDropdownOpen }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="userDropdownOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                            class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl ring-1 ring-gray-300 ring-opacity-5 py-2 z-50 origin-top-right overflow-hidden">

                            <div class="px-5 py-3 border-b border-gray-50 bg-gray-50/50 lg:hidden">
                                <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="py-1">
                                @php
                                    $dashboardLink = '#';
                                    if (Auth::user()->role == 'admin') {
                                        $dashboardLink = '#admin';
                                    } elseif (Auth::user()->role == 'owner') {
                                        $dashboardLink = '#owner';
                                    }
                                @endphp

                                @if (Auth::user()->role == 'pelanggan')
                                    <a href="{{ route('profile') }}"
                                        class="flex items-center px-5 py-2.5 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Edit Profil
                                    </a>
                                    <a href="{{ route('orders.history') }}"
                                        class="flex items-center px-5 py-2.5 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        Riwayat Pesanan
                                    </a>
                                @else
                                    <a href="{{ $dashboardLink }}"
                                        class="flex items-center px-5 py-2.5 text-sm text-gray-600 hover:bg-red-50 hover:text-red-700">
                                        <svg class="mr-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                        </svg>
                                        Dashboard
                                    </a>
                                @endif
                            </div>

                            <div class="border-t border-gray-100 py-1">
                                <form method="POST" action="{{ route('logout') }}" id="logout-form-desktop">
                                    @csrf
                                    <button type="submit" onclick="confirmLogout(event,'logout-form-desktop')"
                                        class="w-full flex items-center px-5 py-2.5 text-sm text-red-600 hover:bg-red-50">
                                        <svg class="mr-3 h-4 w-4 text-red-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                        class="text-gray-500 hover:text-red-600 focus:outline-none p-2 rounded-lg hover:bg-red-50 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden bg-white border-b border-gray-100 shadow-xl absolute w-full z-40 max-h-[80vh] overflow-y-auto">

        <div class="px-4 pb-6 space-y-1">

            @auth
                <div class="py-4 border-b border-gray-100 mb-2">
                    <div class="flex items-center px-2">
                        <div class="shrink-0">
                            <div
                                class="h-12 w-12 rounded-full bg-red-600 text-white flex items-center justify-center font-bold text-lg shadow-md">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-bold text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-4 space-y-1 px-2">
                        @if (Auth::user()->role == 'pelanggan')
                            <a href="{{ route('profile') }}"
                                class="block px-3 py-2 rounded-lg text-base font-medium text-gray-600 hover:bg-red-50 hover:text-red-700">Edit
                                Profil</a>
                            <a href="{{ route('orders.history') }}"
                                class="block px-3 py-2 rounded-lg text-base font-medium text-gray-600 hover:bg-red-50 hover:text-red-700">Riwayat
                                Pesanan</a>
                        @else
                            <a href="#"
                                class="block px-3 py-2 rounded-lg text-base font-medium text-gray-600 hover:bg-red-50 hover:text-red-700">Dashboard</a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" id="logout-form-mobile">
                            @csrf
                            <button type="submit" onclick="confirmLogout(event,'logout-form-mobile')"
                                class="w-full text-left block px-3 py-2 rounded-lg text-base font-medium text-red-600 hover:bg-red-50">Keluar</button>
                        </form>
                    </div>
                </div>
            @endauth

            <div class="space-y-1">
                <a href="{{ route('home') }}"
                    class="block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-red-700 hover:bg-red-50 transition">Beranda</a>
                <a href="#about"
                    class="block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-red-700 hover:bg-red-50 transition">Tentang
                    Kami</a>
                <a href="#products"
                    class="block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-red-700 hover:bg-red-50 transition">Produk</a>
                <a href="#contact"
                    class="block px-3 py-3 rounded-lg text-base font-medium text-gray-700 hover:text-red-700 hover:bg-red-50 transition">Kontak</a>
            </div>

            @guest
                <div class="pt-6 pb-2 border-t border-gray-100 flex flex-col gap-3 px-2">
                    <a href="{{ route('login') }}"
                        class="w-full text-center px-4 py-3 border border-gray-300 rounded-xl text-gray-700 font-bold hover:bg-gray-50 transition">Masuk
                        Akun</a>
                    <a href="{{ route('register') }}"
                        class="w-full text-center px-4 py-3 bg-red-600 text-white rounded-xl font-bold shadow-md hover:bg-red-700 transition">Daftar
                        Sekarang</a>
                </div>
            @endguest
        </div>
    </div>
</nav>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('navbar', () => ({
            mobileMenuOpen: false,
            userDropdownOpen: false,
        }))
    })
</script>
