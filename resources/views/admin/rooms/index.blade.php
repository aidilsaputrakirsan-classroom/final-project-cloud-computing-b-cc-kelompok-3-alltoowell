@extends('layouts.admin')

@section('title', 'Kelola Kamar')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-slate-800">Kelola Kamar</h1>

        <a href="{{ route('admin.rooms.create') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">
            Tambah Kamar
        </a>
    </div>

    <!-- CARD WRAPPER -->
    <div class="bg-white/70 backdrop-blur-xl border border-blue-100 shadow-lg rounded-2xl p-4">

        <table class="w-full text-sm">
            <thead>
                <tr class="text-slate-600 bg-blue-50 border-b border-blue-100">
                    <th class="p-3 text-left">Foto</th>
                    <th class="p-3 text-left">Nama Kamar</th>
                    <th class="p-3 text-left">Harga</th>
                    <th class="p-3 text-left">Kapasitas</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-blue-100">
                @forelse ($rooms as $room)

                <tr class="border-b hover:bg-gray-50 transition">

                    {{-- FOTO KAMAR --}}
                    <td class="px-4 py-3">

                        @php
                            $image = $room['image'] ?? null;
                            $imagePath = null;

                            if ($image) {
                                if (filter_var($image, FILTER_VALIDATE_URL)) {
                                    // image berupa URL
                                    $imagePath = $image;
                                } else {
                                    // image berupa nama file lokal → storage/rooms/
                                    $imagePath = asset('storage/rooms/' . $image);
                                }
                            }
                        @endphp

                        @if ($imagePath)
                            <img src="{{ $imagePath }}"
                                 class="w-24 h-16 object-cover rounded border border-gray-200">
                        @else
                            <div class="w-24 h-16 bg-gray-200 rounded flex items-center justify-center text-gray-500">
                                No Image
                            </div>
                        @endif
                    </td>

                    {{-- NAMA --}}
                    <td class="px-4 py-3 font-semibold">
                        {{ $room['name'] ?? '-' }}
                    </td>

                    {{-- HARGA --}}
                    <td class="px-4 py-3 text-blue-600 font-semibold">
                        Rp {{ number_format($room['price'], 0, ',', '.') }}
                    </td>

                    {{-- KAPASITAS --}}
                    <td class="px-4 py-3">
                        {{ $room['capacity'] ?? '-' }} orang
                    </td>

                    {{-- STATUS --}}
                    <td class="px-4 py-3">
                        @php $status = $room['status'] ?? 'unknown'; @endphp

                        <span class="px-3 py-1 rounded-full text-xs font-semibold text-white
                            {{ $status === 'available'
                                ? 'bg-green-600'
                                : 'bg-red-500' }}">
                            {{ ucfirst($status) }}
                        </span>
                    </td>

                    {{-- AKSI --}}
                    <td class="px-4 py-3">
                        <div class="flex gap-3">

                            <a href="{{ route('admin.rooms.edit', $room['id']) }}"
                               class="text-blue-600 hover:underline">
                                Edit
                            </a>

                            <form action="{{ route('admin.rooms.destroy', $room['id']) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus kamar ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">
                        Tidak ada kamar terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection
