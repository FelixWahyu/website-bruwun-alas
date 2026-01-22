@extends('layouts.app-layout')
@section('title', 'Tentang Kami - Wisata Edukasi Bruwun Alas')
@section('content')
    <div class="relative h-[60vh] min-h-100 flex items-center justify-center py-32 group overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1511497584788-876760111969?q=80&w=2070&auto=format&fit=crop"
                alt="Tentang Bruwun Alas"
                class="w-full h-full object-cover transition-transform duration-[10s] ease-in-out group-hover:scale-110">
            <div class="absolute inset-0 bg-linear-to-b from-black/70 via-black/40 to-black/60"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
            <span
                class="inline-block py-1 px-3 rounded-full bg-red-500/20 border border-red-400 text-red-300 font-semibold text-xs tracking-widest uppercase mb-4 backdrop-blur-sm">
                Profil & Layanan
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight mb-6 tracking-tight">
                Harmoni Alam & <br> <span
                    class="text-transparent bg-clip-text bg-linear-to-r from-red-300 to-amber-500">Kreativitas
                    Lokal</span>
            </h1>
            <p class="text-gray-200 text-lg md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                Menemukan ketenangan di hutan lindung sekaligus mendukung pemberdayaan ekonomi warga melalui karya autentik.
            </p>
        </div>
    </div>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12 items-center">
                <div class="lg:w-1/2 order-2 lg:order-1">
                    <h2 class="text-base font-bold text-red-600 uppercase tracking-wide mb-2">Siapa Kami?</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                        Lebih Dari Sekadar <br> Destinasi Wisata.
                    </h3>
                    <div class="prose prose-lg text-gray-600 text-justify">
                        <p class="mb-4">
                            <strong>Bruwun Alas</strong> lahir dari semangat gotong royong masyarakat Kulon Progo untuk
                            melestarikan hutan sekaligus menciptakan peluang ekonomi mandiri.
                        </p>
                        <p class="mb-4">
                            Kami menggabungkan konsep <em>Eco-Tourism</em> (Wisata Alam) dengan <em>Edu-Tourism</em> (Wisata
                            Edukasi). Di sini, pengunjung tidak hanya dimanjakan oleh sejuknya hutan pinus, tetapi juga
                            diajak mengenal proses kreatif pembuatan produk lokal yang bernilai seni tinggi.
                        </p>
                        <p>
                            Seluruh produk yang Anda temui—mulai dari makanan hingga kerajinan tangan—adalah murni hasil
                            karya warga sekitar yang kami kurasi dengan standar kualitas terbaik.
                        </p>
                    </div>

                    <div class="mt-8 flex gap-8 border-t border-gray-100 pt-6">
                        <div>
                            <span class="block text-3xl font-bold text-gray-900">100%</span>
                            <span class="text-sm text-gray-500">Karya Lokal</span>
                        </div>
                        <div>
                            <span class="block text-3xl font-bold text-gray-900">12 Ha</span>
                            <span class="text-sm text-gray-500">Area Konservasi</span>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2 order-1 lg:order-2 relative">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
                        <img src="https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?w=800&auto=format&fit=crop"
                            alt="Tentang Kami"
                            class="w-full h-125 object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent opacity-80"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <p class="font-bold text-lg">Pemberdayaan Masyarakat</p>
                            <p class="text-sm text-gray-300">Fokus utama kami sejak 2020</p>
                        </div>
                    </div>
                    <div class="absolute -z-10 -top-5 -right-5">
                        <svg width="100" height="100" fill="none" viewBox="0 0 100 100">
                            <pattern id="dots" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                <circle cx="2" cy="2" r="2" class="text-red-200" fill="currentColor" />
                            </pattern>
                            <rect width="100" height="100" fill="url(#dots)" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-red-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-red-600 font-bold uppercase tracking-wider text-sm">Produk Unggulan</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-2">Karya Otentik Bruwun Alas</h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
                    Kami menghadirkan berbagai produk hasil olahan tangan terampil masyarakat desa yang siap Anda bawa
                    pulang sebagai buah tangan istimewa.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?q=80&w=1965&auto=format&fit=crop"
                            alt="Pakaian Ecoprint"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div
                            class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-800">
                            Fashion
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-red-600 mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Pakaian & Kain Ecoprint</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            Koleksi kain batik dan pakaian dengan motif alami (ecoprint) yang dibuat menggunakan dedaunan
                            asli dari hutan Bruwun. Ramah lingkungan dan eksklusif.
                        </p>
                        <a href="{{ route('home') }}#products"
                            class="inline-flex items-center text-red-600 font-semibold hover:text-red-800">
                            Lihat Koleksi <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1611085583191-a3b181a88401?q=80&w=2070&auto=format&fit=crop"
                            alt="Aksesoris Kayu"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div
                            class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-800">
                            Aksesoris
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-red-600 mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Kriya & Souvenir</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            Berbagai kerajinan tangan unik dari kayu, anyaman bambu, dan manik-manik. Sangat cocok untuk
                            oleh-oleh atau hiasan rumah yang estetik.
                        </p>
                        <a href="{{ route('home') }}#products"
                            class="inline-flex items-center text-red-600 font-semibold hover:text-red-800">
                            Lihat Koleksi <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1626505928000-71707010f3c5?q=80&w=2070&auto=format&fit=crop"
                            alt="Makanan Tradisional"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div
                            class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-800">
                            Kuliner
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-red-600 mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Makanan Khas Desa</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            Cita rasa otentik kuliner ndeso. Mulai dari kripik singkong, gula semut organik, hingga aneka
                            sambal tradisional yang menggugah selera.
                        </p>
                        <a href="{{ route('home') }}#products"
                            class="inline-flex items-center text-red-600 font-semibold hover:text-red-800">
                            Lihat Koleksi <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Galeri Momen</h2>
                    <p class="text-gray-500 mt-2">Rekaman lensa keindahan alam dan aktivitas di Bruwun Alas.</p>
                </div>
                <a href="#"
                    class="hidden md:inline-flex items-center px-6 py-2 border border-gray-300 rounded-full text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Lihat Instagram
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 h-auto md:h-150">

                <div class="col-span-2 row-span-2 relative group overflow-hidden rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=2071&auto=format&fit=crop"
                        alt="Hutan Pinus"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition"></div>
                </div>

                <div class="col-span-1 row-span-1 relative group overflow-hidden rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=1974&auto=format&fit=crop"
                        alt="Produk Makanan"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                </div>

                <div class="col-span-1 row-span-1 relative group overflow-hidden rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?q=80&w=1972&auto=format&fit=crop"
                        alt="Anak bermain"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                </div>

                <div class="col-span-2 md:col-span-2 row-span-1 relative group overflow-hidden rounded-2xl">
                    <img src="https://images.unsplash.com/photo-1605218457336-d760773663b6?q=80&w=1974&auto=format&fit=crop"
                        alt="Kegiatan Membatik"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div
                        class="absolute bottom-4 left-4 text-white text-sm font-semibold opacity-0 group-hover:opacity-100 transition translate-y-2 group-hover:translate-y-0">
                        Workshop Ecoprint
                    </div>
                </div>

            </div>

            <div class="mt-8 text-center md:hidden">
                <a href="#"
                    class="inline-flex items-center px-6 py-2 border border-gray-300 rounded-full text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Lihat Instagram
                </a>
            </div>
        </div>
    </section>
@endsection
