@extends('layouts.app')
@section('title', 'Edit Kamar')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-purple-700 mb-6">Edit Kamar</h1>

    <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium mb-1">Nama Kamar</label>
            <input type="text" name="name" value="{{ $room->name }}" class="w-full border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Harga</label>
            <input type="number" name="price" value="{{ $room->price }}" class="w-full border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border-gray-300 rounded-lg">{{ $room->description }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Kapasitas</label>
            <input type="number" name="capacity" min="1" value="{{ $room->capacity }}" class="w-full border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Lokasi</label>
            <input type="text" name="location" value="{{ $room->location }}" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Status</label>
            <select name="status" class="w-full border-gray-300 rounded-lg">
                <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Tersedia</option>
                <option value="occupied" {{ $room->status == 'occupied' ? 'selected' : '' }}>Terisi</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Fasilitas</label>
            <div class="flex flex-wrap gap-3">
                @foreach (['AC', 'WiFi', 'Kamar Mandi Dalam', 'TV', 'Lemari', 'Meja'] as $facility)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="facilities[]" value="{{ $facility }}"
                               {{ in_array($facility, $room->facilities ?? []) ? 'checked' : '' }}
                               class="text-purple-600">
                        <span>{{ $facility }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="mb-6">
            <label class="block font-medium mb-1">Gambar</label>
            @if ($room->image)
                <img src="{{ $room->image }}" alt="Room Image" class="w-32 h-32 object-cover rounded mb-3">
            @endif
            <input type="file" name="image" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.rooms.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Batal</a>
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">Perbarui</button>
        </div>
    </form>
</div>
@endsection
