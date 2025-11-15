@extends('layouts.app')
@section('title', ' - Beranda')

@section('content')
    @include('components.hero')

    @include('components.search-filter')

    <!-- Rooms Section -->
    <div class="container mx-auto px-4 py-16">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Kamar Kos Pilihan
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Temukan kamar kos terbaik dengan fasilitas lengkap dan lokasi strategis
            </p>
        </div>

        <!-- Rooms Grid -->
        <div id="rooms-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($rooms as $room)
                @include('components.room-card', ['room' => $room])
            @empty
                <div class="col-span-full text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Kamar Tersedia</h3>
                    <p class="text-gray-600">Kamar kos akan segera ditampilkan di sini</p>
                </div>
            @endforelse
        </div>

        <!-- Load More Button (if pagination needed) -->
        @if(method_exists($rooms, 'hasMorePages') && $rooms->hasMorePages())
            <div class="text-center mt-12">
                <a href="{{ $rooms->nextPageUrl() }}" 
                   class="inline-flex items-center px-6 py-3 bg-white border-2 border-primary text-primary font-medium rounded-lg hover:bg-primary hover:text-white transition-all duration-300 shadow-sm hover:shadow-md">
                    <span>Lihat Lebih Banyak</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>

    <!-- Features Section -->
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Kenapa Memilih Kami?
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-14 h-14 bg-primary/10 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Terverifikasi</h3>
                    <p class="text-gray-600">Semua kamar kos sudah diverifikasi dan dijamin kualitasnya</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-14 h-14 bg-primary/10 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Support 24/7</h3>
                    <p class="text-gray-600">Tim support kami siap membantu Anda kapan saja</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="w-14 h-14 bg-primary/10 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Harga Terjangkau</h3>
                    <p class="text-gray-600">Berbagai pilihan harga sesuai dengan budget Anda</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-primary via-purple-600 to-purple-700 py-20">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-4 -right-4 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute -bottom-8 -left-8 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    Butuh Bantuan Menemukan Kamar Kos?
                </h2>
                <p class="text-lg text-white/95 mb-8 leading-relaxed">
                    Tim kami siap membantu Anda menemukan kamar kos yang sempurna sesuai kebutuhan dan budget Anda. 
                    Konsultasi gratis dan tanpa biaya tersembunyi!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <button class="group px-8 py-4 bg-white text-primary font-semibold rounded-lg hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 flex items-center">
                        <span>Hubungi Kami</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                    <a href="tel:+62123456789" class="px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-primary transition-all duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>Telepon Sekarang</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection