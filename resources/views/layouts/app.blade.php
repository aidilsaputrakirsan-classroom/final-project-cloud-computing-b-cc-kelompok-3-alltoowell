<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Manajemen Kamar')</title>

    {{-- Vite CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-purple-700 text-white px-6 py-3 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">SI Kost</h1>
            <div class="space-x-4">
                <a href="{{ route('admin.rooms.index') }}" class="hover:text-gray-200">Kamar</a>
                <a href="#" class="hover:text-gray-200">Logout</a>
            </div>
        </div>
    </nav>

    {{-- Notifikasi popup --}}
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

    {{-- Konten utama --}}
    <main class="container mx-auto py-8 px-4">
        @yield('content')
    </main>

</body>
</html>
