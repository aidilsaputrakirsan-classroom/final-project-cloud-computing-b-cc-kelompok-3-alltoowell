<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SI-KOST')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full flex flex-col items-center px-4">
        
        {{-- Alert --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 w-full max-w-xl text-center">
                {{ session('success') }}
            </div>
        @endif

        {{-- Konten halaman --}}
        @yield('content')
    </div>

</body>
</html>
