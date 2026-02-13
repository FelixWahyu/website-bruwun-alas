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
                Visi Misi Bruwun Alas
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight mb-6 tracking-tight">
                Wisata Edukasi & <br> <span
                    class="text-transparent bg-clip-text bg-linear-to-r from-red-300 to-amber-500">Batik Ecoprint</span>
            </h1>
            <p class="text-gray-200 text-lg md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                Lebih dari sekadar rekreasi alam. Mari belajar proses pembuatan batik ecoprint langsung dari ahlinya,
                sekaligus mendukung kemandirian UMKM lokal kami.
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
                            <strong>Bruwun Alas</strong> adalah perusahaan yang berfokus pada produksi dan
                            edukasi batik dan Ecoprint, Dengan tagline “Local Wisdom: Kenakan Batik, Kenalkan Budaya Kita“,
                            kami berkomitmen untuk melestarikan dan mengembangkan warisan budaya batik lokal khusnya
                            Banyumasan Sebagai pusat produksi batik dan Ecoprint , Bruwun Alas menghasilkan berbagai motif
                            batik khas Banyumas.
                        </p>
                        <p class="mb-4">
                            Selain itu, kami juga berperan aktif dalam memberikan edukasi dan pelatihan pembuatan
                            batik dan Ecoprint kepada masyarakat, memastikan bahwa seni dan keterampilan membatik dan
                            Ecoprint dapat diteruskan ke generasi mendatang dengan mengedepankan ramah lingkungan.
                            Melalui kombinasi produksi berkualitas dan program edukasi yang komprehensif, Bruwun Alas
                            berupaya menjadi terdepan dalam pelestarian dan pengembangan batik dan ecoprint sebagai warisan
                            budaya Indonesia.
                        </p>
                    </div>
                </div>

                <div class="lg:w-1/2 order-1 lg:order-2 relative">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
                        <img src="https://lh3.googleusercontent.com/gps-cs-s/AHVAwerkb-PTClF8E-Fl7jHrHLgunEiHanurzP99VLoU7rapSWQEfOflRp_ehttxOY1dz18aFb-GclxzIo4APURi4-Xtu5kwrZ75xYCa8w0MWI9Qmw6EclbKVp6i5PrZDI9_v0qnzvRrC_UDofc=s680-w680-h510-rw"
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

    <section class="py-16 bg-gray-50 relative overflow-hidden">
        <div
            class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-red-100 rounded-full blur-3xl opacity-50 pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-orange-100 rounded-full blur-3xl opacity-50 pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 gap-12 items-start">
                <div class="relative">
                    <div class="absolute inset-0 bg-red-600 rounded-3xl rotate-3 opacity-10"></div>
                    <div
                        class="bg-white p-8 md:p-10 rounded-3xl shadow-xl border border-gray-100 relative hover:-translate-y-2 transition duration-300">
                        <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center text-red-600 mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi Kami</h3>
                        <p class="text-gray-600 text-lg leading-relaxed italic">
                            "Menjadi pusat unggulan Pelatihan batik dan Ecoprint Banyumas yang berdaya saing nasional dan
                            internasional, serta berkontribusi pada kemaslahatan umat melalui pengembangan ekonomi yang
                            berkelanjutan dan pemberdayaan masyarakat."
                        </p>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
                        <span class="w-8 h-1 bg-red-600 rounded-full mr-3"></span>
                        Misi Utama
                    </h3>
                    <div class="space-y-6">
                        <div class="flex gap-4 group">
                            <div
                                class="shrink-0 w-10 h-10 rounded-full bg-white border border-red-100 flex items-center justify-center text-red-600 shadow-sm group-hover:bg-red-600 group-hover:text-white transition duration-300">
                                <span class="font-bold">1</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">Produksi Berkelanjutan</h4>
                                <p class="text-gray-600 text-sm mt-1">Menghasilkan batik berkualitas tinggi dengan
                                    memperhatikan aspek keberlanjutan dan etika, serta menggunakan bahan-bahan ramah
                                    lingkungan.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 group">
                            <div
                                class="shrink-0 w-10 h-10 rounded-full bg-white border border-red-100 flex items-center justify-center text-red-600 shadow-sm group-hover:bg-red-600 group-hover:text-white transition duration-300">
                                <span class="font-bold">2</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">Inovasi dan Kreativitas</h4>
                                <p class="text-gray-600 text-sm mt-1">Mendorong inovasi dalam desain dan teknik batik yang
                                    mengedepankan nilai-nilai budaya lokal, serta menciptakan produk yang relevan dengan
                                    kebutuhan pasar global.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 group">
                            <div
                                class="shrink-0 w-10 h-10 rounded-full bg-white border border-red-100 flex items-center justify-center text-red-600 shadow-sm group-hover:bg-red-600 group-hover:text-white transition duration-300">
                                <span class="font-bold">3</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">Edukasi dan Pemberdayaan</h4>
                                <p class="text-gray-600 text-sm mt-1">Menyelenggarakan program pelatihan dan edukasi bagi
                                    masyarakat, terutama generasi muda, untuk meningkatkan keterampilan dan pengetahuan
                                    tentang batik, sehingga dapat menciptakan lapangan kerja dan meningkatkan kesejahteraan.
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-4 group">
                            <div
                                class="shrink-0 w-10 h-10 rounded-full bg-white border border-red-100 flex items-center justify-center text-red-600 shadow-sm group-hover:bg-red-600 group-hover:text-white transition duration-300">
                                <span class="font-bold">4</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">Keterlibatan Sosial</h4>
                                <p class="text-gray-600 text-sm mt-1">Berkolaborasi dengan lembaga sosial dan komunitas
                                    untuk menyelenggarakan kegiatan yang mendukung kesejahteraan masyarakat, seperti program
                                    pendidikan, dan pengembangan ekonomi lokal.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 group">
                            <div
                                class="shrink-0 w-10 h-10 rounded-full bg-white border border-red-100 flex items-center justify-center text-red-600 shadow-sm group-hover:bg-red-600 group-hover:text-white transition duration-300">
                                <span class="font-bold">5</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">Promosi Budaya</h4>
                                <p class="text-gray-600 text-sm mt-1">Memperkenalkan dan mempromosikan batik Banyumasan
                                    sebagai warisan budaya yang harus dilestarikan, serta meningkatkan kesadaran masyarakat
                                    tentang pentingnya menjaga dan menghargai budaya lokal.</p>
                            </div>
                        </div>
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
                        <img src="https://lh3.googleusercontent.com/p/AF1QipM_wPvyJphJzy5VuPBs_4abOOfSjQ-KwqssuqYG=s680-w680-h510-rw"
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
                        <img src="https://lh3.googleusercontent.com/gps-cs-s/AHVAwep8nInzeAwjNF_-8xyMrqYwhLdd4n6LPDvSuPLmginQ2YDeCuU-lDNCPMYHABUQPwKrAXDerp2_CWjZlbQJE5qCfZuZ3ivXk6U-3rmpYbmwN8qAPnf5E4mI-42zjXN__wBPAAlxNKG764Ky=s680-w680-h510-rw"
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
                        <img src="https://lh3.googleusercontent.com/gps-cs-s/AHVAweoYWumniwv9OeAzg-eO01XOn48OSSS-i65Bjl0SHIY6-9Py1ZZ_UVbMGPNQ-htXaOYhiwXV4ou0w1tRj-nhfmG3X-rrsW-DCWwwmctWXXegMAUxLd0sKNXU9Cvi0070zfB19uNZEUDmDE7d=s680-w680-h510-rw"
                            alt="Makanan Tradisional"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div
                            class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-800">
                            Jajanan UMKM
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
                    <img src="https://lh3.googleusercontent.com/p/AF1QipNYduVh5aPT6y5hiVWhfiUG7vbRKC5OuPwXzKtA=s680-w680-h510-rw"
                        alt="Baju batik" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition"></div>
                </div>

                <div class="col-span-1 row-span-1 relative group overflow-hidden rounded-2xl">
                    <img src="https://lh3.googleusercontent.com/gps-cs-s/AHVAweoYWumniwv9OeAzg-eO01XOn48OSSS-i65Bjl0SHIY6-9Py1ZZ_UVbMGPNQ-htXaOYhiwXV4ou0w1tRj-nhfmG3X-rrsW-DCWwwmctWXXegMAUxLd0sKNXU9Cvi0070zfB19uNZEUDmDE7d=s680-w680-h510-rw"
                        alt="Produk Makanan"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                </div>

                <div class="col-span-1 row-span-1 relative group overflow-hidden rounded-2xl">
                    <img src="https://lh3.googleusercontent.com/p/AF1QipP5K3PL6GajDQPrYVyplqCVZYRbiQFOalLaycs8=s680-w680-h510-rw"
                        alt="Edukasi Batik Ecoprint"
                        class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                </div>

                <div class="col-span-2 md:col-span-2 row-span-1 relative group overflow-hidden rounded-2xl">
                    <img src="https://lh3.googleusercontent.com/p/AF1QipM0uRxiM2m0VEBkC656QxrRbMbVm7gLvyDfcAE_=s680-w680-h510-rw"
                        alt="Kegiatan Membatik Ecoprint"
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
