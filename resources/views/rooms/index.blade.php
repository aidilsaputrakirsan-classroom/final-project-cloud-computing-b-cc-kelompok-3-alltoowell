@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10 fade-in">

    <h1 class="text-3xl md:text-4xl font-bold mb-8 text-primary dark:text-primary-light">
        Daftar Kamar Kos
    </h1>

    @if(empty($rooms))
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md text-center text-gray-600 dark:text-gray-300">
            Tidak ada kamar tersedia.
        </div>
    @else

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach ($rooms as $room)
        <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden
                    border border-gray-100 dark:border-gray-700
                    hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 fade-in">

            <div class="relative overflow-hidden">
                <img src="{{ $room['image'] ?? 'https://via.placeholder.com/400' }}"
                     class="w-full h-52 object-cover group-hover:scale-110 transition-all duration-700">
            </div>

            <div class="p-5">

                <h2 class="text-xl font-semibold mb-2 group-hover:text-primary dark:text-primary-light transition">
                    {{ $room['name'] }}
                </h2>

                <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">
                    {{ $room['location'] }}
                </p>

                <p class="text-primary dark:text-primary-light font-extrabold text-2xl">
                    Rp {{ number_format($room['price'], 0, ',', '.') }}
                </p>

                <a href="{{ url('/rooms/'.$room['id']) }}"
                   class="block text-center bg-primary text-white py-2.5 mt-5 rounded-xl font-medium
                          hover:bg-primary-dark transition">
                    Lihat Detail
                </a>
            </div>

        </div>
        @endforeach

    </div>
    @endif

</div>
@endsection
