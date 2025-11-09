@extends('layouts.app')

@section('title', 'Hapus Kamar')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h1 class="text-2xl font-bold mb-6 text-center" style="color: #5B3FE0;">Konfirmasi Hapus Kamar</h1>

    <div class="bg-gray-100 p-4 rounded-lg mb-6">
        <p class="text-gray-700 mb-2">Apakah kamu yakin ingin menghapus kamar berikut?</p>

        <div class="border border-gray-300 rounded-md p-4">
            <p><strong>Nama:</strong> {{ $room['name'] }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($room['price'], 0, ',', '.') }}</p>
            <p><strong>Kapasitas:</strong> {{ $room['capacity'] }} orang</p>
            <p><strong>Status:</strong> {{ ucfirst($room['status']) }}</p>
            <p><strong>Deskripsi:</strong> {{ $room['description'] ?? '-' }}</p>
            <p><strong>Fasilitas:</strong> 
                @if (isset($room['facilities']))
                    {{ is_array($room['facilities']) ? implode(', ', $room['facilities']) : $room['facilities'] }}
                @else
                    -
                @endif
            </p>
            <p><strong>Lokasi:</strong> {{ $room['location'] ?? '-' }}</p>
        </div>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.rooms.index') }}" 
           class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">
           Batal
        </a>

        <form action="{{ route('admin.rooms.destroy', $room['id']) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                Ya, Hapus
            </button>
        </form>
    </div>
</div>
@endsection
