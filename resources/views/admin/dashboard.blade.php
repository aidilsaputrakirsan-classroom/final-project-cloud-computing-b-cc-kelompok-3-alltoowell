@extends('layouts.admin')

@section('title','Dashboard')

@section('content')

<div class="p-6">

    <!-- GRID KPI -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <!-- Pendapatan -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Pendapatan Bulan Ini</p>
                    <h3 class="text-2xl font-bold mt-1">
                        Rp {{ number_format($monthlyRevenue,0,',','.') }}
                    </h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <i data-lucide="wallet" class="w-6 h-6 text-blue-600"></i>
                </div>
            </div>
        </div>

        <!-- Total Booking -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <p class="text-sm text-slate-500">Total Booking</p>
            <h3 class="text-2xl font-bold mt-1">{{ $totalBookings }}</h3>
            <div class="w-full bg-slate-200 h-2 rounded mt-4">
                <div class="h-2 bg-blue-500 rounded"
                     style="width: {{ min(100, $totalBookings * 10) }}%">
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <p class="text-sm text-slate-500">Menunggu Konfirmasi</p>
            <h3 class="text-2xl font-bold mt-1">{{ $pendingCount }}</h3>
            <span class="mt-3 inline-block px-3 py-1 rounded bg-yellow-100 text-yellow-700 text-xs">
                Pending
            </span>
        </div>

        <!-- Kamar -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <p class="text-sm text-slate-500">Kamar Tersedia</p>
            <h3 class="text-2xl font-bold mt-1">
                {{ $availableRooms }} / {{ $totalRooms }}
            </h3>
        </div>

    </div>

    <!-- CHARTS -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-8">

        <!-- Chart Booking -->
        <div class="bg-white rounded-xl shadow-sm border p-6 xl:col-span-2">
            <h3 class="font-semibold text-lg mb-4">Grafik Pemesanan</h3>
            <canvas id="bookingsChart" height="120"></canvas>
        </div>

        <!-- Chart Revenue -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h3 class="font-semibold text-lg mb-4">Pendapatan per Bulan</h3>
            <canvas id="revenueChart" height="120"></canvas>
        </div>

    </div>

    <!-- RECENT BOOKINGS -->
    <div class="bg-white rounded-xl shadow-sm border p-6 mt-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-lg">Booking Terbaru</h3>
            <a href="{{ route('admin.booking.index') }}" class="text-indigo-600 text-sm">
                Lihat semua →
            </a>
        </div>

      <div class="space-y-4">
@foreach($recentBookings as $b)
    <div class="flex items-start gap-4 p-4 border rounded-xl bg-slate-50">
        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
            <i data-lucide="calendar" class="w-6 h-6 text-indigo-600"></i>
        </div>

        <div class="flex-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-semibold">
                        {{ $b['name'] ?? 'Pengguna' }}
                    </p>

                    <p class="text-xs text-slate-500">
                        Kamar: {{ $b['room_name'] ?? '-' }}
                    </p>
                </div>

                <div class="text-right">
                    <p class="text-xs text-slate-500">
                        {{ isset($b['created_at'])
                            ? \Carbon\Carbon::parse($b['created_at'])->format('d M Y')
                            : '-' }}
                    </p>

                    <p class="font-semibold text-indigo-600">
                        Rp {{ number_format($b['room_price'] ?? 0,0,',','.') }}
                    </p>
                </div>
            </div>

            <span class="px-2 py-1 text-xs rounded mt-2 inline-block
                {{ ($b['status'] ?? 'pending') === 'pending'
                    ? 'bg-yellow-100 text-yellow-700'
                    : 'bg-green-100 text-green-700' }}">
                {{ ucfirst($b['status'] ?? 'pending') }}
            </span>

        </div>
    </div>
@endforeach
</div>

    </div>

</div>

@endsection

@push('scripts')
<script>
    const labels      = @json(array_keys($bookingChart));
    const bookingData = @json(array_values($bookingChart));
    const revenueData = @json(array_values($revenueChart));

    new Chart(document.getElementById('bookingsChart'), {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Booking',
                data: bookingData,
                fill: true,
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.15)',
                tension: .3
            }]
        }
    });

    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Pendapatan',
                data: revenueData,
                backgroundColor: 'rgba(99,102,241,0.8)',
                borderRadius: 8
            }]
        }
    });
</script>
@endpush
