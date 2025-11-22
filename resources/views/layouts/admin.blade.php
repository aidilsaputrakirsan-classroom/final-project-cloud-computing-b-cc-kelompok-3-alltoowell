<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOST-SI Admin – @yield('title')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- Tailwind CDN (fallback + utilities) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .sidebar-link {
            @apply flex items-center gap-3 px-4 py-3 rounded-lg text-slate-200 hover:bg-slate-700 transition;
        }
        .sidebar-link.active {
            @apply bg-indigo-600 text-white font-semibold;
        }
        .card {
            @apply bg-white rounded-2xl shadow-md p-6 border border-slate-200;
        }
    </style>
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col py-6">

        <h1 class="text-center text-2xl font-bold tracking-wide mb-8">KOST-SI</h1>

        <nav class="flex-1 space-y-1 px-4">

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.booking.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.booking*') ? 'active' : '' }}">
                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                Pemesanan
            </a>

            <a href="{{ route('admin.rooms.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.rooms*') ? 'active' : '' }}">
                <i data-lucide="building-2" class="w-5 h-5"></i>
                Kamar Kos
            </a>

            <a href="{{ route('admin.pengguna.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.pengguna*') ? 'active' : '' }}">
                <i data-lucide="users" class="w-5 h-5"></i>
                Pengguna
            </a>

        </nav>

        <form action="{{ route('logout') }}" method="POST" class="px-4">
            @csrf
            <button class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700">
                Logout
            </button>
        </form>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>
</div>

<script>
    lucide.createIcons();
</script>

@stack('scripts')

</body>
</html>
