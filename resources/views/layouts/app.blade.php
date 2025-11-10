<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kost</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white min-h-screen p-4">
            <h2 class="text-2xl font-bold mb-6">Kost Admin</h2>
            <ul class="space-y-3">
                <li><a href="/admin/dashboard" class="block hover:bg-gray-700 p-2 rounded">🏠 Dashboard</a></li>
                <li><a href="#" class="block hover:bg-gray-700 p-2 rounded">🛏️ Data Kamar</a></li>
                <li><a href="#" class="block hover:bg-gray-700 p-2 rounded">👥 Penyewa</a></li>
                <li><a href="#" class="block hover:bg-gray-700 p-2 rounded">⚙️ Pengaturan</a></li>
            </ul>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
