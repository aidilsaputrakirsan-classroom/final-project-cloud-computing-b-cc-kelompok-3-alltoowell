<nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-purple-800 rounded-lg flex items-center justify-center shadow-md">
                    <i data-lucide="home" class="w-6 h-6 text-white"></i>
                </div>
                <span class="text-xl font-bold text-purple-700">KOST-SI</span>
            </a>

            {{-- MENU KANAN --}}
            <div class="flex items-center gap-4">

                {{-- USER SUDAH LOGIN --}}
                @auth
                    <div class="flex items-center gap-4">

                        {{-- Kalau ADMIN --}}
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                               class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium text-sm">
                                Admin Panel
                            </a>
                        @endif

                        {{-- Selamat datang + nama --}}
                        <span class="text-gray-700 hidden sm:block">
                            Halo, <strong>{{ auth()->user()->name }}</strong>
                        </span>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition text-sm font-medium">
                                Logout
                            </button>
                        </form>
                    </div>

                {{-- BELUM LOGIN --}}
                @else
                    <a href="{{ route('login') }}"
                       class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-semibold">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- Load icon Lucide --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
