<!DOCTYPE html>
<html lang="id" class="scroll-smooth" x-data="{ darkMode: false }" x-bind:class="darkMode ? 'dark' : ''">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KOST-SI - @yield('title', 'Sistem Manajemen Kamar')</title>

    <!-- Tailwind CDN + Custom Colors -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#60A5FA',
                        'primary-dark': '#3B82F6',
                        'primary-light': '#93C5FD',
                        accent: '#38BDF8',
                        'accent-light': '#7DD3FC',
                        muted: '#F0F9FF',
                        border: '#BFDBFE',
                    }
                }
            }
        }
    </script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Animations -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeIn 0.7s ease-out both; }
    </style>
</head>

<body class="min-h-screen bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-200 transition">

    {{-- NAVBAR --}}
    @yield('navbar')

    {{-- ALERT --}}
    @if(session('success') || session('error'))
        <div class="fixed top-4 left-1/2 -translate-x-1/2 z-50 fade-in
            px-6 py-3 rounded-lg shadow-lg text-white
            {{ session('success') ? 'bg-green-500' : 'bg-red-500' }}">
            {{ session('success') ?? session('error') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <!-- Active Icons -->
    <script>
        document.addEventListener("DOMContentLoaded", () => lucide.createIcons());
    </script>

</body>
</html>
