@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">

    <h1 class="text-3xl md:text-4xl font-bold mb-8 text-primary tracking-wide">
        Daftar Kamar Kos
    </h1>

    @if(empty($rooms))
        <div class="bg-white p-6 rounded-xl shadow-md text-center text-gray-600">
            Tidak ada kamar tersedia.
        </div>
    @else

    <!-- GRID CARD -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach ($rooms as $room)
            <div class="group bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">

                {{-- GAMBAR --}}
                <div class="relative overflow-hidden">
                    <img src="{{ $room['image'] ?? 'https://via.placeholder.com/400' }}"
                        class="w-full h-52 object-cover group-hover:scale-110 transition-all duration-700"
                        alt="Foto kamar">

                    <!-- Badge Status -->
                    <div class="absolute top-3 right-3">
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                            {{ ($room['status'] ?? '') == 'available' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                            {{ ($room['status'] ?? '') == 'available' ? 'Tersedia' : 'Tidak Tersedia' }}
                        </span>
                    </div>
                </div>

                {{-- ISI CARD --}}
                <div class="p-5">

                    <h2 class="text-xl font-semibold mb-2 group-hover:text-primary transition">
                        {{ $room['name'] }}
                    </h2>

                    <p class="text-gray-500 text-sm flex items-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M17.657 16.657L13.414 12.414m0 0a4 4 0 10-5.657 5.657 4 4 0 005.657-5.657z" />
                        </svg>
                        {{ $room['location'] }}
                    </p>

                    {{-- HARGA --}}
                    <p class="text-primary font-extrabold text-2xl mt-2">
                        Rp {{ number_format($room['price'], 0, ',', '.') }}
                        <span class="text-gray-500 text-sm font-normal">/bulan</span>
                    </p>

                    {{-- Button --}}
                    <a href="{{ url('/rooms/'.$room['id']) }}"
                        class="block text-center bg-primary text-white py-2.5 mt-5 rounded-xl
                        font-medium text-lg shadow-md hover:bg-purple-700 hover:shadow-lg transition-all duration-300">
                        Lihat Detail
                    </a>

                </div>

            </div>
        @endforeach

    </div>

    @endif

</div>
@endsection
