<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Manajemen Kamar')</title>

    {{-- Gunakan Vite untuk compile Tailwind dan JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-800 antialiased">

    {{-- Navbar --}}
    <nav class="bg-purple-700 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center px-6 py-3">
            <h1 class="text-xl font-bold tracking-wide">SI Kost</h1>
            <div class="flex items-center space-x-6">
                <a href="{{ route('admin.rooms.index') }}" 
                   class="hover:text-gray-200 transition-colors duration-200">Kamar</a>
                <a href="#" 
                   class="hover:text-gray-200 transition-colors duration-200">Logout</a>
            </div>
        </div>
    </nav>

    {{-- Notifikasi popup (Alpine.js) --}}
    <div 
        x-data="{
            show: @json(session('success') || session('error')),
            message: '{{ session('success') ?? session('error') }}',
            type: '{{ session('success') ? 'success' : (session('error') ? 'error' : '') }}'
        }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 3000)"
        class="fixed top-4 left-1/2 -translate-x-1/2 px-6 py-3 rounded-lg shadow-lg text-white text-center z-50"
        :class="{
            'bg-green-500': type === 'success',
            'bg-red-500': type === 'error'
        }"
        style="display: none;"
    >
        <p x-text="message" class="font-medium"></p>
    </div>

    {{-- Konten utama --}}
    <main class="container mx-auto py-10 px-4">
        @yield('content')
    </main>

</body>
</html>
