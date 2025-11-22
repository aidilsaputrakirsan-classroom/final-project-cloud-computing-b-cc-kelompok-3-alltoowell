@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-10 fade-in">

    <a href="{{ url('/rooms') }}"
        class="inline-flex items-center text-primary dark:text-primary-light mb-6 hover:underline">
        <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i>
        Kembali ke daftar kamar
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

        <div>
            <img src="{{ $room['image'] ?? 'https://via.placeholder.com/800x600' }}"
                 class="w-full h-80 object-cover rounded-2xl shadow-lg">
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-xl p-8 rounded-2xl">

            <h1 class="text-3xl font-bold mb-3 dark:text-white">
                {{ $room['name'] }}
            </h1>

            <p class="text-gray-600 dark:text-gray-300 mb-3">
                <i data-lucide="map-pin" class="inline w-5 h-5 mr-1 text-primary"></i>
                {{ $room['location'] }}
            </p>

            <h2 class="text-3xl text-primary dark:text-primary-light font-bold mb-6">
                Rp {{ number_format($room['price'], 0, ',', '.') }}
            </h2>

            {{-- Fasilitas --}}
            <h3 class="text-xl font-semibold mb-3 dark:text-white">Fasilitas</h3>
            <div class="grid grid-cols-2 gap-2 mb-6">
                @foreach ($room['facilities'] ?? [] as $f)
                <div class="bg-gray-100 dark:bg-gray-700 px-3 py-2 rounded-xl flex items-center">
                    <i data-lucide="check" class="w-4 h-4 text-green-500 mr-2"></i>
                    <span class="dark:text-gray-200">{{ $f }}</span>
                </div>
                @endforeach
            </div>

            <a href="{{ url('/booking/'.$room['id']) }}"
               class="block bg-primary text-white text-center py-3 rounded-xl mt-5 text-lg font-semibold hover:bg-primary-dark transition">
                Pesan Sekarang
            </a>

        </div>
    </div>

</div>

@endsection
