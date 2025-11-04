<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOST-SI @yield('title')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5B4FE3',
                        accent: '#10B981',
                        background: '#ffffff',
                        foreground: '#1a1a1a',
                        muted: '#ececf0',
                        'muted-foreground': '#717182',
                        border: '#d1d5db',
                    }
                }
            }
        }
    </script>

    <style>
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #5B4FE3; border-radius: 5px; }
        ::-webkit-scrollbar-thumb:hover { background: #4a3ec9; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
        .animate-slide-in { animation: slideIn 0.5s ease-out; }

        .room-card {
            transition: all 0.3s ease;
        }
        .room-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }
        .room-card img {
            transition: transform 0.5s ease;
        }
        .room-card:hover img {
            transform: scale(1.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    @include('components.navbar')
    <main>@yield('content')</main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
</body>
</html>
