<div id="hero" class="relative hero-parallax hero-texture overflow-hidden">

    <!-- Background image -->
    <div class="absolute inset-0 bg-cover bg-center brightness-75"
         style="background-image: url('/images/hero-kamar.png');">
    </div>

    <!-- Floating bubbles -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="bubble"></div>
        <div class="bubble delay-2"></div>
        <div class="bubble delay-3"></div>
    </div>

    <div class="container mx-auto px-6 py-36 text-center relative z-20">
        <h1 class="text-white text-5xl md:text-7xl font-extrabold fade-up">
            Temukan Kamar Kos
            <br>
            <span class="bg-gradient-to-r from-yellow-200 to-pink-300 bg-clip-text text-transparent">
                Impianmu
            </span>
            di ITK
        </h1>

        <p class="text-blue-100 text-xl mt-6 max-w-2xl mx-auto fade-up">
            Hunian nyaman, modern, dekat kampus. Reservasi cepat dan aman.
        </p>

        <a href="{{ route('rooms.list') }}"
           class="mt-8 inline-block px-10 py-4 bg-white text-primary font-bold rounded-full shadow-lg hover:shadow-2xl transition fade-up">
            Lihat Daftar Kamar
        </a>
    </div>

    <!-- Wave -->
    <div class="absolute bottom-0 left-0 right-0 z-10">
        <svg viewBox="0 0 1440 120" class="w-full" fill="white">
            <path d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H0V0Z"/>
        </svg>
    </div>

</div>
