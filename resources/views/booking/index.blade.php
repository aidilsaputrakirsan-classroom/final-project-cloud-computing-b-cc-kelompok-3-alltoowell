@extends('layouts.app')

@section('title', 'Booking Kamar')

@section('content')
<div class="container mx-auto px-4 py-10 fade-in">

    {{-- Kembali --}}
    <a href="{{ url('/rooms/'.$room['id']) }}"
       class="inline-flex items-center text-primary hover:underline mb-6">
        <i data-lucide="arrow-left" class="w-5 h-5 mr-1"></i>
        Kembali ke Detail Kamar
    </a>

    <h1 class="text-2xl font-bold text-primary mb-8">
        Booking Kamar {{ $room['name'] }}
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- FORM BOOKING --}}
        <div class="lg:col-span-2 bg-white shadow-lg rounded-2xl p-6">

            {{-- Info kamar --}}
            <div class="mb-6 bg-blue-50 border border-blue-100 rounded-xl p-4">
                <p class="text-sm">
                    <strong>Harga:</strong> Rp {{ number_format($room['price'],0,',','.') }}/bulan <br>
                    <strong>Lokasi:</strong> {{ $room['location'] }}
                </p>
            </div>

            <form action="{{ url('/booking/'.$room['id']) }}" method="POST">
                @csrf

                {{-- Nama --}}
                <label class="text-sm font-semibold">Nama</label>
                <input type="text" readonly value="{{ session('user_name') }}"
                    class="w-full p-3 bg-gray-100 rounded-xl mb-4">

                {{-- Email --}}
                <label class="text-sm font-semibold">Email</label>
                <input type="text" readonly value="{{ session('user_email') }}"
                    class="w-full p-3 bg-gray-100 rounded-xl mb-4">

                {{-- Telepon --}}
                <label class="text-sm font-semibold">Telepon</label>
                <input type="text" readonly value="{{ session('user_phone') }}"
                    class="w-full p-3 bg-gray-100 rounded-xl mb-6">

                {{-- Tanggal mulai --}}
                <label class="text-sm font-semibold">Tanggal Mulai</label>
                <input type="date" name="start_date" required
                    class="w-full p-3 border rounded-xl mb-6">

                {{-- Durasi --}}
                <label class="text-sm font-semibold">Durasi Sewa (bulan)</label>
                <select id="duration" name="duration"
                        class="w-full p-3 border rounded-xl mb-6"
                        onchange="updateTotal()">
                    @for($i=1;$i<=12;$i++)
                        <option value="{{ $i }}">{{ $i }} bulan</option>
                    @endfor
                </select>

                {{-- Metode Pembayaran --}}
                <label class="text-sm font-semibold">Metode Pembayaran</label>
                <select name="payment_method" class="w-full p-3 border rounded-xl mb-8">
                    <option value="Cash">Cash</option>
                    <option value="Transfer">Transfer Bank</option>
                </select>

                <button
                    class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 mt-2 block">
                    Konfirmasi Booking
                </button>

            </form>
        </div>

        {{-- SIDEBAR RINGKASAN --}}
        <div class="bg-white shadow-lg rounded-2xl p-6 h-fit">

            <h3 class="text-lg font-semibold mb-4 bg-gradient-to-r from-blue-100 to-white p-3 rounded-xl">
                Ringkasan Pemesanan
            </h3>

            <div class="space-y-4">

                <div>
                    <p class="text-gray-600 text-sm">Kamar</p>
                    <p class="font-semibold">{{ $room['name'] }}</p>
                </div>

                <div>
                    <p class="text-gray-600 text-sm">Lokasi</p>
                    <p class="font-semibold">{{ $room['location'] }}</p>
                </div>

                <div class="flex justify-between mt-4">
                    <span class="text-gray-600">Harga/bulan</span>
                    <span class="font-semibold">
                        Rp {{ number_format($room['price'],0,',','.') }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">Durasi</span>
                    <span id="durationLabel" class="font-semibold">1 bulan</span>
                </div>

                {{-- Total --}}
                <div class="bg-green-50 border border-green-200 p-4 rounded-xl mt-4">
                    <p class="text-sm text-green-700 font-semibold mb-1">Total Pembayaran</p>
                    <p id="totalPrice" class="text-xl font-bold text-green-700">
                        Rp {{ number_format($room['price'],0,',','.') }}
                    </p>
                </div>

                {{-- Info penting --}}
                <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-xl mt-4 text-sm">
                    <p class="font-semibold text-yellow-700 mb-2">🔔 Info Penting</p>
                    <ul class="space-y-1 text-yellow-800">
                        <li>• Setelah mengirim pesanan, tunggu konfirmasi admin.</li>
                        <li>• Admin akan menghubungi lewat email/WhatsApp.</li>
                        <li>• Proses verifikasi maksimal 1x24 jam.</li>
                    </ul>
                </div>

            </div>

        </div>

    </div>

</div>


{{-- HITUNG TOTAL OTOMATIS --}}
<script>
    const basePrice = {{ $room['price'] }};
    function updateTotal() {
        const duration = document.getElementById('duration').value;
        const total = basePrice * duration;

        document.getElementById('durationLabel').innerText = duration + ' bulan';
        document.getElementById('totalPrice').innerText =
            'Rp ' + total.toLocaleString('id-ID');
    }
</script>

@endsection
