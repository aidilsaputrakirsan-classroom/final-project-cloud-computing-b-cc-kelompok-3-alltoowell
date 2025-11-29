@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-b from-blue-100 to-blue-200/50 py-12 px-4 fade-in">

    <div class="max-w-4xl mx-auto">

        <h1 class="text-3xl font-bold text-primary-dark mb-6 flex items-center gap-2">
            <i data-lucide="shopping-bag" class="w-7 h-7"></i>
            Pesanan Saya
        </h1>

        <a href="{{ route('home') }}"
           class="inline-flex items-center gap-2 px-4 py-2 mb-6 rounded-lg
                  bg-white text-primary-dark font-medium shadow hover:bg-blue-50">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali ke Beranda
        </a>

        @if(count($bookings) === 0)
            <div class="bg-white p-8 rounded-2xl shadow text-center">
                <p class="text-gray-600 text-lg">Belum ada pesanan.</p>
            </div>
        @endif

        <div class="space-y-6">
            @foreach($bookings as $b)

                <div class="bg-white rounded-2xl shadow-md border border-blue-200 p-6">

                    <div class="flex justify-between items-start">

                        {{-- LEFT SIDE: INFO --}}
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-1">
                                {{ $b['room']['name'] ?? 'Kamar' }}
                            </h2>

                            <p class="text-gray-600 text-sm">
                                Mulai Sewa: {{ \Carbon\Carbon::parse($b['start_date'])->format('Y-m-d') }}
                            </p>

                            <p class="text-gray-600 text-sm">
                                Durasi: {{ $b['duration'] }} bulan
                            </p>

                            <p class="text-primary-dark font-semibold mt-2 text-lg">
                                Total: Rp {{ number_format($b['total_price'] ?? 0, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- RIGHT SIDE: STATUS BADGE --}}
                        <span
                            class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                            @if($b['status'] === 'pending') bg-yellow-200 text-yellow-800
                            @elseif($b['status'] === 'confirmed') bg-green-200 text-green-800
                            @else bg-red-200 text-red-800
                            @endif">
                            {{ ucfirst($b['status']) }}
                        </span>

                    </div>

                </div>

            @endforeach
        </div>

    </div>
</div>

@endsection
