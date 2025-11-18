@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">Kelola Booking</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Penyewa</th>
                    <th class="px-4 py-2 text-left">Kamar</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Durasi</th>
                    <th class="px-4 py-2 text-left">Harga</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

                @forelse ($bookings as $b)
                <tr>
                    <td class="px-4 py-2 text-gray-500 text-xs">{{ $b['id'] }}</td>

                    <td class="px-4 py-2">{{ $b['user_name'] }}</td>

                    <td class="px-4 py-2">
                        {{ $b['room']['name'] ?? '-' }}
                    </td>

                    <td class="px-4 py-2">
                        {{ \Carbon\Carbon::parse($b['start_date'])->format('d M Y') }}
                    </td>

                    <td class="px-4 py-2">
                        {{ $b['duration'] }} hari
                    </td>

                    <td class="px-4 py-2">
                        Rp {{ number_format($b['room']['price'] ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="px-4 py-2">
                        <span class="px-3 py-1 rounded-full text-xs
                            {{ $b['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $b['status'] === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $b['status'] === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($b['status']) }}
                        </span>
                    </td>

                    <td class="px-4 py-2">
                        <form action="{{ route('admin.rooms.updateStatus', $b['id']) }}" method="POST" class="flex gap-2">
                            @csrf

                            <select name="status" class="border rounded px-2 py-1 text-sm">
                                <option value="pending"   {{ $b['status'] === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $b['status'] === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="rejected"  {{ $b['status'] === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>

                            <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                Simpan
                            </button>
                        </form>
                    </td>
                </tr>
                @empty

                <tr>
                    <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                        Belum ada data booking.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
@endsection
