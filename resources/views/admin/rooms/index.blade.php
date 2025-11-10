@extends('layouts.app')

@section('title', 'Daftar Kamar')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold" style="color: #5B3FE0;">Daftar Kamar</h1>
        <a href="{{ route('admin.rooms.create') }}" 
           class="bg-[#5B3FE0] text-white px-4 py-2 rounded-lg hover:bg-[#4a32c9] transition">
            + Tambah Kamar
        </a>
    </div>

    {{-- Notifikasi sukses / error --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full border border-gray-200 text-sm text-center">
            <thead>
                <tr style="background-color: #5B3FE0;" class="text-white">
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Harga</th>
                    <th class="px-4 py-2">Kapasitas</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Deskripsi</th>
                    <th class="px-4 py-2">Fasilitas</th>
                    <th class="px-4 py-2">Lokasi</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rooms as $room)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $room['name'] ?? '-' }}</td>
                        <td class="px-4 py-2">
                            @if (isset($room['price']))
                                Rp {{ number_format($room['price'], 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $room['capacity'] ?? '-' }} orang</td>
                        <td class="px-4 py-2">
                            @php
                                $status = $room['status'] ?? 'unknown';
                            @endphp
                            <span class="px-2 py-1 rounded text-white 
                                {{ $status === 'available' ? 'bg-green-600' : ($status === 'unavailable' ? 'bg-red-500' : 'bg-gray-400') }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $room['description'] ?? '-' }}</td>
                        <td class="px-4 py-2">
                            @if (!empty($room['facilities']))
                                {{ is_array($room['facilities']) ? implode(', ', $room['facilities']) : $room['facilities'] }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $room['location'] ?? '-' }}</td>
                        <td class="px-4 py-2">
                            <div class="flex justify-center gap-2">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.rooms.edit', $room['id'] ?? $room['uuid']) }}"
                                   class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition">
                                    Edit
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.rooms.destroy', $room['id'] ?? $room['uuid']) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kamar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-4 text-gray-500">Belum ada data kamar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
