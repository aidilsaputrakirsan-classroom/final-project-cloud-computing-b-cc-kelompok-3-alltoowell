<nav class="bg-white/80 backdrop-blur-md border-b border-blue-100 sticky top-0 z-50 shadow-sm">
    <div class="container mx-auto px-4 flex items-center justify-between h-16">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="w-10 h-10 gradient-blue rounded-xl flex items-center justify-center shadow">
                <i data-lucide="home" class="w-6 h-6 text-white"></i>
            </div>
            <span class="text-xl font-bold text-primary">KOST-SI</span>
        </a>

        <!-- Menu -->
        <div class="hidden md:flex items-center gap-8">

            <a href="#hero" data-link="hero" class="nav-link">Beranda</a>

            <a href="#about-section" data-link="about-section" class="nav-link">Tentang</a>

            <a href="#contact" data-link="contact" class="nav-link">Kontak</a>

            <!-- Dark mode -->
            <button id="theme-toggle"
                    class="p-2 rounded-lg bg-gray-200 hover:bg-gray-300 transition">
                <i data-lucide="moon" class="w-5 h-5 text-gray-700"></i>
            </button>

            <!-- Login -->
            @if(!session()->has('user_id'))
                <a href="{{ route('login') }}"
                   class="px-6 py-2 gradient-blue text-white rounded-xl hover:shadow-md transition">
                    Login
                </a>
            @else
                <form action="{{ route('logout') }}" method="POST">@csrf
                    <button class="px-6 py-2 border-2 border-primary text-primary rounded-xl hover:bg-primary hover:text-white transition">
                        Logout
                    </button>
                </form>
            @endif

        </div>
    </div>
</nav>
