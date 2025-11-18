<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    {{-- NAVBAR HORIZONTAL --}}
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            {{-- LOGO --}}
            <div class="text-xl font-bold text-gray-800">
                SI-KOST Admin
            </div>

            {{-- MENU --}}
            <nav class="flex items-center gap-6 font-medium">

                <a href="{{ route('admin.dashboard') }}"
                    class="hover:text-blue-600 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 font-semibold' : '' }}">
                    Dashboard
                </a>

<a href="{{ route('admin.rooms.index') }}"
    class="hover:text-blue-600 {{ request()->routeIs('admin.rooms*') ? 'text-blue-600 font-semibold' : '' }}">
    Kelola Kamar
</a>


            </nav>

            {{-- LOGOUT --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Keluar
                </button>
            </form>

        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="px-6 py-6 max-w-7xl mx-auto">
        @yield('content')
    </main>

        @yield('scripts')


</body>

</html>
