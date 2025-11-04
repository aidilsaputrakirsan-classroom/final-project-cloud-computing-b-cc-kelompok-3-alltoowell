<div class="room-card bg-white rounded-xl overflow-hidden shadow-lg border-0 animate-fade-in" style="animation-delay: {{ $loop->index * 0.1 }}s">
    <div class="relative overflow-hidden">
        <img src="{{ $room['image'] }}" alt="{{ $room['name'] }}" class="w-full h-56 object-cover" />
        <div class="absolute top-4 right-4">
            <span class="px-3 py-1.5 rounded-full text-sm font-medium {{ $room['status'] === 'available' ? 'bg-green-500 text-white' : 'bg-gray-600 text-white' }}">
                {{ $room['status'] === 'available' ? 'Tersedia' : 'Terisi' }}
            </span>
        </div>
        <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1">
            <i data-lucide="star" class="w-4 h-4 text-yellow-500 fill-yellow-500"></i>
            <span class="text-sm font-medium">4.8</span>
        </div>
    </div>

    <div class="p-5">
        <h3 class="text-xl font-bold mb-2">{{ $room['name'] }}</h3>
        <div class="flex items-center text-gray-600 mb-3">
            <i data-lucide="map-pin" class="w-4 h-4 mr-1.5"></i>
            <p class="text-sm truncate">{{ $room['location'] }}</p>
        </div>

        <div class="flex items-center gap-2 mb-4 flex-wrap">
            <div class="flex items-center gap-1 bg-gray-100 px-2.5 py-1 rounded-full">
                <i data-lucide="users" class="w-3.5 h-3.5 text-gray-600"></i>
                <span class="text-xs text-gray-600">{{ $room['capacity'] }} orang</span>
            </div>
            @foreach(array_slice($room['facilities'], 0, 2) as $f)
                <div class="flex items-center gap-1 bg-gray-100 px-2.5 py-1 rounded-full">
                    <span class="text-xs text-gray-600">{{ $f }}</span>
                </div>
            @endforeach
            @if(count($room['facilities']) > 2)
                <span class="text-xs text-gray-500">+{{ count($room['facilities']) - 2 }} lainnya</span>
            @endif
        </div>

        <div class="flex items-center justify-between pt-4 border-t">
            <div>
                <p class="text-xs text-gray-500 mb-1">Mulai dari</p>
                <div class="flex items-baseline gap-1">
                    <span class="text-lg font-bold text-primary">Rp {{ number_format($room['price']) }}</span>
                    <span class="text-xs text-gray-500">/bulan</span>
                </div>
            </div>
            <a href="/rooms/{{ $room['id'] }}" class="px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                Detail
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </a>
        </div>
    </div>
</div>
