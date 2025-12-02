@extends('layouts.app')

@section('title', $room['name'])

@section('content')

<div class="container mx-auto px-4 py-10">

    <a href="{{ route('rooms.index') }}"
       class="inline-flex items-center text-blue-600 mb-6 hover:underline">
        <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i>
        Kembali ke daftar kamar
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        <!-- KIRI -->
        <div class="lg:col-span-2 space-y-6">

            <!-- FOTO -->
            <div class="bg-white shadow-lg rounded-2xl p-4">
                <img src="{{ room_image($room['image']) }}"
                     class="w-full h-[380px] object-cover rounded-xl">
            </div>

            <!-- DESKRIPSI -->
            <div class="bg-white shadow-lg rounded-2xl p-6">
                <h3 class="text-xl font-semibold mb-3">Deskripsi</h3>
                <p class="text-gray-700 leading-relaxed">
                    Kamar kos nyaman dengan fasilitas lengkap dan dekat dengan kampus ITK.
                </p>
            </div>

            <!-- FASILITAS -->
            <div class="bg-white shadow-lg rounded-2xl p-6">
                <h3 class="text-xl font-semibold mb-4">Fasilitas Kamar</h3>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach ($room['facilities'] as $f)
                    <div class="bg-green-50 border border-green-100 px-4 py-2 rounded-xl flex items-center">
                        <i data-lucide="check" class="w-4 h-4 text-green-500 mr-2"></i>
                        <span class="text-gray-700">{{ $f }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- LOKASI -->
            <div class="bg-white shadow-lg rounded-2xl p-6">
                <h3 class="text-xl font-semibold mb-4">Lokasi</h3>
                <div class="w-full h-48 bg-gray-100 rounded-xl flex flex-col items-center justify-center">
                    <i data-lucide="map-pin" class="w-8 h-8 mb-2 text-blue-500"></i>
                    <p class="text-gray-700">{{ $room['location'] }}</p>
                </div>
            </div>

        </div>

        <!-- PANEL KANAN -->
        <div class="bg-white shadow-lg rounded-2xl p-6 h-fit">

            <h1 class="text-2xl font-bold mb-2">{{ $room['name'] }}</h1>

            <span class="px-4 py-1 rounded-full text-sm font-semibold
                {{ $room['status']=='available' ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700' }}">
                {{ $room['status']=='available' ? 'Tersedia' : 'Terisi' }}
            </span>

            <p class="text-gray-600 mt-3 flex items-center">
                <i data-lucide="map-pin" class="w-5 h-5 mr-1 text-blue-500"></i>
                {{ $room['location'] }}
            </p>

            <h2 class="text-3xl text-blue-600 font-bold mt-4">
                Rp {{ number_format($room['price'], 0, ',', '.') }}
            </h2>

            <p class="text-sm text-green-600 font-medium">
                Harga sudah termasuk listrik & air
            </p>

            <a href="{{ url('/booking/'.$room['id']) }}"
               class="block bg-blue-600 text-white text-center py-3 rounded-xl text-lg font-semibold mt-5 hover:bg-blue-700 transition">
                Pesan Sekarang
            </a>

        </div>

    </div>
</div>

@endsection
