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
                <tr class="hover:bg-blue-50/50 transition">

                    <!-- FOTO -->
                    <td class="p-3">
                        <img src="{{ $room['image']
                            ? asset('storage/rooms/' . $room['image'])
                            : 'https://via.placeholder.com/80' }}"
                            class="w-20 h-16 rounded-lg object-cover border border-blue-100 bg-white">
                    </td>

                    <!-- NAMA -->
                    <td class="p-3 font-semibold text-slate-700">
                        {{ $room['name'] }}
                    </td>

                    <!-- HARGA -->
                    <td class="p-3 text-blue-600 font-semibold">
                        Rp {{ number_format($room['price'], 0, ',', '.') }}
                    </td>

                    <!-- KAPASITAS -->
                    <td class="p-3">
                        {{ $room['capacity'] }} orang
                    </td>

                    <!-- STATUS -->
                    <td class="p-3">
                        <span class="
                            px-3 py-1 rounded-full text-xs font-semibold
                            {{ $room['status'] === 'available'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-700' }}
                        ">
                            {{ ucfirst($room['status']) }}
                        </span>
                    </td>

                    <!-- AKSI -->
                    <td class="p-3 flex items-center gap-3">

                        <!-- Edit -->
                        <a href="{{ route('admin.rooms.edit', $room['id']) }}"
                           class="text-blue-600 hover:underline">
                            Edit
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('admin.rooms.destroy', $room['id']) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus kamar ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-slate-500">
                        Tidak ada kamar terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>
@endsection
