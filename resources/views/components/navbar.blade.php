<nav class="bg-white border-b sticky top-0 z-50 shadow-sm">
    <div class="container mx-auto px-4 flex items-center justify-between h-16">
        <a href="/" class="flex items-center gap-2">
            <div class="w-10 h-10 bg-gradient-to-br from-primary to-purple-600 rounded-lg flex items-center justify-center">
                <i data-lucide="home" class="w-6 h-6 text-white"></i>
            </div>
            <span class="text-xl font-bold text-primary">KOST-SI</span>
        </a>

        <div class="flex items-center gap-4">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.bookings') }}" class="text-gray-700 hover:text-primary">Admin</a>
                @else
                    <a href="/" class="text-gray-700 hover:text-primary">Beranda</a>
                @endif
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button class="px-4 py-2 border rounded-lg hover:bg-gray-100">Logout</button>
                </form>
            @else
                <a href="/login" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-purple-700">Login</a>
            @endauth
        </div>
    </div>
</nav>
