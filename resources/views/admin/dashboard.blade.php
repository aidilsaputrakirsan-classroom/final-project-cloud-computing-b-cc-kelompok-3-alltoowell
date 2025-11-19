{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">Dashboard Admin</h1>

    {{-- KARTU STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="text-sm text-gray-500">Total Kamar</h3>
            <p class="text-2xl font-bold">{{ $totalRooms ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-2">Semua kamar terdaftar</p>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="text-sm text-gray-500">Kamar Tersedia</h3>
            <p class="text-2xl font-bold">{{ $availableRooms ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-2">Kamar yang berstatus tersedia</p>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="text-sm text-gray-500">Total Booking</h3>
            <p class="text-2xl font-bold">{{ $totalBookings ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-2">Semua pemesanan</p>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="text-sm text-gray-500">Pendapatan Bulan Ini</h3>
            <p class="text-2xl font-bold">Rp {{ number_format($monthlyRevenue ?? 0, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-2">Estimasi dari booking bulan berjalan</p>
        </div>

    </div>

    {{-- SECOND ROW: revenue total + status badges --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        <div class="col-span-2 bg-white shadow rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-3">Pendapatan Total</h3>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-3xl font-bold">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total akumulasi pendapatan dari semua booking</p>
                </div>

                <div class="grid grid-cols-1 gap-2 text-right">
                    <span class="text-xs text-gray-500">Rata-rata per booking</span>
                    @php
                        $avg = ($totalBookings && $totalBookings > 0) ? intval(($totalRevenue ?? 0) / $totalBookings) : 0;
                    @endphp
                    <span class="text-xl font-semibold">Rp {{ number_format($avg, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-3">Status Booking</h3>

            @php
                $pending = collect($bookings ?? [])->where('status', 'pending')->count();
                $confirmed = collect($bookings ?? [])->where('status', 'confirmed')->count();
                $rejected = collect($bookings ?? [])->where('status', 'rejected')->count();
            @endphp

            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium">Pending</p>
                        <p class="text-xs text-gray-500">Menunggu konfirmasi</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-block bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded-full">{{ $pending }}</span>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium">Confirmed</p>
                        <p class="text-xs text-gray-500">Selesai/terkonfirmasi</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">{{ $confirmed }}</span>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium">Rejected</p>
                        <p class="text-xs text-gray-500">Pembatalan / ditolak</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-block bg-red-100 text-red-800 text-sm px-3 py-1 rounded-full">{{ $rejected }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- GRAFIK: booking & revenue --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

<div class="col-span-2 bg-white shadow rounded-lg p-4">
    <h3 class="text-lg font-semibold mb-3">Grafik Pendapatan (per bulan)</h3>
    <div style="height:220px;">
        <canvas id="revenueChart"></canvas>
    </div>
</div>


<div class="bg-white shadow rounded-lg p-4">
    <h3 class="text-lg font-semibold mb-3">Grafik Booking (per bulan)</h3>
    <div style="height:220px;">
        <canvas id="bookingChart"></canvas>
    </div>
</div>
    </div>

    {{-- TOP ROOMS + RECENT BOOKINGS --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        <div class="col-span-2 bg-white shadow rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-3">Booking Terbaru</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Penyewa</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kamar</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Durasi</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Metode</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            @php
                $recent = collect($bookings ?? [])->sortByDesc('created_at')->values()->take(10);
            @endphp

            @forelse ($recent as $i => $b)
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $i + 1 }}</td>

                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ $b['user_name'] ?? $b['nama'] ?? ($b['user_email'] ?? '-') }}
                    </td>

                    {{-- Nama kamar --}}
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ $b['room_name'] ?? '-' }}
                    </td>

                    {{-- Tanggal --}}
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ \Carbon\Carbon::parse($b['created_at'] ?? now())->format('d M Y H:i') }}
                    </td>

                    {{-- Durasi --}}
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ $b['duration'] ?? '-' }} hari
                    </td>

                    {{-- Metode --}}
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ $b['payment_method'] ?? '-' }}
                    </td>

                    {{-- Harga --}}
                    <td class="px-4 py-2 text-sm text-gray-700">
                        Rp {{ number_format($b['room_price'] ?? 0, 0, ',', '.') }}
                    </td>

                    {{-- Status --}}
                    <td class="px-4 py-2 text-sm">
                        @php $st = $b['status'] ?? 'pending'; @endphp
                        <span class="px-3 py-1 rounded-full text-xs
                            {{ $st === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $st === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $st === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($st) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-4 py-6 text-center text-gray-500">Belum ada booking.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</div>

        <div class="bg-white shadow rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-3">Top Kamar Terlaris</h3>

            @if(!empty($topRooms) && count($topRooms) > 0)
                <ol class="space-y-3">
                    @foreach($topRooms as $name => $count)
                        <li class="flex items-center justify-between">
                            <div>
                                <p class="font-medium">{{ $name }}</p>
                                <p class="text-xs text-gray-500">Terpesan {{ $count }}x</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            @else
                <p class="text-sm text-gray-500">Belum ada data kamar terlaris.</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('admin.rooms.index') }}" class="block text-center bg-blue-600 text-white py-2 rounded">Kelola Kamar</a>
            </div>
        </div>

    </div>

</div>
@endsection

@section('scripts')
    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // === Ambil data dari controller (aman jika kosong) ===
        const revenueData = @json($revenueChart ?? []);
        const bookingData = @json($bookingChart ?? []);

        // Fungsi bantu untuk convert object (Y-m => value) ke labels & values
        function objToLabelsValues(obj) {
            const labels = [];
            const values = [];
            for (const k of Object.keys(obj)) {
                labels.push(k);
                values.push(obj[k]);
            }
            return { labels, values };
        }

// ----------------------------
// Revenue Chart (Line)
// ----------------------------
(function () {
    const ctx = document.getElementById('revenueChart');
    if (!ctx) return;

    const { labels, values } = objToLabelsValues(revenueData);

    new Chart(ctx.getContext('2d'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: values,
                tension: 0.35,
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const val = context.parsed.y ?? context.parsed;
                            return 'Rp ' + val.toLocaleString('id-ID');
                        }
                    }
                },
                legend: { display: false }
            }
        }
    });
})();


        // ----------------------------
        // Booking Chart (Line)
        // ----------------------------
        (function () {
            const ctx = document.getElementById('bookingChart');
            if (!ctx) return;

            const { labels, values } = objToLabelsValues(bookingData);

            new Chart(ctx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Booking',
                        data: values,
                        tension: 0.35,
                        fill: true,
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        })();
    </script>
@endsection
