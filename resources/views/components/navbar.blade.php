@php
    $loggedIn = session()->has('user_id');
    $role = session('user_role');
@endphp

<nav class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-50 shadow-sm">
    <div class="container mx-auto px-6 h-20 flex items-center justify-between">

        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl shadow-lg flex items-center justify-center">
                <i data-lucide="home" class="w-6 h-6 text-white"></i>
            </div>
            <span class="text-2xl font-extrabold text-blue-600 tracking-wide">KOST-SI</span>
        </a>

        <div class="flex items-center gap-8">

            {{-- TAMU --}}
            @if(!$loggedIn)
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Beranda</a>
                <a href="#tentang" class="text-gray-700 hover:text-blue-600">Tentang</a>
                <a href="#kontak" class="text-gray-700 hover:text-blue-600">Kontak</a>

                <a href="{{ route('login') }}"
                    class="px-6 py-2 bg-gradient-to-r from-blue-400 to-blue-600 text-white rounded-xl shadow-md hover:shadow-xl font-semibold">
                    Login
                </a>
            @endif

            {{-- USER LOGIN --}}
            @if($loggedIn && $role === 'user')
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Beranda</a>
                <a href="#tentang" class="text-gray-700 hover:text-blue-600">Tentang</a>
                <a href="#kontak" class="text-gray-700 hover:text-blue-600">Kontak</a>

                <a href="{{ route('user.bookings') }}"
                    class="px-6 py-2 bg-gradient-to-r from-blue-400 to-blue-600 text-white rounded-xl shadow-md hover:shadow-xl font-semibold">
                    Pesanan Saya
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="px-5 py-2 border border-blue-500 text-blue-600 rounded-xl hover:bg-blue-50">
                        Logout
                    </button>
                </form>
            @endif

            {{-- ADMIN --}}
            @if($loggedIn && $role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600">
                    Dashboard Admin
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="px-5 py-2 border border-blue-500 text-blue-600 rounded-xl hover:bg-blue-50">
                        Logout
                    </button>
                </form>
            @endif

        </div>
    </div>
</nav>
