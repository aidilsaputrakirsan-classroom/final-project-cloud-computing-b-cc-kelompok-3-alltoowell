@extends('layouts.app')

@section('content')

<!-- HERO -->
<div class="relative bg-gradient-to-br from-primary via-primary to-purple-700 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-20" style="
        background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR...');">
    </div>

    <div class="container mx-auto px-4 py-16 md:py-24 relative">
        <div class="max-w-3xl animate-fade-in">
            <div class="flex items-center gap-2 mb-4">
                <i data-lucide="home" class="w-8 h-8"></i>
                <span class="text-sm tracking-wider uppercase opacity-90">Selamat Datang di</span>
            </div>

            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Temukan Kamar Kos Impianmu di ITK
            </h1>

            <p class="text-lg text-white/90 mb-8 max-w-2xl">
                Platform reservasi kamar kos terpercaya untuk mahasiswa Institut Teknologi Kalimantan.
                Mudah, cepat, dan aman!
            </p>

            <div class="grid grid-cols-3 gap-4 max-w-md">
                <div class="bg-white/10 p-4 rounded-lg text-center border border-white/20">
                    <div class="text-2xl font-bold mb-1">{{ $totalRooms }}</div>
                    <div class="text-sm text-white/80">Total Kamar</div>
                </div>

                <div class="bg-white/10 p-4 rounded-lg text-center border border-white/20">
                    <div class="text-2xl font-bold mb-1">{{ $availableRooms }}</div>
                    <div class="text-sm text-white/80">Tersedia</div>
                </div>

                <div class="bg-white/10 p-4 rounded-lg text-center border border-white/20">
                    <div class="text-2xl font-bold mb-1">4.8</div>
                    <div class="text-sm text-white/80">Rating</div>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" class="w-full">
            <path d="M0 0L60 10C120..." fill="white" />
        </svg>
    </div>
</div>

<!-- FILTER BOX -->
<div class="container mx-auto px-4 -mt-8 relative z-10">
    <div class="bg-white rounded-xl shadow-2xl p-6 animate-fade-in">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <input id="search-input"
                oninput="filterRooms()"
                type="text"
                placeholder="Cari nama kamar atau lokasi..."
                class="h-12 border border-gray-300 rounded-lg pl-4" />

            <select id="price-filter" onchange="filterRooms()"
                class="h-12 border border-gray-300 rounded-lg px-3">
                <option value="all">Semua Harga</option>
                <option value="low">&lt; 1 juta</option>
                <option value="medium">1 juta - 1.5 juta</option>
                <option value="high">&gt; 1.5 juta</option>
            </select>

            <select id="status-filter" onchange="filterRooms()"
                class="h-12 border border-gray-300 rounded-lg px-3">
                <option value="all">Semua Status</option>
                <option value="available">Tersedia</option>
                <option value="occupied">Terisi</option>
            </select>
        </div>

        <p class="mt-3 text-sm text-gray-600">
            Menampilkan <span id="filtered-count">{{ count($rooms) }}</span> kamar
        </p>
    </div>
</div>

<!-- GRID KAMAR -->
<div class="container mx-auto px-4 py-12">
    <div id="rooms-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($rooms as $room)
            @include('components.room-card', ['room' => $room])
        @endforeach

    </div>
</div>

@endsection
