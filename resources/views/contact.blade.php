@extends('layouts.app-layout')
@section('title', 'Hubungi Kami - Bruwun Alas')
@section('content')
    <div class="min-h-screen bg-white">

        <div class="relative bg-red-600 py-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"></path>
                </svg>
            </div>

            <div class="relative max-w-4xl mx-auto text-center">
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">
                    Butuh Bantuan? Hubungi Kami.
                </h1>
                <p class="text-red-100 text-lg md:text-xl max-w-2xl mx-auto">
                    Tim Bruwun Alas siap membantu menjawab pertanyaan Anda seputar produk, pemesanan, atau kemitraan.
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 mb-20 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2">
                    <div
                        class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-12 text-center h-full flex flex-col justify-center items-center">
                        <div
                            class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mb-6 animate-bounce-slow">
                            <svg class="w-10 h-10 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-3">Chat Langsung via WhatsApp</h2>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">
                            Cara tercepat untuk menghubungi kami. Klik tombol di bawah untuk terhubung langsung dengan
                            Customer Service kami.
                        </p>

                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Bruwun%20Alas,%20saya%20ingin%20bertanya%20mengenai..."
                            target="_blank"
                            class="inline-flex items-center justify-center w-full sm:w-auto px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-full text-lg shadow-lg hover:shadow-green-500/30 transition transform hover:-translate-y-1">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                            Hubungi via WhatsApp
                        </a>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8">
                        <div class="flex items-center mb-4">
                            <div class="p-3 bg-red-50 rounded-xl text-red-600 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Email & Media Sosial</h3>
                                <p class="text-xs text-gray-500">Respon dalam 24 jam</p>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <a href="mailto:admin@bruwunalas.com"
                                class="block text-sm font-medium text-gray-600 hover:text-red-600 transition">
                                admin@bruwunalas.com
                            </a>
                            <a href="#" class="block text-sm font-medium text-gray-600 hover:text-red-600 transition">
                                @bruwunalas.official (Instagram)
                            </a>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8">
                        <div class="flex items-center mb-4">
                            <div class="p-3 bg-red-50 rounded-xl text-red-600 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Jam Operasional</h3>
                                <p class="text-xs text-gray-500">Waktu Indonesia Barat</p>
                            </div>
                        </div>

                        <ul class="space-y-3 text-sm">
                            <li class="flex justify-between border-b border-gray-50 pb-2">
                                <span class="text-gray-600">Senin - Jumat</span>
                                <span class="font-bold text-gray-900">08.00 - 20.00</span>
                            </li>
                            <li class="flex justify-between border-b border-gray-50 pb-2">
                                <span class="text-gray-600">Sabtu</span>
                                <span class="font-bold text-gray-900">09.00 - 17.00</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Minggu</span>
                                <span class="font-bold text-red-500">Tutup</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="mt-12">
                <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                    <div
                        class="p-6 md:p-8 flex flex-col md:flex-row justify-between items-start md:items-center border-b border-gray-100 bg-gray-50">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-red-600 text-white rounded-xl shadow-lg shadow-red-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Lokasi Kami</h3>
                                <p class="text-gray-500 mt-1 max-w-lg text-sm">
                                    Jl. Raya Hutan Bruwun No. 45, Kecamatan Alas, Kabupaten Alam, Indonesia 55123
                                </p>
                            </div>
                        </div>
                        <a href="https://maps.google.com" target="_blank"
                            class="mt-4 md:mt-0 text-sm font-bold text-red-600 hover:text-red-700 flex items-center">
                            Buka di Google Maps
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>

                    <div class="h-96 w-full bg-gray-200">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.088327918544!2d110.3735!3d-7.7756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNDYnMzIuMiJTIDExMMKwMjInMjQuNiJF!5e0!3m2!1sid!2sid!4v1633000000000!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            class="grayscale hover:grayscale-0 transition duration-500">
                        </iframe>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
