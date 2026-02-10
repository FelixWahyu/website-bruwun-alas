<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Masuk - Bruwun Alas')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="shortcut icon" href="{{ asset('/img/logo-ba.webp') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-white text-gray-800">
    <div class="flex min-h-screen">
        <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900 overflow-hidden">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=2071&auto=format&fit=crop"
                    alt="Background Bruwun Alas" class="w-full h-full object-cover opacity-60">
                <div class="absolute inset-0 bg-linear-to-t from-red-900/90 via-red-900/40 to-transparent"></div>
            </div>

            <div class="relative z-10 w-full flex flex-col justify-between p-12 text-white">
                <div>
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group w-fit">
                        <div
                            class="w-8 h-8 bg-white/20 backdrop-blur-md rounded-lg flex items-center justify-center text-white border border-white/30">
                            <img src="{{ asset('img/logo-ba.webp') }}" class="w-full h-full object-cover"
                                alt="logo-bruwun-alas">
                        </div>
                        <span class="text-xl font-bold tracking-tight">Bruwun Alas</span>
                    </a>
                </div>

                <div class="mb-10">
                    <h2 class="text-4xl font-bold leading-tight mb-4">
                        Nikmati Keasrian Alam <br> dan Produk Lokal Terbaik.
                    </h2>
                    <p class="text-red-100 text-lg font-light max-w-md">
                        Bergabunglah dengan kami untuk mendukung UMKM lokal dan melestarikan hutan Kulon Progo.
                    </p>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 md:p-12 overflow-y-auto no-scrollbar relative">

            <a href="{{ route('home') }}"
                class="absolute top-6 right-6 text-gray-400 hover:text-red-600 transition flex items-center gap-2 text-sm font-medium">
                Kembali ke Beranda
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>

            <div class="w-full max-w-md">
                @yield('content')
            </div>
        </div>

    </div>

</body>

</html>
