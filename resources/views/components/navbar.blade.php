<nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <a href="/" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-gradient-to-br from-primary to-purple-600 rounded-lg flex items-center justify-center">
                    <i data-lucide="home" class="w-6 h-6 text-white"></i>
                </div>
                <span class="text-xl font-bold text-primary">KOST-SI</span>
            </a>

            <div class="flex items-center gap-4">
                <button onclick="window.location.href='/'" class="text-gray-700 hover:text-primary transition-colors">
                    Beranda
                </button>

                @auth
                    <button onclick="window.location.href='/dashboard'" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Dashboard
                    </button>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                            Logout
                        </button>
                    </form>
                @else
                    <button onclick="window.location.href='/login'" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Login
                    </button>
                @endauth
            </div>
        </div>
    </div>
</nav>
