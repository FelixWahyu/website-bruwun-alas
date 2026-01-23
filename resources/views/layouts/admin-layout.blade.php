<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard') - Bruwun Alas</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak
            class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity lg:hidden"></div>

        @include('components.sidebar')

        <div class="flex flex-col flex-1 overflow-hidden">
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-100">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true"
                        class="text-gray-500 focus:outline-none lg:hidden p-2 rounded-md hover:bg-gray-100">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    <h2 class="text-xl font-semibold text-gray-800 ml-4 lg:ml-0">
                        @yield('header_title', 'Dashboard Overview')
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="relative px-0.75 py-0.75 rounded-full border shadow-sm border-gray-300"
                        x-data="{ dropdownOpen: false }" @click.away="dropdownOpen = false">
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center gap-3 cursor-pointer focus:outline-none">
                            <div class="text-right hidden md:block">
                                <p class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</p>
                            </div>
                            <div
                                class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold border border-green-200">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </div>
                        </button>

                        <div x-show="dropdownOpen"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-50 py-2 border border-gray-100"
                            x-cloak>
                            <div class="block px-4 py-2 border-b border-gray-300">
                                <span
                                    class="text-xs text-gray-500 capitalize bg-gray-100 px-2 py-0.5 rounded-full">{{ Auth::user()->role }}</span>
                            </div>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">Edit
                                Profile</a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}" id="logout">
                                @csrf
                                <button type="submit" onclick="confirmLogout(event,'logout')"
                                    class="w-full text-left px-4 py-2 cursor-pointer text-sm text-red-600 hover:bg-red-50">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function confirmLogout(event, formId) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Keluar',
                text: "Apakah Anda yakin ingin mengakhiri sesi ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: 'gray',
                confirmButtonText: 'Keluar',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Sedang Keluar...',
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
</body>

</html>
