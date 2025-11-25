@extends('layouts.admin')

@section('title','Dashboard')

@section('content')

<div class="p-6">

    {{-- ====== PAGE TITLE ====== --}}
    <h1 class="text-3xl font-bold text-slate-800 mb-6">Dashboard</h1>

    {{-- ====== KPI CARDS ====== --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        {{-- Pendapatan Bulan Ini --}}
        <div class="p-6 bg-white shadow-lg rounded-2xl border border-blue-100">
            <p class="text-sm text-slate-500">Pendapatan Bulan Ini</p>
            <h3 class="text-3xl font-bold text-primary mt-2">
                Rp {{ number_format($monthlyRevenue,0,',','.') }}
            </h3>
        </div>

        {{-- Total Booking --}}
        <div class="p-6 bg-white shadow-lg rounded-2xl border border-blue-100">
            <p class="text-sm text-slate-500">Total Booking</p>
            <h3 class="text-3xl font-bold text-primary mt-2">{{ $totalBookings }}</h3>

            <div class="mt-3 w-full bg-blue-100 h-2 rounded-lg">
                <div class="h-2 bg-primary rounded-lg"
                    style="width: {{ min(100, $totalBookings * 10) }}%">
                </div>
            </div>
        </div>

        {{-- Pending --}}
        <div class="p-6 bg-white shadow-lg rounded-2xl border border-blue-100">
            <p class="text-sm text-slate-500">Menunggu Konfirmasi</p>
            <h3 class="text-3xl font-bold text-primary mt-2">{{ $pendingCount }}</h3>

            <span class="inline-block mt-3 px-3 py-1 rounded bg-yellow-100 text-yellow-700 text-xs">
                Pending
            </span>
        </div>

        {{-- Kamar Tersedia --}}
        <div class="p-6 bg-white shadow-lg rounded-2xl border border-blue-100">
            <p class="text-sm text-slate-500">Kamar Tersedia</p>
            <h3 class="text-3xl font-bold text-primary mt-2">
                {{ $availableRooms }} / {{ $totalRooms }}
            </h3>
        </div>

    </div>



    {{-- ====== CHARTS ====== --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-10">

        {{-- PIE CHART Booking --}}
        <div class="bg-white shadow-lg rounded-2xl p-6 border border-blue-100 xl:col-span-2">
            <h3 class="font-semibold mb-4 text-slate-700">Grafik Pemesanan</h3>

            <div class="w-full flex justify-center">
                <canvas id="bookingsChart" style="max-width: 380px; max-height:380px;"></canvas>
            </div>
        </div>

        {{-- Revenue Chart --}}
        <div class="bg-white shadow-lg rounded-2xl p-6 border border-blue-100">
            <h3 class="font-semibold mb-4 text-slate-700">Pendapatan per Bulan</h3>
            <canvas id="revenueChart" style="height:330px"></canvas>
        </div>

    </div>



    {{-- ====== BOOKING TERBARU ====== --}}
    <div class="bg-white shadow-lg rounded-2xl p-6 border border-blue-100 mt-10">

        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold text-slate-700">Booking Terbaru</h3>
            <a href="{{ route('admin.booking.index') }}" class="text-primary text-sm">Lihat semua →</a>
        </div>

        <div class="space-y-4">
            @foreach($recentBookings as $b)
                <div class="flex items-start gap-4 bg-blue-50 p-4 rounded-xl">

                    {{-- ICON --}}
                    <div class="w-12 h-12 bg-primary-light rounded-xl flex items-center justify-center">
                        <i data-lucide="calendar" class="w-6 h-6 text-primary-dark"></i>
                    </div>

                    <div class="flex-1">

                        {{-- Nama User --}}
                        <p class="font-semibold text-slate-800">
                            {{ $b['name'] ?? 'Pengguna' }}
                        </p>

                        {{-- Nama Kamar --}}
                        <p class="text-xs text-slate-500">
                            Kamar: {{ $b['room_name'] ?? '-' }}
                        </p>

                        {{-- Tanggal --}}
                        <p class="text-xs text-slate-500 mt-1">
                            {{ isset($b['created_at']) ? \Carbon\Carbon::parse($b['created_at'])->format('d M Y') : '-' }}
                        </p>

                        {{-- Harga --}}
                        <span class="px-3 py-1 rounded bg-blue-100 text-blue-700 text-xs mt-2 inline-block">
                            Rp {{ number_format($b['room_price'] ?? 0, 0, ',', '.') }}
                        </span>

                        {{-- Status --}}
                        <span class="ml-2 px-2 py-1 text-xs rounded
                            {{ ($b['status'] ?? '')=='pending'
                                ? 'bg-yellow-100 text-yellow-700'
                                : (($b['status'] ?? '')=='confirmed'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-700') }}">
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels      = @json(array_keys($bookingChart));
    const bookingData = @json(array_values($bookingChart));
    const revenueData = @json(array_values($revenueChart));

    /* ========================
       PIE CHART (BOOKINGS)
    ========================== */
    new Chart(document.getElementById('bookingsChart'), {
        type: 'pie',
        data: {
            labels,
            datasets: [{
                label: 'Booking',
                data: bookingData,
                backgroundColor: [
                    '#1D4ED8','#2563EB','#3B82F6','#60A5FA','#93C5FD'
                ],
                borderColor: '#ffffff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });


    /* ========================
       BAR CHART (REVENUE)
    ========================== */
    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Pendapatan',
                data: revenueData,
                backgroundColor: '#3B82F6',
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero:true } }
        }
    });

</script>
@endpush
