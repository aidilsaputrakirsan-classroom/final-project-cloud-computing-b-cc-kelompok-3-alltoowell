<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOST-SI - Sistem Reservasi Kamar Kos ITK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5B4FE3',
                        accent: '#10B981',
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #5B4FE3; border-radius: 5px; }
        ::-webkit-scrollbar-thumb:hover { background: #4a3ec9; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }

        .room-card { transition: all 0.3s ease; }
        .room-card:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1); }
        .room-card img { transition: transform 0.5s ease; }
        .room-card:hover img { transform: scale(1.1); }
    </style>
</head>
<body class="bg-gray-50">

    <!-- NAVBAR -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-purple-800 rounded-lg flex items-center justify-center shadow-md">
                        <i data-lucide="home" class="w-6 h-6 text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-purple-700">KOST-SI</span>
                </a>

                <div class="flex items-center gap-4">
                    @auth
                        <span class="text-gray-700 hidden sm:block">Halo, <strong>{{ auth()->user()->name }}</strong></span>
                        @if(auth()->user()->role === 'admin')
                            <a href="/admin" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 text-sm">Logout</button>
                        </form>
                    @else
                        <a href="/login" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 font-semibold">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <div class="relative bg-gradient-to-br from-primary via-primary to-purple-700 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00ek0yMCAyMGMwLTIuMjEtMS43OS00LTQtNHMtNCAxLjc5LTQgNCAxLjc5IDQgNCA0IDQtMS43OSA0LTR6Ii8+PC9nPjwvZz48L3N2Zz4=');"></div>
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
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center border border-white/20">
                        <div class="text-2xl font-bold mb-1">6+</div>
                        <div class="text-sm text-white/80">Kamar</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center border border-white/20">
                        <div class="text-2xl font-bold mb-1">5</div>
                        <div class="text-sm text-white/80">Tersedia</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 text-center border border-white/20">
                        <div class="text-2xl font-bold mb-1">4.8</div>
                        <div class="text-sm text-white/80">Rating</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z" fill="white"/>
            </svg>
        </div>
    </div>

    <!-- SEARCH & FILTER -->
    <div class="container mx-auto px-4 -mt-8 relative z-10">
        <div class="bg-white rounded-xl shadow-2xl p-6 animate-fade-in">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <div class="relative">
                        <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                        <input type="text" id="search-input" placeholder="Cari nama kamar atau lokasi..." class="w-full pl-10 h-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" oninput="filterRooms()" />
                    </div>
                </div>
                <div>
                    <select id="price-filter" onchange="filterRooms()" class="w-full h-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary px-3">
                        <option value="all">Semua Harga</option>
                        <option value="low">&lt; Rp 1.000.000</option>
                        <option value="medium">Rp 1.000.000 - 1.500.000</option>
                        <option value="high">&gt; Rp 1.500.000</option>
                    </select>
                </div>
                <div>
                    <select id="status-filter" onchange="filterRooms()" class="w-full h-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary px-3">
                        <option value="all">Semua Status</option>
                        <option value="available">Tersedia</option>
                        <option value="occupied">Terisi</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-between mt-4 pt-4 border-t">
                <p class="text-sm text-gray-600">
                    Menampilkan <span class="text-primary font-medium" id="filtered-count">6</span> dari 6 kamar
                </p>
            </div>
        </div>
    </div>

    <!-- ROOMS GRID -->
    <div class="container mx-auto px-4 py-12">
        <div id="rooms-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- JS akan isi di sini -->
        </div>
    </div>

    <script>
        const rooms = [
            { id: 1, name: 'Kamar Deluxe A1', price: 1500000, image: 'https://images.unsplash.com/photo-1668089677938-b52086753f77?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080', status: 'available', location: 'Jl. Soekarno Hatta No. 15' },
            { id: 2, name: 'Kamar Standard B2', price: 1000000, image: 'https://images.unsplash.com/photo-1579632151052-92f741fb9b79?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080', status: 'available', location: 'Jl. Gunung Lingai No. 8' },
            { id: 3, name: 'Kamar Premium C3', price: 2000000, image: 'https://images.unsplash.com/photo-1664813953289-7c3350f040e0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080', status: 'available', location: 'Jl. Rapak Lambur No. 22' },
            { id: 4, name: 'Kamar Sharing D4', price: 750000, image: 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080', status: 'available', location: 'Jl. Pramuka No. 5' },
            { id: 5, name: 'Kamar Deluxe A2', price: 1600000, image: 'https://images.unsplash.com/photo-1668089677938-b52086753f77?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080', status: 'available', location: 'Jl. Soekarno Hatta No. 15' },
            { id: 6, name: 'Kamar Standard B3', price: 950000, image: 'https://images.unsplash.com/photo-1579632151052-92f741fb9b79?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080', status: 'occupied', location: 'Jl. Mulawarman No. 12' },
        ];

        let filteredRooms = [...rooms];

        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            renderRooms();
        });

        function renderRooms() {
            const grid = document.getElementById('rooms-grid');
            grid.innerHTML = filteredRooms.map((room, i) => `
                <div class="room-card bg-white rounded-xl overflow-hidden shadow-lg border-0 animate-fade-in" style="animation-delay: ${i * 0.1}s">
                    <div class="relative overflow-hidden">
                        <img src="${room.image}" alt="${room.name}" class="w-full h-56 object-cover" />
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1.5 rounded-full text-sm font-medium ${room.status === 'available' ? 'bg-green-500 text-white' : 'bg-gray-600 text-white'}">
                                ${room.status === 'available' ? 'Tersedia' : 'Terisi'}
                            </span>
                        </div>
                        <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1">
                            <i data-lucide="star" class="w-4 h-4 text-yellow-500 fill-yellow-500"></i>
                            <span class="text-sm font-medium">4.8</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-bold mb-2">${room.name}</h3>
                        <div class="flex items-center text-gray-600 mb-3">
                            <i data-lucide="map-pin" class="w-4 h-4 mr-1.5"></i>
                            <p class="text-sm truncate">${room.location}</p>
                        </div>
                        <div class="flex items-center justify-between pt-4 border-t">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Mulai dari</p>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-lg font-bold text-primary">Rp ${room.price.toLocaleString('id-ID')}</span>
                                    <span class="text-xs text-gray-500">/bulan</span>
                                </div>
                            </div>
                            <button onclick="alert('Detail kamar ${room.id}')" class="px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                                Detail
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
            lucide.createIcons();
        }

        function filterRooms() {
            const search = document.getElementById('search-input').value.toLowerCase();
            const price = document.getElementById('price-filter').value;
            const status = document.getElementById('status-filter').value;

            filteredRooms = rooms.filter(room => {
                const matchesSearch = room.name.toLowerCase().includes(search) || room.location.toLowerCase().includes(search);
                const matchesPrice = price === 'all' ||
                    (price === 'low' && room.price < 1000000) ||
                    (price === 'medium' && room.price >= 1000000 && room.price < 1500000) ||
                    (price === 'high' && room.price >= 1500000);
                const matchesStatus = status === 'all' || room.status === status;
                return matchesSearch && matchesPrice && matchesStatus;
            });

            document.getElementById('filtered-count').textContent = filteredRooms.length;
            renderRooms();
        }
    </script>
</body>
</html>
