<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-KOST @yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background-color: #f3f4f6;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-md">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-purple-600">SI-KOST</a>

            <div class="flex items-center gap-4">
                @if(session('user_id'))
                    <span class="text-gray-700">Halo, <strong>{{ session('user_name') }}</strong></span>

                    @if(session('user_role') === 'admin')
                        <a href="/admin/dashboard"
                           class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm">
                            Admin
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/login"
                       class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 text-sm">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="flex-1 flex items-center justify-center py-10">
        @yield('content')
    </main>

</body>
</html>
