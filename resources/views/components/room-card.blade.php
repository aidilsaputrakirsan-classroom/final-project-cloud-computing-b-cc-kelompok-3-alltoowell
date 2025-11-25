@props(['room'])

@php
    // ============================
    // FIX FACILITIES FORMAT
    // ============================
    $rawFacilities = $room['facilities'] ?? null;
    $facilities = [];

    if (is_array($rawFacilities)) {
        $facilities = $rawFacilities;
    } elseif (is_string($rawFacilities)) {
        $jsonDecoded = json_decode($rawFacilities, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($jsonDecoded)) {
            $facilities = $jsonDecoded;
        } else {
            $facilities = array_filter(array_map('trim', explode(',', $rawFacilities)));
        }
    }
@endphp


<div class="bg-white shadow rounded-xl overflow-hidden h-full flex flex-col">
    
    {{-- IMAGE --}}
    <div class="w-full h-44 bg-gray-200 overflow-hidden">
        <img 
            src="{{ $room['image'] ?? '/default-room.jpg' }}" 
            alt="{{ $room['name'] }}"
            class="w-full h-full object-cover"
            onerror="this.src='/default-room.jpg'"
        >
    </div>

    {{-- CONTENT --}}
    <div class="p-4 flex flex-col flex-grow">

        <h3 class="text-lg font-bold leading-tight mb-1">
            {{ $room['name'] }}
        </h3>

        <p class="text-gray-600 text-sm mb-2 line-clamp-1">
            {{ $room['location'] }}
        </p>

        {{-- PRICE --}}
        <p class="text-green-600 font-semibold mb-2">
            Rp {{ number_format($room['price'], 0, ',', '.') }}/bulan
        </p>

        {{-- CAPACITY --}}
        <p class="text-gray-700 text-sm flex items-center mb-3">
            <i class="lucide-users w-4 h-4 mr-1"></i>
            {{ $room['capacity'] }} orang
        </p>

        {{-- FACILITIES --}}
        <div class="flex flex-wrap gap-2 mb-3">
            @foreach(array_slice($facilities, 0, 2) as $f)
                <span class="px-2 py-1 bg-gray-100 rounded-full text-xs text-gray-600">
                    {{ $f }}
                </span>
            @endforeach

            @if(count($facilities) > 2)
                <span class="text-xs text-gray-500">
                    +{{ count($facilities) - 2 }} lainnya
                </span>
            @endif
        </div>

        <div class="mt-auto">
            <a 
                href="/rooms/{{ $room['id'] }}"
                class="block bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 transition"
            >
                Lihat Detail
            </a>
        </div>

    </div>
</div>
