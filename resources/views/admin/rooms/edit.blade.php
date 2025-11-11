@extends('layouts.app')

@section('title', 'Edit Kamar')

@section('content')
<div class="container mx-auto p-6 max-w-3xl">
    <h1 class="text-3xl font-bold mb-6" style="color: #5B3FE0;">Edit Kamar</h1>

    <form action="{{ route('admin.rooms.update', $room['id']) }}" method="POST" class="bg-white p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Nama Kamar --}}
            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-1">Nama Kamar</label>
                <input type="text" name="name" id="name"
                    value="{{ old('name', $room['name'] ?? '') }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:border-[#5B3FE0]">
            </div>

            {{-- Harga --}}
            <div>
                <label for="price" class="block text-gray-700 font-semibold mb-1">Harga</label>
                <input type="number" name="price" id="price"
                    value="{{ old('price', $room['price'] ?? '') }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:border-[#5B3FE0]">
            </div>

            {{-- Kapasitas --}}
            <div>
                <label for="capacity" class="block text-gray-700 font-semibold mb-1">Kapasitas</label>
                <input type="number" name="capacity" id="capacity"
                    value="{{ old('capacity', $room['capacity'] ?? '') }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:border-[#5B3FE0]">
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block text-gray-700 font-semibold mb-1">Status</label>
                <select name="status" id="status"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:border-[#5B3FE0]">
                    <option value="available" {{ old('status', $room['status'] ?? '') == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="unavailable" {{ old('status', $room['status'] ?? '') == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>

            {{-- Deskripsi --}}
            <div class="md:col-span-2">
                <label for="description" class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:border-[#5B3FE0]">{{ old('description', $room['description'] ?? '') }}</textarea>
            </div>

            {{-- Fasilitas --}}
            <div class="md:col-span-2">
                <label for="facilities" class="block text-gray-700 font-semibold mb-1">Fasilitas (pisahkan dengan koma)</label>
                <input type="text" name="facilities" id="facilities"
                    value="{{ old('facilities', 
                        isset($room['facilities']) 
                            ? (is_array($room['facilities']) 
                                ? implode(', ', $room['facilities']) 
                                : (is_string($room['facilities']) ? $room['facilities'] : '')
                              ) 
                            : ''
                    ) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:border-[#5B3FE0]">
            </div>

            {{-- Lokasi --}}
            <div class="md:col-span-2">
                <label for="location" class="block text-gray-700 font-semibold mb-1">Lokasi</label>
                <input type="text" name="location" id="location"
                    value="{{ old('location', $room['location'] ?? '') }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:border-[#5B3FE0]">
            </div>

            {{-- Tombol --}}
            <div class="md:col-span-2 flex justify-end gap-2 mt-6">
                <a href="{{ route('admin.rooms.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition">Batal</a>
                <button type="submit" class="bg-[#5B3FE0] text-white px-4 py-2 rounded-lg hover:bg-[#4a32c9] transition">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>
@endsection
