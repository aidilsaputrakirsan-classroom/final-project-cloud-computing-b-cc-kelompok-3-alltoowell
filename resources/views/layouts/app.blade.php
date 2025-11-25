<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'KOST-SI')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Slick (untuk testimonial) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- CSS dari homepage -->
    <style>
        /* SCROLLBAR */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #F0F9FF; }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #60A5FA, #3B82F6);
            border-radius: 5px;
        }

        /* ANIMASI */
        @keyframes fadeIn {
            from { opacity:0; transform: translateY(20px); }
            to   { opacity:1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn .6s ease-out; }

        /* PATTERN */
        .pattern-dots {
            background-image: radial-gradient(circle, rgba(255,255,255,.15) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        /* GLASS */
        .glass {
            background: rgba(255,255,255,.8);
            backdrop-filter: blur(20px);
        }

        /* CARD EFFECT */
        .feature-card { transition: .3s; }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>

</head>

<body class="bg-white">

    {{-- NAVBAR MUNCUL HANYA DI HOME --}}
    @if (request()->routeIs('home'))
        @include('components.navbar')
    @endif

    <main class="min-h-screen">
        @yield('content')
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            lucide.createIcons();
        });
    </script>

    @stack('scripts')
</body>
</html>
