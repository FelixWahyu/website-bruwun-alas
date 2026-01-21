<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Wisata Edukasi Bruwun Alas')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen">

    @include('layouts.header')

    <main class="grow pt-22 pb-10 w-full overflow-x-hidden">
        @yield('content')
    </main>

    @include('layouts.footer')

    <script>
        // Fungsi Global untuk Logout Confirmation
        function confirmLogout() {
            // Menggunakan confirm bawaan browser (bisa diganti SweetAlert jika mau lebih bagus)
            if (confirm("Apakah Anda yakin ingin keluar dari sesi ini?")) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</body>

</html>
