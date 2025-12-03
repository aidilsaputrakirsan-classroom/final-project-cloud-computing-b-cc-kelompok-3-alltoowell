@extends('layouts.admin')

@section('title', 'Kelola Kamar')

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Kelola Kamar</h1>

        <a href="{{ route('admin.rooms.create') }}"
            class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg shadow">
            + Tambah Kamar
        </a>
    </div>

    <div class="bg-white shadow-xl rounded-2xl border border-blue-100 p-4">

        <table class="w-full text-sm">
            <thead>
                <tr class="bg-blue-900 text-white text-left">
                    <th class="p-3 rounded-l-xl">Foto</th>
                    <th class="p-3">Nama Kamar</th>
                    <th class="p-3">Harga</th>
                    <th class="p-3">Kapasitas</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-right rounded-r-xl">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-blue-100">

                @forelse ($rooms as $room)

                <tr class="hover:bg-blue-50 transition">

                    <td class="p-3">
                        <img src="{{ room_image($room['image'] ?? null) }}"
                             class="w-24 h-16 object-cover rounded border border-gray-300 shadow-sm">
                    </td>

                    <td class="p-3 font-semibold text-slate-700">
                        {{ $room['name'] }}
                    </td>

                    <td class="p-3 font-bold text-blue-700">
                        Rp {{ number_format($room['price'],0,',','.') }}
                    </td>

                    <td class="p-3 text-slate-600">
                        {{ $room['capacity'] }} orang
                    </td>

                    <td class="p-3">
                        @php $status = $room['status']; @endphp

                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            {{ $status=='available'
                                ? 'bg-green-600 text-white'
                                : 'bg-red-600 text-white'
                            }}">
                            {{ ucfirst($status) }}
                        </span>
                    </td>

                    <td class="p-3">
                        <div class="flex justify-end gap-4">

                            <a href="{{ route('admin.rooms.edit', $room['id']) }}"
                               class="text-blue-700 font-semibold hover:underline">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.rooms.destroy', $room['id']) }}"
                                  onsubmit="return confirm('Hapus kamar ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="text-red-600 font-semibold hover:underline">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-slate-500">
                        Belum ada kamar terdaftar.
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

    </div>
</div>
@endsection
