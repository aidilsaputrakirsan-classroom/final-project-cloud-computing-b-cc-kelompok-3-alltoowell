<section class="relative h-[600px] overflow-hidden light-dots flex items-center">
    <!-- Background -->
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1920&h=900&fit=crop"
             class="w-full h-full object-cover opacity-40">

        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 via-blue-800/80 to-blue-900/95"></div>
    </div>

    <!-- Content -->
    <div class="relative container mx-auto px-6">
        <div class="max-w-3xl text-white">

            <!-- Badge -->
            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-5 py-2 rounded-full mb-6 border border-white/20">
                <i data-lucide="sparkles" class="w-5 h-5"></i>
                <span class="text-sm font-semibold">Platform Terpercaya Mahasiswa ITK</span>
            </div>

            <!-- Heading -->
            <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                Temukan Kamar Kos <br>
                <span class="text-yellow-300">Impianmu</span> di ITK
            </h1>

            <!-- Sub Text -->
            <p class="text-lg text-gray-200 max-w-xl mb-8">
                Platform reservasi kamar kos modern untuk mahasiswa ITK.
                Cepat, nyaman, aman, dan terpercaya.
            </p>

            <!-- Action Button -->
            @if(session('is_logged_in'))
                <a href="{{ route('rooms.index') }}"
                   class="px-8 py-4 bg-white text-blue-700 font-semibold rounded-xl shadow-lg hover:bg-blue-50 inline-flex items-center gap-2 transition">
                    Lihat Daftar Kamar
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            @else
                <a href="{{ url('/login') }}"
                   class="px-8 py-4 bg-white text-blue-700 font-semibold rounded-xl shadow-lg hover:bg-blue-50 inline-flex items-center gap-2 transition">
                    Lihat Daftar Kamar
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            @endif

        </div>
    </div>
</section>
