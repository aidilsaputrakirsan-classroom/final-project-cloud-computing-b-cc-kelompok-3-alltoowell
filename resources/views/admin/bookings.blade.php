@extends('layouts.app')
@section('title', 'Admin - Daftar Booking')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Daftar Pemesanan</h1>
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Penyewa</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Kamar</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Tanggal</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($bookings as $b)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium">{{ $b['booking_id'] }}</td>
                        <td class="px-6 py-4 text-sm">{{ $b['user_name'] }}</td>
                        <td class="px-6 py-4 text-sm">{{ $b['room']['name'] ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">{{ $b['created_at'] }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $b['status'] == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($b['status']) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if($b['status'] == 'pending')
                            <form method="POST" action="{{ route('admin.bookings.update', $b['id']) }}" class="inline">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="confirmed">
                                <button class="px-3 py-1 bg-green-500 text-white rounded text-xs">Konfirmasi</button>
                            </form>
                            <form method="POST" action="{{ route('admin.bookings.update', $b['id']) }}" class="inline ml-2">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button class="px-3 py-1 bg-red-500 text-white rounded text-xs">Tolak</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
