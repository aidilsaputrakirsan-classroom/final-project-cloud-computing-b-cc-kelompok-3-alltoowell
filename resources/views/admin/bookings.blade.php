@extends('layouts.admin')

@section('title', 'Kelola Booking')

@section('content')

<div class="p-6 max-w-6xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">Kelola Pemesanan</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-2xl overflow-hidden border">

        <table class="w-full text-sm">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">ID Booking</th>
                    <th class="px-6 py-3 text-left">Penyewa</th>
                    <th class="px-6 py-3 text-left">Kamar</th>
                    <th class="px-6 py-3 text-right">Total</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($bookings as $booking)
                <tr class="hover:bg-blue-50">

                    <td class="px-6 py-4 font-bold text-blue-600">
                        {{ $booking['booking_id'] }}
                    </td>

                    <td class="px-6 py-4">
                        <div class="font-semibold">{{ $booking['user_name'] }}</div>
                        <div class="text-gray-500 text-xs">{{ $booking['user_phone'] }}</div>
                        <div class="text-gray-400 text-xs">{{ $booking['user_email'] }}</div>
                    </td>

                    <td class="px-6 py-4">
                        <div class="font-medium">{{ $booking['room']['name'] }}</div>
                        <div class="text-gray-500 text-xs">{{ $booking['room']['location'] }}</div>
                    </td>

                    <td class="px-6 py-4 text-right font-bold">
                        Rp {{ number_format($booking['room']['price'] ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        @if($booking['status'] === 'pending')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Pending
                            </span>
                        @elseif($booking['status'] === 'confirmed')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Diterima
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Ditolak
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-center">

                        @if($booking['status'] === 'pending')

                        <form action="{{ route('admin.booking.update', $booking['id']) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="confirmed">
                            <button class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 text-xs">
                                Terima
                            </button>
                        </form>

                        <form action="{{ route('admin.booking.update', $booking['id']) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 text-xs">
                                Tolak
                            </button>
                        </form>

                        @else
                        <span class="text-gray-400 text-xs">Selesai</span>
                        @endif

                    </td>

                </tr>
                @empty

                <tr>
                    <td colspan="6" class="py-10 text-center text-gray-500">
                        Belum ada booking masuk.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
