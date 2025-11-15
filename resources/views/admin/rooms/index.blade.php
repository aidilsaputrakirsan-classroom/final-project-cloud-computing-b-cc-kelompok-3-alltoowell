@extends('layouts.app')

@section('title', 'Daftar Kamar')

@section('content')
<div class="container mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold" style="color: #5B3FE0;">Daftar Kamar</h1>
        <a href="{{ route('admin.rooms.create') }}" class="bg-[#5B3FE0] text-white px-4 py-2 rounded-lg hover:bg-[#4a32c9] transition">+ Tambah Kamar</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border border-gray-200 text-sm">
            <thead>
                <tr style="background-color: #5B3FE0;" class="text-white">
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Kapasitas</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Fasilitas</th>
                    <th class="px-4 py-3">Lokasi</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rooms as $room)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3">
                            @php
                                $image = $room['image'] ?? null;
                                $imagePath = $image 
                                    ? (filter_var($image, FILTER_VALIDATE_URL) ? $image : asset('storage/rooms/' . $image))
                                    : null;
                            @endphp
                            @if($imagePath)
                                <img src="{{ $imagePath }}" alt="{{ $room['name'] ?? 'Kamar' }}" class="w-24 h-16 object-cover rounded">
                            @else
                                <div class="w-24 h-16 bg-gray-200 flex items-center justify-center rounded text-gray-500">No Image</div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-semibold">{{ $room['name'] ?? '-' }}</td>
                        <td class="px-4 py-3">{{ isset($room['price']) ? 'Rp ' . number_format($room['price'],0,',','.') : '-' }}</td>
                        <td class="px-4 py-3">{{ $room['capacity'] ?? '-' }} org</td>
                        <td class="px-4 py-3">
                            @php $status = $room['status'] ?? 'unknown'; @endphp
                            <span class="px-3 py-1 rounded-full text-white text-xs {{ $status === 'available' ? 'bg-green-600' : ($status === 'unavailable' ? 'bg-red-500' : 'bg-gray-400') }}">{{ ucfirst($status) }}</span>
                        </td>
                        <td class="px-4 py-3">{{ !empty($room['facilities']) ? implode(', ', (array)$room['facilities']) : '-' }}</td>
                        <td class="px-4 py-3">{{ $room['location'] ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route('admin.rooms.edit', $room['id']) }}" class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 transition">Edit</a>
                                <form action="{{ route('admin.rooms.destroy', $room['id']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kamar ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">Belum ada data kamar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
