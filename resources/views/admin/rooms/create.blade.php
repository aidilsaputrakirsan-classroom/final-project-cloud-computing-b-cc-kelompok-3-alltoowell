@extends('layouts.app')
@section('title', 'Tambah Kamar')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-purple-700 mb-6">Tambah Kamar</h1>

    <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
        @csrf

        <div class="mb-4">
            <label class="block font-medium mb-1">Nama Kamar</label>
            <input type="text" name="name" class="w-full border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Harga</label>
            <input type="number" name="price" class="w-full border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border-gray-300 rounded-lg"></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Kapasitas</label>
            <input type="number" name="capacity" min="1" class="w-full border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Lokasi</label>
            <input type="text" name="location" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Status</label>
            <select name="status" class="w-full border-gray-300 rounded-lg">
                <option value="available">Tersedia</option>
                <option value="occupied">Terisi</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Fasilitas</label>
            <div class="flex flex-wrap gap-3">
                @foreach (['AC', 'WiFi', 'Kamar Mandi Dalam', 'TV', 'Lemari', 'Meja'] as $facility)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="facilities[]" value="{{ $facility }}" class="text-purple-600">
                        <span>{{ $facility }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="mb-6">
            <label class="block font-medium mb-1">Gambar</label>
            <input type="file" name="image" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.rooms.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Batal</a>
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection
