@extends('layouts.app-layout')
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

                <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-tight mb-6 drop-shadow-lg tracking-tight">
                    Temukan Kedamaian di <br>
                    <span class="text-transparent bg-clip-text bg-linear-to-r from-red-300 to-amber-600">
                        Bruwun Alas
                    </span>
                </h1>

                <p
                    class="text-lg md:text-xl text-gray-100 mb-10 leading-relaxed font-light max-w-2xl drop-shadow-md mx-auto md:mx-0">
                    Jelajahi keindahan hutan lindung, nikmati kuliner autentik, dan dukung produk lokal karya tangan-tangan
                    terampil masyarakat sekitar.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="{{ route('katalogProduk') }}"
                        class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-red-600 rounded-full hover:bg-red-700 transition-all duration-300 shadow-lg hover:shadow-red-500/30 hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Belanja Produk
                    </a>

                    <a href="{{ route('about') }}"
                        class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white border-2 border-white/30 bg-white/5 backdrop-blur-sm rounded-full hover:bg-white hover:text-red-900 transition-all duration-300 hover:border-white">
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
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-red-100 rounded-full z-0"></div>
                    <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?w=800&auto=format&fit=crop"
                        alt="Kegiatan UMKM"
                        class="relative z-10 rounded-2xl shadow-xl w-full h-100 object-cover transform hover:scale-[1.02] transition duration-500">
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-red-50 rounded-full z-0"></div>
                </div>

                <div>
                    <h2 class="text-base font-semibold text-red-600 uppercase tracking-wide mb-2">Tentang Kami</h2>
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
                                class="shrink-0 w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 mt-1">
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
                                class="shrink-0 w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">Edukasi Pembuatan Batik Ekoprint</h4>
                                <p class="text-gray-500 text-sm">Konsep zero waste dan edukasi pengolahan limbah sampah daun
                                    menjadi batik.</p>
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
                <a href="{{ route('katalogProduk') }}"
                    class="inline-flex items-center text-red-600 font-semibold hover:text-red-800 transition">
                    Lihat Semua Produk
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse ($products as $product)
                    <div
                        class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full overflow-hidden">
                        <div class="relative w-full pt-[100%] bg-gray-100 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->product_name }}"
                                class="absolute top-0 left-0 w-full h-full object-center object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                                <span
                                    class="bg-white/95 backdrop-blur-sm text-red-800 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                    {{ $product->category->name }}
                                </span>
                            </div>

                            @php
                                $colors = [
                                    'pria' => 'bg-blue-500',
                                    'wanita' => 'bg-pink-500',
                                    'anak' => 'bg-yellow-500',
                                    'unisex' => 'bg-purple-500',
                                ];
                            @endphp
                            <div
                                class="absolute top-3 right-3 {{ $colors[$product->gender] ?? 'bg-gray-500' }} text-white text-[10px] font-bold px-2 py-1 rounded uppercase shadow-sm">
                                {{ $product->gender }}
                            </div>

                            <div
                                class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <a href="{{ route('product.detail', $product->slug) }}"
                                    class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 bg-white text-gray-900 font-bold py-2 px-6 rounded-full shadow-lg hover:bg-red-600 hover:text-white text-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>

                        <div class="p-5 flex flex-col grow">
                            <h3
                                class="text-lg font-bold text-gray-900 mb-1 leading-snug line-clamp-2 group-hover:text-red-600 transition-colors">
                                <a href="{{ route('product.detail', $product->slug) }}">
                                    {{ $product->product_name }}
                                </a>
                            </h3>

                            <div class="mt-auto pt-4 flex items-center justify-between border-t border-gray-50">
                                <div>
                                    <p class="text-xs text-gray-400 mb-0.5">Mulai dari</p>
                                    <p class="text-xl font-extrabold text-red-600">
                                        Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}
                                    </p>
                                </div>
                                <a href="{{ route('product.detail', $product->slug) }}"
                                    class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-red-600 group-hover:text-white transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Belum ada produk yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-red-600 font-semibold tracking-wider uppercase text-sm">Experience</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2">Serunya Berpetualang di Alam</h2>
                <div class="w-20 h-1.5 bg-red-500 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group relative overflow-hidden rounded-3xl h-96 cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?q=80&w=2070&auto=format&fit=crop"
                        alt="Camping Ground"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center text-white mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Camping Ground</h3>
                        <p
                            class="text-gray-300 text-sm line-clamp-2 opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                            Nikmati malam bertabur bintang dengan fasilitas kemah yang aman dan nyaman untuk keluarga.
                        </p>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-3xl h-96 cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1596464716127-f9a86255b613?q=80&w=2070&auto=format&fit=crop"
                        alt="Edukasi Tani"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center text-white mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Edukasi Tani</h3>
                        <p
                            class="text-gray-300 text-sm line-clamp-2 opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                            Belajar cara menanam, memanen, dan mengolah hasil bumi langsung dari petani lokal.
                        </p>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-3xl h-96 cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1533240332313-0db49b459ad6?q=80&w=1974&auto=format&fit=crop"
                        alt="Outbound"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-linear-to-t from-black/90 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8">
                        <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center text-white mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Outbound & Gathering</h3>
                        <p
                            class="text-gray-300 text-sm line-clamp-2 opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                            Area luas untuk kegiatan sekolah, kantor, atau komunitas dengan permainan seru.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-red-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Fasilitas Lengkap untuk Kenyamanan Anda</h2>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Kami memastikan kunjungan Anda tetap nyaman dengan menyediakan fasilitas pendukung yang bersih,
                        terawat, dan ramah untuk semua kalangan usia.
                    </p>

                    <div class="grid grid-cols-2 gap-6">
                        <div
                            class="flex items-center p-4 bg-white rounded-xl shadow-sm border border-red-100 hover:shadow-md transition">
                            <div class="text-red-600 mr-4 bg-red-50 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-semibold text-gray-700">Area Parkir Luas</span>
                        </div>
                        <div
                            class="flex items-center p-4 bg-white rounded-xl shadow-sm border border-red-100 hover:shadow-md transition">
                            <div class="text-red-600 mr-4 bg-red-50 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-semibold text-gray-700">Mushola & Toilet</span>
                        </div>
                        <div
                            class="flex items-center p-4 bg-white rounded-xl shadow-sm border border-red-100 hover:shadow-md transition">
                            <div class="text-red-600 mr-4 bg-red-50 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-semibold text-gray-700">Gazebo Santai</span>
                        </div>
                        <div
                            class="flex items-center p-4 bg-white rounded-xl shadow-sm border border-red-100 hover:shadow-md transition">
                            <div class="text-red-600 mr-4 bg-red-50 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-semibold text-gray-700">Warung UMKM</span>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="grid grid-cols-2 gap-4">
                        <img src="https://images.unsplash.com/photo-1561577555-4c92ddbe329c?w=600&auto=format&fit=crop"
                            class="rounded-2xl shadow-lg w-full h-48 object-cover transform translate-y-4">
                        <img src="https://images.unsplash.com/photo-1562664377-709f2c337eb2?w=600&auto=format&fit=crop"
                            class="rounded-2xl shadow-lg w-full h-48 object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Kata Mereka Tentang <span
                    class="text-red-600">Bruwun Alas</span></h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 relative">
                    <div class="text-red-500 mb-4">★★★★★</div>
                    <p class="text-gray-600 italic mb-6">"Tempatnya sejuk banget, cocok buat healing tipis-tipis bareng
                        keluarga. Kripik singkongnya juara, wajib beli buat oleh-oleh!"</p>
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center font-bold text-gray-600">
                            AS</div>
                        <div class="ml-3">
                            <h4 class="font-bold text-gray-900">Andi Saputra</h4>
                            <p class="text-xs text-gray-500">Pengunjung Lokal</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg border border-red-100 relative transform md:-translate-y-4">
                    <div class="absolute -top-4 right-8 text-6xl text-red-100 font-serif">"</div>
                    <div class="text-red-500 mb-4">★★★★★</div>
                    <p class="text-gray-600 italic mb-6">"Edukasi taninya sangat bermanfaat buat anak-anak. Fasilitasnya
                        juga bersih. Bakal balik lagi next holiday."</p>
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center font-bold text-gray-600">
                            DR</div>
                        <div class="ml-3">
                            <h4 class="font-bold text-gray-900">Dina Ratnasari</h4>
                            <p class="text-xs text-gray-500">Wisatawan Jakarta</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 relative">
                    <div class="text-red-500 mb-4">★★★★★</div>
                    <p class="text-gray-600 italic mb-6">"Suasananya tenang, makanan di warung UMKM harganya terjangkau dan
                        enak-enak. Recommended!"</p>
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center font-bold text-gray-600">
                            BP</div>
                        <div class="ml-3">
                            <h4 class="font-bold text-gray-900">Budi Pratama</h4>
                            <p class="text-xs text-gray-500">Pengunjung Lokal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-24 bg-red-900 overflow-hidden">
        <div class="absolute inset-0 opacity-10"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>

        <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Siap Menjelajah?</h2>
            <p class="text-red-100 text-lg mb-10 max-w-2xl mx-auto">
                Jangan lewatkan pengalaman seru menyatu dengan alam. Lokasi kami mudah dijangkau dan siap menyambut
                kedatangan Anda.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://maps.app.goo.gl/wb5zNBc6mqoqp5LL6" target="_blank"
                    class="inline-flex items-center justify-center px-8 py-4 bg-white text-red-900 font-bold rounded-full hover:bg-red-50 transition transform hover:-translate-y-1 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Lihat Petunjuk Map
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center px-8 py-4 border-2 border-white/30 text-white font-bold rounded-full hover:bg-white/10 transition">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection
