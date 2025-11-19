<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- NAVBAR HORIZONTAL -->
    <nav class="w-full bg-blue-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <h1 class="text-xl font-bold">Admin Dashboard</h1>

            <ul class="flex items-center space-x-6 font-medium">
                <li>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="hover:text-gray-300 transition-all duration-200">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pengguna') }}" 
                       class="hover:text-gray-300 transition-all duration-200">
                        Data Pengguna
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto mt-8 p-6">
        @yield('content')
    </main>

</body>
</html>
