<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOST-SI - @yield('title', 'Sistem Manajemen Kamar')</title>

    {{-- Integrasi Tailwind & Lucide untuk ikon dan styling cepat --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { primary: '#5B4FE3' } } }
        }
    </script>

    {{-- Tambahan Vite untuk asset Laravel modern --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Notifikasi (gabungan Toast + Alpine) --}}
    <div
        x-data="{ show: @json(session('success') || session('error')), message: '{{ session('success') ?? session('error') }}' }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-4 left-1/2 transform -translate-x-1/2 px-6 py-3 rounded-lg shadow-lg text-white text-center z-50"
        :class="{
            'bg-green-500': '{{ session('success') }}',
            'bg-red-500': '{{ session('error') }}'
        }"
        style="display: none;"
    >
        <p x-text="message"></p>
    </div>

    {{-- Toast custom (dari versi HEAD) --}}
    <div id="toast" class="fixed bottom-4 right-4 bg-white border rounded-lg shadow-lg p-4 translate-y-20 transition-transform z-50 hidden">
        <div class="flex items-center gap-3">
            <div id="toast-icon"></div>
            <p id="toast-message"></p>
        </div>
    </div>

    {{-- Konten utama --}}
    <main class="min-h-screen container mx-auto py-8 px-4">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => lucide.createIcons());

        // Fitur toast custom (versi HEAD)
        @if(session('toast'))
            showToast("{{ session('toast') }}", 'success');
        @endif

        function showToast(msg, type = 'success') {
            const t = document.getElementById('toast'),
                m = document.getElementById('toast-message'),
                i = document.getElementById('toast-icon');
            m.textContent = msg;
            i.innerHTML = type === 'success'
                ? '<i data-lucide="check-circle-2" class="w-5 h-5 text-green-500"></i>'
                : '<i data-lucide="x-circle" class="w-5 h-5 text-red-500"></i>';
            t.classList.remove('hidden');
            t.style.transform = 'translateY(0)';
            lucide.createIcons();
            setTimeout(() => {
                t.style.transform = 'translateY(200px)';
                setTimeout(() => t.classList.add('hidden'), 300);
            }, 3000);
        }
    </script>

</body>
</html>
