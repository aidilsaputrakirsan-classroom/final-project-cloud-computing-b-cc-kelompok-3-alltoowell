<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <div class="flex">

        {{-- SIDEBAR --}}
        <aside class="w-64 h-screen bg-gray-900 text-white fixed">
            <div class="p-6 text-xl font-bold border-b border-gray-700">
                Admin Panel
            </div>

            <nav class="mt-6 space-y-2">
                <a href="/admin/dashboard"
                    class="block px-6 py-3 hover:bg-gray-700 transition">
                    Dashboard
                </a>

                <a href="/admin/pengguna"
                    class="block px-6 py-3 hover:bg-gray-700 transition">
                    Data Pengguna
                </a>

                <a href="/admin/kamar"
                    class="block px-6 py-3 hover:bg-gray-700 transition">
                    Data Kamar
                </a>

                <a href="/admin/booking"
                    class="block px-6 py-3 hover:bg-gray-700 transition">
                    Booking
                </a>

                <a href="/logout"
                    class="block px-6 py-3 text-red-400 hover:bg-red-600 hover:text-white transition">
                    Logout
                </a>
            </nav>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="ml-64 w-full p-8">
            @yield('content')
        </main>

    </div>

</body>
</html>
