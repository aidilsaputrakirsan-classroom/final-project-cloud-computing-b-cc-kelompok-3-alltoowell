@extends('layouts.app')

@section('title', 'Booking Kamar')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg max-w-3xl mx-auto p-8">

        <h1 class="text-3xl font-bold text-purple-600 mb-6">
            Booking Kamar {{ $room['name'] }}
        </h1>

        {{-- Informasi Kamar --}}
        <div class="bg-gray-50 p-6 rounded-xl mb-8">
            <p class="text-lg"><strong>Harga:</strong> Rp {{ number_format($room['price']) }}/bulan</p>
            <p class="text-lg"><strong>Lokasi:</strong> {{ $room['location'] }}</p>
        </div>

        <form action="{{ url('/booking/' . $room['id']) }}" method="POST">
            @csrf

            {{-- Nama otomatis --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Nama</label>
                <input type="text" value="{{ $user['name'] }}" disabled class="w-full p-3 border rounded-lg bg-gray-100">
            </div>

            {{-- Email otomatis --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Email</label>
                <input type="text" value="{{ $user['email'] }}" disabled class="w-full p-3 border rounded-lg bg-gray-100">
            </div>

            {{-- Phone otomatis --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Telepon</label>
                <input type="text" value="{{ $user['phone'] }}" disabled class="w-full p-3 border rounded-lg bg-gray-100">
            </div>

            {{-- NIK --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">NIK</label>
                <input type="text" name="nik" class="w-full p-3 border rounded-lg" required minlength="16" maxlength="16">
            </div>

            {{-- Tanggal mulai --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Tanggal Mulai</label>
                <input type="date" name="start_date" class="w-full p-3 border rounded-lg" required min="{{ date('Y-m-d') }}">
            </div>

            {{-- Durasi --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Durasi</label>
                <select name="duration" class="w-full p-3 border rounded-lg" required>
                    <option value="3">3 bulan</option>
                    <option value="6">6 bulan</option>
                    <option value="12">12 bulan</option>
                </select>
            </div>

            {{-- Pembayaran --}}
            <div class="mb-6">
                <label class="block mb-1 font-semibold">Metode Pembayaran</label>
                <select name="payment" class="w-full p-3 border rounded-lg" required>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="Cash">Cash</option>
                    <option value="E-Wallet">E-Wallet</option>
                </select>
            </div>

            <button class="w-full py-4 bg-purple-600 text-white rounded-xl font-bold text-lg hover:bg-purple-700">
                Kirim Booking
            </button>
        </form>
    </div>
</div>
@endsection
