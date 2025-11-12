<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-pink-600 rounded-xl flex items-center justify-center">
                    <span class="text-white font-bold text-2xl">SK</span>
                </div>
                <span class="text-2xl font-bold text-gray-800">SI-KOST</span>
            </a>

            <!-- Menu Desktop -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}"
                   class="text-gray-700 hover:text-purple-600 font-medium transition {{ request()->is('/') ? 'text-purple-600' : '' }}">
                    Beranda
                </a>

                <a href="/#rooms"
                   class="text-gray-700 hover:text-purple-600 font-medium transition">
                    Daftar Kamar
                </a>

                <!-- Tombol Login -->
                <a href="{{ route('login') }}"
                   class="px-6 py-2 bg-gradient-to-r from-yellow-300 to-yellow-400 text-purple-800 rounded-full shadow-lg hover:shadow-xl transition font-semibold transform hover:scale-105 border border-yellow-500">
                    Login
                </a>
            </div>

            <!-- Tombol Menu Mobile -->
            <button class="md:hidden text-gray-700" onclick="toggleMobileMenu()">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Menu Mobile -->
        <div id="mobileMenu" class="md:hidden hidden pb-4">
            <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-purple-600">Beranda</a>
            <a href="/#rooms" class="block py-2 text-gray-700 hover:text-purple-600">Daftar Kamar</a>
            <a href="{{ route('login') }}"
               class="block mt-4 px-6 py-3 bg-gradient-to-r from-yellow-300 to-yellow-400 text-purple-800 rounded-full text-center font-semibold shadow-md hover:shadow-lg border border-yellow-500">
                Login
            </a>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    }
</script>
