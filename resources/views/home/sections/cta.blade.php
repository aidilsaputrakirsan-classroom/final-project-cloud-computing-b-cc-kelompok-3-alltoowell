<div class="relative py-24 bg-gradient-to-b from-blue-600 to-blue-700 text-white overflow-hidden">

    {{-- titik titik halus --}}
    <div class="absolute inset-0 opacity-20 pattern-dots"></div>

    {{-- glow putih lembut --}}
    <div class="absolute inset-0 bg-white/5 backdrop-blur-sm"></div>

    <div class="relative container mx-auto px-6 text-center">

        {{-- Icon bulat --}}
        <div class="w-20 h-20 bg-white/20 backdrop-blur rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-xl">
            <i data-lucide="rocket" class="w-10 h-10"></i>
        </div>

        <h2 class="text-4xl md:text-5xl font-bold mb-4">
            Siap Memulai Perjalananmu?
        </h2>

        <p class="text-blue-100 text-lg max-w-2xl mx-auto">
            Bergabunglah dengan mahasiswa ITK yang sudah menemukan kamar impiannya di KOST-SI. Cepat, modern, dan terpercaya.
        </p>

        {{-- Tombol CTA --}}
        <a href="{{ route('rooms.index') }}"
           class="mt-8 inline-flex items-center gap-3 px-8 py-4 bg-white text-blue-700 font-semibold rounded-xl shadow-lg hover:bg-blue-50 transition">
            Lihat Daftar Kamar Sekarang
            <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </a>

    </div>
</div>
