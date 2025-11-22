@extends('layouts.app')

@section('navbar')
    @include('components.navbar')
@endsection

@section('content')

<!-- HERO -->
<div class="relative bg-gradient-to-br from-primary via-primary to-purple-700 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20"
         style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZp...');">
    </div>

    <div class="container mx-auto px-4 py-16 md:py-24 relative">
        <div class="max-w-3xl animate-fade-in">

            <div class="flex items-center gap-2 mb-4">
                <i data-lucide="home" class="w-8 h-8"></i>
                <span class="text-sm tracking-wider uppercase opacity-90">Selamat Datang di</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Temukan Kamar Kos Impianmu di ITK
            </h1>

            <p class="text-lg text-white/90 mb-8 max-w-2xl">
                Platform reservasi kamar kos terpercaya untuk mahasiswa Institut Teknologi Kalimantan.
                Mudah, cepat, dan aman!
            </p>

            <div class="grid grid-cols-3 gap-4 max-w-md">
                <div class="bg-white/10 rounded-lg p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold mb-1">6+</div>
                    <div class="text-sm text-white/80">Kamar</div>
                </div>

                <div class="bg-white/10 rounded-lg p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold mb-1">5</div>
                    <div class="text-sm text-white/80">Tersedia</div>
                </div>

                <div class="bg-white/10 rounded-lg p-4 text-center border border-white/20">
                    <div class="text-2xl font-bold mb-1">4.8</div>
                    <div class="text-sm text-white/80">Rating</div>
                </div>
            </div>

        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" class="w-full" fill="white">
            <path d="M0 0L60 10C120 20 ... 120H0V0Z"/>
        </svg>
    </div>
</div>

<!-- SEARCH & FILTER -->
<div class="container mx-auto px-4 -mt-8 relative z-10">
    @include('components.search-filter')
</div>

<!-- ROOMS GRID -->
<div class="container mx-auto px-4 py-12">
    <div id="rooms-grid"
         class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    </div>
</div>

<script>
    const rooms = [
        { id: 1, name: 'Kamar Deluxe A1', price: 1500000, image: '…', status: 'available', location: 'ITK' },
        { id: 2, name: 'Kamar Standard B2', price: 1000000, image: '…', status: 'available', location: 'Gunung Lingai' },
        { id: 3, name: 'Kamar Premium C3', price: 2000000, image: '…', status: 'available', location: 'Rapak Lambur' },
        { id: 4, name: 'Kamar Sharing D4', price: 750000,  image: '…', status: 'available', location: 'Pramuka' },
    ];

    function renderRooms() {
        const grid = document.getElementById('rooms-grid');
        grid.innerHTML = rooms.map(room => `
            <div class="room-card bg-white rounded-xl overflow-hidden shadow-lg">
                <img src="${room.image}" class="w-full h-56 object-cover" />
                <div class="p-5">
                    <h3 class="text-xl font-bold mb-2">${room.name}</h3>
                    <p class="text-gray-600">${room.location}</p>
                    <div class="mt-3 flex items-center justify-between">
                        <div>
                            <span class="text-primary font-bold text-lg">Rp ${room.price.toLocaleString('id-ID')}</span>
                        </div>
                        <a href="#" class="px-4 py-2 bg-orange-500 text-white rounded-lg">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        `).join('');
    }

    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
        renderRooms();
    });
</script>

@endsection
