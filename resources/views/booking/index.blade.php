@extends('layouts.app')

@section('title', 'Booking Kamar')

@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-3xl font-bold text-purple-600 mb-6">
        Booking Kamar {{ $room['name'] }}
    </h1>

    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <p><strong>Harga:</strong> Rp {{ number_format($room['price'], 0, ',', '.') }}/bulan</p>
        <p><strong>Lokasi:</strong> {{ $room['location'] }}</p>
    </div>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('booking.store', $room['id']) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-semibold">Nama</label>
            <input type="text" value="{{ session('user_name') }}" disabled
                   class="w-full p-3 border rounded-lg bg-gray-100">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Email</label>
            <input type="text" value="{{ session('user_email') }}" disabled
                   class="w-full p-3 border rounded-lg bg-gray-100">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Telepon</label>
            <input type="text" value="{{ session('user_phone') }}" disabled
                   class="w-full p-3 border rounded-lg bg-gray-100">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Tanggal Mulai</label>
            <input type="date" name="start_date" required
                   class="w-full p-3 border rounded-lg @error('start_date') border-red-500 @enderror">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Durasi (hari)</label>
            <input type="number" name="duration" min="1" required
                   class="w-full p-3 border rounded-lg @error('duration') border-red-500 @enderror">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Metode Pembayaran</label>
            <select name="payment_method" required class="w-full p-3 border rounded-lg">
                <option value="cash">Cash</option>
                <option value="transfer">Transfer Bank</option>
                <option value="ewallet">E-Wallet</option>
            </select>
        </div>

        <button type="submit"
                class="w-full bg-purple-600 text-white py-3 rounded-lg font-bold hover:bg-purple-700">
            Konfirmasi Booking
        </button>

    </form>
</div>
@endsection
