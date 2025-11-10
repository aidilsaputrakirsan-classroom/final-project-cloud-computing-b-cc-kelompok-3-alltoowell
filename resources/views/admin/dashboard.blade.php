@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard Admin Kost</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ([
        ['nama' => 'Kamar A1', 'harga' => 'Rp 900.000/bulan', 'status' => 'Terisi', 'img' => 'https://source.unsplash.com/400x300/?bedroom'],
        ['nama' => 'Kamar A2', 'harga' => 'Rp 850.000/bulan', 'status' => 'Kosong', 'img' => 'https://source.unsplash.com/401x300/?room'],
        ['nama' => 'Kamar B1', 'harga' => 'Rp 950.000/bulan', 'status' => 'Kosong', 'img' => 'https://source.unsplash.com/402x300/?apartment'],
        ['nama' => 'Kamar B2', 'harga' => 'Rp 1.000.000/bulan', 'status' => 'Terisi', 'img' => 'https://source.unsplash.com/403x300/?interior'],
        ['nama' => 'Kamar C1', 'harga' => 'Rp 1.200.000/bulan', 'status' => 'Kosong', 'img' => 'https://source.unsplash.com/404x300/?bed'],
    ] as $kamar)
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <img src="{{ $kamar['img'] }}" alt="{{ $kamar['nama'] }}" class="w-full h-48 object-cover">
        <div class="p-4">
            <h2 class="text-lg font-semibold mb-2">{{ $kamar['nama'] }}</h2>
            <p class="text-gray-700 mb-1">{{ $kamar['harga'] }}</p>
            <span class="inline-block px-3 py-1 rounded-full text-sm
                {{ $kamar['status'] == 'Kosong' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $kamar['status'] }}
            </span>
        </div>
    </div>
    @endforeach
</div>
@endsection
