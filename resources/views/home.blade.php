@extends('layouts.app-layout');
@section('title', 'Beranda - Wisata Edukasi Bruwun Alas')
@section('content')
    <section class="relative min-h-[110vh] flex items-center -mt-32 pt-40 pb-40 overflow-hidden group">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=2071&auto=format&fit=crop"
                alt="Hutan Bruwun Alas"
                class="w-full h-full object-cover transition-transform duration-[20s] ease-in-out group-hover:scale-110 scale-100">

            <div class="absolute inset-0 bg-linear-to-b from-black/80 via-black/50 to-black/70"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-4xl text-center md:text-left">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-sm font-medium mb-6 animate-fade-in-up mx-auto md:mx-0">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    Wisata Edukasi & Konservasi Alam
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-tight mb-6 drop-shadow-lg tracking-tight">
                    Temukan Kedamaian di <br>
                    <span class="text-transparent bg-clip-text bg-linear-to-r from-green-300 to-emerald-400">
                        Bruwun Alas
                    </span>
                </h1>

                <p
                    class="text-lg md:text-xl text-gray-100 mb-10 leading-relaxed font-light max-w-2xl drop-shadow-md mx-auto md:mx-0">
                    Jelajahi keindahan hutan lindung, nikmati kuliner autentik, dan dukung produk lokal karya tangan-tangan
                    terampil masyarakat sekitar.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="#products"
                        class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-green-600 rounded-full hover:bg-green-700 transition-all duration-300 shadow-lg hover:shadow-green-500/30 hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Belanja Produk
                    </a>

                    <a href="#about"
                        class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white border-2 border-white/30 bg-white/5 backdrop-blur-sm rounded-full hover:bg-white hover:text-green-900 transition-all duration-300 hover:border-white">
                        Tentang Kami
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-12 left-1/2 transform -translate-x-1/2 z-10 animate-bounce hidden md:block">
            <a href="#about" class="text-white/70 hover:text-white transition p-2 cursor-pointer">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7-7-7"></path>
                </svg>
            </a>
        </div>
    </section>

    <section id="about" class="py-20 bg-white relative z-20 -mt-10 rounded-t-3xl md:rounded-none">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-green-100 rounded-full z-0"></div>
                    <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?w=800&auto=format&fit=crop"
                        alt="Kegiatan UMKM"
                        class="relative z-10 rounded-2xl shadow-xl w-full h-100 object-cover transform hover:scale-[1.02] transition duration-500">
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-green-50 rounded-full z-0"></div>
                </div>

                <div>
                    <h2 class="text-base font-semibold text-green-600 uppercase tracking-wide mb-2">Tentang Kami</h2>
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">Membangun
                        Ekonomi,<br>Melestarikan Alam.</h3>

                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        Bruwun Alas adalah destinasi wisata edukasi yang berfokus pada pelestarian alam dan pemberdayaan
                        ekonomi lokal. Kami menyediakan wadah bagi produk olahan tangan dan hasil bumi yang dikelola
                        langsung
                        oleh masyarakat sekitar.
                    </p>

                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div
                                class="shrink-0 w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">Produk Lokal Berkualitas</h4>
                                <p class="text-gray-500 text-sm">Dikurasi langsung dari pengrajin terbaik desa.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <div
                                class="shrink-0 w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">Wisata Ramah Lingkungan</h4>
                                <p class="text-gray-500 text-sm">Konsep zero waste dan edukasi konservasi.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="products" class="py-20 bg-gray-50 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Produk Terbaru</h2>
                    <p class="text-gray-500 mt-2">Pilihan terbaik minggu ini dari UMKM lokal.</p>
                </div>
                <a href="#"
                    class="inline-flex items-center text-green-600 font-semibold hover:text-green-800 transition">
                    Lihat Semua Produk
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group">
                    <div class="relative h-56 bg-gray-200 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=800&auto=format&fit=crop"
                            alt="Produk 1" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div
                            class="absolute top-3 left-3 bg-green-500/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-white shadow-sm">
                            Baru
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="text-xs text-green-600 font-bold uppercase tracking-wider mb-1">Makanan</div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-green-700 transition">Kripik
                            Singkong Khas</h3>
                        <div class="flex justify-between items-end mt-4">
                            <div>
                                <span class="text-gray-400 text-xs line-through block">Rp 20.000</span>
                                <span class="text-gray-900 font-extrabold text-xl">Rp 15.000</span>
                            </div>
                            <button
                                class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-600 hover:bg-green-600 hover:text-white transition-all shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                @for ($i = 0; $i < 3; $i++)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 flex flex-col items-center justify-center text-center h-95 group hover:border-green-200 transition">
                        <div
                            class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 group-hover:bg-green-50 transition">
                            <svg class="w-8 h-8 text-gray-300 group-hover:text-green-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-gray-900 font-bold mb-1">Produk Segera Hadir</h3>
                        <p class="text-gray-400 text-sm">Nantikan koleksi terbaru kami.</p>
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection
