@extends('layouts.admin')

@section('content')
<div class="p-6">

    <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-gray-500 text-sm">Total Kamar</h2>
            <p class="text-3xl font-bold">{{ count($rooms) }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-gray-500 text-sm">Kamar Tersedia</h2>
            <p class="text-3xl font-bold">
                {{ collect($rooms)->where('status', 'available')->count() }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-gray-500 text-sm">Total Booking</h2>
            <p class="text-3xl font-bold">{{ count($bookings) }}</p>
        </div>

    </div>


    {{-- TABEL BOOKING TERBARU --}}
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4">Booking Terbaru</h2>

        <table class="w-full text-left">
            <thead class="text-gray-600 border-b">
                <tr>
                    <th class="py-2">ID</th>
                    <th class="py-2">Nama Penyewa</th>
                    <th class="py-2">Kamar</th>
                    <th class="py-2">Tanggal</th>
                    <th class="py-2">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($bookings as $b)
                    <tr class="border-b">
                        <td class="py-2">{{ $b['id'] }}</td>
                        <td class="py-2">{{ $b['nama'] ?? '-' }}</td>
                        <td class="py-2">{{ $b['room_name'] ?? '-' }}</td>
                        <td class="py-2">{{ $b['created_at'] }}</td>
                        <td class="py-2">
                            <span class="px-3 py-1 rounded-full 
                                {{ $b['status'] === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $b['status'] === 'confirmed' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $b['status'] === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($b['status']) }}
                            </span>
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">
                        Tidak ada booking.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
