@extends('layouts.app')
@section('title', 'Daftar Kamar')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-purple-700">Daftar Kamar</h1>
    <a href="{{ route('admin.rooms.create') }}"
       class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
       + Tambah Kamar
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full border border-gray-200">
        <thead class="bg-purple-600 text-white">
            <tr>
                <th class="py-3 px-4 text-left">Nama</th>
                <th class="py-3 px-4 text-left">Harga</th>
                <th class="py-3 px-4 text-left">Kapasitas</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rooms as $room)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $room->name }}</td>
                    <td class="py-3 px-4">Rp {{ number_format($room->price, 0, ',', '.') }}</td>
                    <td class="py-3 px-4">{{ $room->capacity }} orang</td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 rounded text-white 
                            {{ $room->status == 'available' ? 'bg-green-600' : 'bg-red-600' }}">
                            {{ ucfirst($room->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-center space-x-2">
                        <a href="{{ route('admin.rooms.edit', $room) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded"
                                onclick="return confirm('Hapus kamar ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-4 text-gray-500">Belum ada data kamar</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
