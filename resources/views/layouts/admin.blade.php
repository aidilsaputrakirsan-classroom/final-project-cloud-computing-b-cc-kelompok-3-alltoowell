<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | KOST-SI Admin</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-[#F4F7FF]">

<div class="flex">

    <!-- SIDEBAR -->
    <div class="fixed inset-y-0 left-0 w-64 bg-[#1E3A8A] text-white shadow-2xl flex flex-col justify-between py-6">

        <div>
            <!-- LOGO -->
            <div class="flex items-center gap-3 px-6 mb-8">
                <i data-lucide="building-2" class="w-7 h-7 text-white"></i>
                <span class="text-xl font-bold tracking-wide">KOST-SI</span>
            </div>

            <!-- MENU -->
            <nav class="space-y-2 px-4">

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                   {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#1E3A8A] font-semibold shadow-md' : 'hover:bg-white/20' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Dashboard
                </a>

                <a href="{{ route('admin.booking.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                   {{ request()->routeIs('admin.booking.*') ? 'bg-white text-[#1E3A8A] font-semibold shadow-md' : 'hover:bg-white/20' }}">
                    <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                    Status Pemesanan
                </a>

                <a href="{{ route('admin.rooms.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                   {{ request()->routeIs('admin.rooms.*') ? 'bg-white text-[#1E3A8A] font-semibold shadow-md' : 'hover:bg-white/20' }}">
                    <i data-lucide="bed" class="w-5 h-5"></i>
                    Kamar Kos
                </a>

            </nav>
        </div>

        <!-- LOGOUT (lebih naik ke atas) -->
        <div class="px-4 mb-10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                    class="w-full flex items-center gap-3 px-4 py-3 bg-white/10 hover:bg-white/20 rounded-xl transition text-white">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    Logout
                </button>
            </form>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="ml-64 w-full p-10">
        @yield('content')
    </div>

</div>

<script>
    lucide.createIcons();
</script>

@stack('scripts')

</body>
</html>
