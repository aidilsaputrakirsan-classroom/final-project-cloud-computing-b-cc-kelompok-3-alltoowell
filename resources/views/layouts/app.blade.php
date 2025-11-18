<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-KOST @yield('title')</title>

    {{-- Styles & JS via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- TailwindCDN fallback (tidak wajib, tapi aman jika vite tidak jalan) --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-50 text-gray-800">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">

            {{-- Logo --}}
            <a href="/" class="text-xl font-bold text-purple-600">
                SI-KOST
            </a>

            {{-- Right menu --}}
            <div class="flex items-center gap-4">

                @if(session('user_id'))
                    {{-- Greeting --}}
                    <span class="text-gray-700 hidden sm:block">
                        Halo, <strong>{{ session('user_name') }}</strong>
                    </span>

                    {{-- Admin Button --}}
                    @if(session('user_role') === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm">
                            Admin
                        </a>
                    @endif

                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-100">
                            Logout
                        </button>
                    </form>

                @else
                    {{-- Login --}}
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 text-sm">
                        Login
                    </a>
                @endif

            </div>
        </div>
    </nav>

    {{-- NOTIFICATION (SUCCESS / ERROR) --}}
    @if(session('success') || session('error'))
        <div 
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            class="fixed top-4 left-1/2 -translate-x-1/2 px-6 py-3 rounded-lg shadow-lg text-white text-center z-50
                {{ session('success') ? 'bg-green-600' : 'bg-red-600' }}"
        >
            {{ session('success') ?? session('error') }}
        </div>
    @endif

    {{-- CONTENT --}}
    <main class="max-w-6xl mx-auto px-4 py-10">
        @yield('content')
    </main>

</body>
</html>