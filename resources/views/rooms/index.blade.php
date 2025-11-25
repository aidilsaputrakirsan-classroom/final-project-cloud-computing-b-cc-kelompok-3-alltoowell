@extends('layouts.app')

@section('title', 'Daftar Kamar')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-sky-50 py-16">

    <div class="container mx-auto px-4">

        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-blue-600 mb-2">Daftar Kamar Kos</h1>
            <p class="text-gray-600 text-lg">Temukan kamar kos yang sesuai kebutuhanmu</p>
        </div>

        <a href="{{ route('home') }}"
           class="inline-flex items-center text-blue-600 font-medium bg-blue-100 px-4 py-2 rounded-lg hover:bg-blue-200 transition mb-6">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
            Kembali ke Beranda
        </a>

        <!-- FILTER CARD -->
        <div class="bg-white rounded-2xl shadow-xl border border-blue-100 p-6 mb-10">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <!-- Search -->
                <div class="md:col-span-2">
                    <div class="relative">
                        <i class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" data-lucide="search"></i>
                        <input id="searchInput" type="text"
                               placeholder="Cari nama kamar atau lokasi..."
                               class="w-full h-12 pl-12 rounded-xl border border-blue-200 focus:ring-2 focus:ring-blue-400 outline-none"
                               oninput="filterRooms()">
                    </div>
                </div>

                <!-- Harga -->
                <div>
                    <select id="priceFilter" class="w-full h-12 rounded-xl border border-blue-200 px-4"
                            onchange="filterRooms()">
                        <option value="all">Semua Harga</option>
                        <option value="low">< Rp 1.000.000</option>
                        <option value="mid">Rp 1.000.000 - 1.500.000</option>
                        <option value="high">> Rp 1.500.000</option>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <select id="statusFilter" class="w-full h-12 rounded-xl border border-blue-200 px-4"
                            onchange="filterRooms()">
                        <option value="all">Semua Status</option>
                        <option value="available">Tersedia</option>
                        <option value="unavailable">Terisi</option>
                    </select>
                </div>

            </div>

        </div>

        <!-- Room Cards -->
        <div id="roomsWrapper" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($rooms as $room)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden room-card transition hover:-translate-y-2 hover:shadow-2xl">

                <!-- FOTO -->
                <div class="h-52 overflow-hidden relative">
                    <img src="{{ room_image($room['image']) }}"
                         class="w-full h-full object-cover hover:scale-110 transition duration-700">

                    <!-- BADGE STATUS -->
                    <span class="absolute top-3 right-3 px-3 py-1 rounded-full text-sm font-semibold
                        {{ $room['status']=='available' ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700' }}">
                        {{ $room['status']=='available' ? 'Tersedia' : 'Terisi' }}
                    </span>
                </div>

                <div class="p-5">

                    <h2 class="text-xl font-bold mb-1 text-gray-800">{{ $room['name'] }}</h2>

                    <p class="text-gray-600 mb-2">{{ $room['location'] }}</p>

                    <p class="text-blue-600 font-bold text-2xl mb-4">
                        Rp {{ number_format($room['price'],0,',','.') }}
                    </p>

                    <a href="{{ url('/rooms/'.$room['id']) }}"
                       class="block text-center bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                        Lihat Detail
                    </a>

                </div>

            </div>
            @endforeach

        </div>

    </div>
</div>

<script>
function filterRooms() {
    let search = document.getElementById('searchInput').value.toLowerCase();
    let price = document.getElementById('priceFilter').value;
    let status = document.getElementById('statusFilter').value;

    document.querySelectorAll('.room-card').forEach(card => {

        let name = card.querySelector('h2').innerText.toLowerCase();
        let location = card.querySelector('p').innerText.toLowerCase();
        let priceValue = parseInt(card.querySelector('.text-blue-600').innerText.replace(/\D/g,''));
        let statusValue = card.querySelector('span').innerText.toLowerCase();

        let matchSearch = name.includes(search) || location.includes(search);

        let matchPrice =
            price === "all"
            || (price === "low" && priceValue < 1000000)
            || (price === "mid" && priceValue >= 1000000 && priceValue <= 1500000)
            || (price === "high" && priceValue > 1500000);

        let matchStatus =
            status === "all"
            || (status === "available" && statusValue.includes("tersedia"))
            || (status === "unavailable" && statusValue.includes("terisi"));

        card.style.display = (matchSearch && matchPrice && matchStatus) ? "block" : "none";
    });
}
</script>

@endsection
