<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOST-SI - @yield('title', 'Booking')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { primary: '#5B4FE3' } } }
        }
    </script>
</head>
<body class="bg-gray-50">
    @include('components.navbar')

    <!-- Toast -->
    <div id="toast" class="fixed bottom-4 right-4 bg-white border rounded-lg shadow-lg p-4 translate-y-20 transition-transform z-50 hidden">
        <div class="flex items-center gap-3">
            <div id="toast-icon"></div>
            <p id="toast-message"></p>
        </div>
    </div>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
        @if(session('toast'))
            showToast("{{ session('toast') }}", 'success');
        @endif
        function showToast(msg, type = 'success') {
            const t = document.getElementById('toast'), m = document.getElementById('toast-message'), i = document.getElementById('toast-icon');
            m.textContent = msg;
            i.innerHTML = type === 'success'
                ? '<i data-lucide="check-circle-2" class="w-5 h-5 text-green-500"></i>'
                : '<i data-lucide="x-circle" class="w-5 h-5 text-red-500"></i>';
            t.classList.remove('hidden'); t.style.transform = 'translateY(0)';
            lucide.createIcons();
            setTimeout(() => { t.style.transform = 'translateY(200px)'; setTimeout(() => t.classList.add('hidden'), 300); }, 3000);
        }
    </script>
</body>
</html>
