{{-- resources/views/admin/bookings.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - SI KOST</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <h1 class="text-4xl font-bold text-purple-600 mb-8 text-center">ADMIN - DAFTAR BOOKING</h1>

        <!-- Toast Notification -->
        @if (session('toast'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6 text-center font-medium">
                {{ session('toast') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-purple-600 to-pink-600 text-white">
                    <tr>
                        <th class="px-6 py-5 text-left">ID Booking</th>
                        <th class="px-6 py-5 text-left">Penyewa</th>
                        <th class="px-6 py-5 text-left">Kamar</th>
                        <th class="px-6 py-5 text-left">Total</th>
                        <th class="px-6 py-5 text-center">Status</th>
                        <th class="px-6 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-purple-50 transition">
                            <td class="px-6 py-5 font-bold text-purple-600 text-lg">
                                {{ $booking['booking_id'] }}
                            </td>
                            <td class="px-6 py-5">
                                <div class="font-semibold">{{ $booking['user_name'] }}</div>
                                <div class="text-sm text-gray-600">{{ $booking['user_phone'] }}</div>
                                <div class="text-xs text-gray-500">NIK: {{ $booking['nik'] }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="font-medium">{{ $booking['room']['name'] }}</div>
                                <div class="text-sm text-gray-600">{{ $booking['room']['location'] }}</div>
                            </td>
                            <td class="px-6 py-5 font-bold text-right">
                                Rp {{ number_format($booking['total_price']) }}
                            </td>
                            <td class="px-6 py-5 text-center">
                                @if($booking['status'] === 'pending')
                                    <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-sm font-bold">PENDING</span>
                                @elseif($booking['status'] === 'confirmed')
                                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-bold">DITERIMA</span>
                                @elseif($booking['status'] === 'rejected')
                                    <span class="bg-red-100 text-red-800 px-4 py-2 rounded-full text-sm font-bold">DITOLAK</span>
                                @endif
                            </td>
                            <td class="px-6 py-5 text-center">
                                @if($booking['status'] === 'pending')
                                    <form action="/admin/bookings/{{ $booking['id'] }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 text-sm font-bold shadow transition">
                                            TERIMA
                                        </button>
                                    </form>
                                    <form action="/admin/bookings/{{ $booking['id'] }}" method="POST" class="inline ml-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 text-sm font-bold shadow transition">
                                            TOLAK
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-16 text-gray-500 text-xl">
                                Belum ada booking masuk
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8 text-center">
            <a href="/" class="text-purple-600 hover:underline text-lg font-medium">
                ← Kembali ke Form Booking
            </a>
        </div>
    </div>
</body>
</html>
