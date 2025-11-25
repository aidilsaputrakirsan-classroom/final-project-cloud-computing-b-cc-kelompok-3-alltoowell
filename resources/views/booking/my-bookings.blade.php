@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-b from-blue-100 to-blue-200/50 py-12 px-4 fade-in">

    <div class="max-w-4xl mx-auto">

        {{-- Judul --}}
        <h1 class="text-3xl font-bold text-primary-dark mb-6 flex items-center gap-2">
            <i data-lucide="shopping-bag" class="w-7 h-7"></i>
            Pesanan Saya
        </h1>

        {{-- Tombol Kembali --}}
        <a href="{{ route('home') }}"
            class="inline-flex items-center gap-2 px-4 py-2 mb-6 rounded-lg
                   bg-white text-primary-dark font-medium shadow hover:bg-blue-50/70 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali ke Beranda
        </a>

        {{-- Jika tidak ada pesanan --}}
        @if(count($bookings) === 0)
            <div class="bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-lg text-center border border-blue-200">
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png"
                     class="w-28 mx-auto mb-4 opacity-80">
                <p class="text-gray-600 text-lg">Belum ada pesanan saat ini.</p>
            </div>
        @endif

        {{-- Daftar Pesanan --}}
        <div class="space-y-6">
            @foreach($bookings as $b)

                <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-md border border-blue-200 p-6
                            hover:shadow-xl hover:-translate-y-1 transition-all">

                    <div class="flex justify-between items-start">

                        {{-- Info --}}
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-1">
                                {{ $b['room']['name'] ?? 'Kamar' }}
                            </h2>

                            <p class="text-gray-600 text-sm">
                                Mulai Sewa:
                                {{ \Carbon\Carbon::parse($b['start_date'])->format('Y-m-d') }}
                            </p>

                            <p class="text-gray-600 text-sm">
                                Durasi: {{ $b['duration'] }} bulan
                            </p>

                            <p class="text-primary-dark font-semibold mt-2 text-lg">
                                Total: Rp {{ number_format($b['room']['price'] ?? 0, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- Status --}}
                        <span class="
                            px-4 py-1 rounded-full text-sm font-semibold shadow-sm
                            @if($b['status'] === 'pending')
                                bg-yellow-100 text-yellow-700
                            @elseif($b['status'] === 'confirmed')
                                bg-green-100 text-green-700
                            @else
                                bg-red-100 text-red-700
                            @endif
                        ">
                            {{ ucfirst($b['status']) }}
                        </span>

                    </div>

                </div>

            @endforeach
        </div>

    </div>
</div>

@endsection
