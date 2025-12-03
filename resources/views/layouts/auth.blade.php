<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Auth')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    @stack('head')
</head>

<body class="bg-gray-100 min-h-screen">

    {{-- Tidak ada navbar di sini --}}
    @yield('content')

    <script> lucide.createIcons(); </script>
    @stack('scripts')

</body>
</html>
