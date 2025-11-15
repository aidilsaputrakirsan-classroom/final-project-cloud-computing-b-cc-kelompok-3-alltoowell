@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">

    {{-- Tombol kembali --}}
    <a href="{{ url('/rooms') }}"
       class="inline-flex items-center text-primary hover:text-purple-700 mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke daftar kamar
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

        {{-- Gambar kamar --}}
        <div>
            <img src="{{ $room['image'] ?? 'https://via.placeholder.com/800x600' }}"
                 class="w-full h-80 object-cover rounded-2xl shadow-lg"
                 alt="Foto kamar">

            {{-- Jika ingin galeri foto tambahan nanti bisa ditambah --}}
        </div>

        {{-- Informasi kamar --}}
        <div class="bg-white shadow-xl p-8 rounded-2xl">

            <h1 class="text-3xl font-bold mb-3">{{ $room['name'] }}</h1>

            <div class="text-gray-600 flex items-center mb-4">
                <i class="fa fa-map-marker mr-2 text-primary"></i>
                <span>{{ $room['location'] }}</span>
            </div>

            <div class="mb-6">
                <p class="text-gray-500 text-sm">Harga per bulan</p>
                <h2 class="text-3xl text-primary font-bold">
                    Rp {{ number_format($room['price'], 0, ',', '.') }}
                </h2>
            </div>

            {{-- Fasilitas --}}
            <div class="mb-6">
                <p class="text-xl font-semibold mb-3">Fasilitas</p>

                @if(!empty($room['facilities']))
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($room['facilities'] as $f)
                        <div class="flex items-center bg-gray-100 px-3 py-2 rounded-xl">
                            <i class="fa fa-check text-green-600 mr-2"></i>
                            <span class="text-gray-700">{{ $f }}</span>
                        </div>
                    @endforeach
                </div>
                @else
                    <p class="text-gray-500">Tidak ada fasilitas terdaftar.</p>
                @endif
            </div>

            {{-- Kapasitas --}}
            <div class="mb-6">
                <p class="text-xl font-semibold mb-1">Kapasitas</p>
                <p class="text-gray-700">{{ $room['capacity'] }} orang</p>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-6">
                <p class="text-xl font-semibold mb-2">Deskripsi</p>
                <p class="text-gray-600 leading-relaxed">
                    {{ $room['description'] ?? '-' }}
                </p>
            </div>

            {{-- Tombol Booking --}}
            <a href="{{ url('/booking/' . $room['id']) }}"
               class="block bg-primary text-white text-center py-3 rounded-xl mt-5 text-lg font-semibold hover:bg-purple-700 transition">
                Pesan Sekarang
            </a>

        </div>
    </div>

</div>
@endsection
