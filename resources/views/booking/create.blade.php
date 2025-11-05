@extends('layouts.app')
@section('title', 'Booking Kamar')

@section('content')
<div class="bg-gradient-to-r from-primary to-purple-700 text-white">
    <div class="container mx-auto px-4 py-8">
        <a href="javascript:history.back()" class="flex items-center gap-2 text-white/90 hover:text-white mb-4 group">
            <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1"></i> Kembali
        </a>
        <h1 class="text-4xl font-bold mb-2">Form Pemesanan Kamar</h1>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('booking.store', $room['id']) }}" method="POST" class="bg-white rounded-xl shadow-lg p-8 space-y-8">
                @csrf
                <!-- Data Pribadi -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                            <i data-lucide="user" class="w-5 h-5 text-primary"></i>
                        </div>
                        <h3 class="text-xl font-bold">Data Pribadi</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="name" value="{{ auth()->user()->name }}" required class="w-full px-4 py-2 border rounded-lg" placeholder="Nama Lengkap">
                        <input type="email" name="email" value="{{ auth()->user()->email }}" required class="w-full px-4 py-2 border rounded-lg" placeholder="Email">
                        <input type="tel" name="phone" required class="w-full px-4 py-2 border rounded-lg" placeholder="No. Telepon">
                        <input type="text" name="nik" required class="w-full px-4 py-2 border rounded-lg" placeholder="NIK">
                    </div>
                </div>

                <!-- Detail Sewa -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                            <i data-lucide="calendar" class="w-5 h-5 text-primary"></i>
                        </div>
                        <h3 class="text-xl font-bold">Detail Sewa</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="date" name="start_date" required min="{{ date('Y-m-d') }}" class="w-full px-4 py-2 border rounded-lg">
                        <select name="duration" required class="w-full px-4 py-2 border rounded-lg">
                            <option value="3">3 Bulan</option>
                            <option value="6" selected>6 Bulan</option>
                            <option value="12">12 Bulan</option>
                        </select>
                    </div>
                </div>

                <!-- Pembayaran -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                            <i data-lucide="credit-card" class="w-5 h-5 text-primary"></i>
                        </div>
                        <h3 class="text-xl font-bold">Metode Pembayaran</h3>
                    </div>
                    <select name="payment" required class="w-full px-4 py-2 border rounded-lg">
                        <option>Transfer Bank</option>
                        <option>Cash</option>
                        <option>E-Wallet</option>
                    </select>
                </div>

                <div class="flex gap-3">
                    <a href="javascript:history.back()" class="flex-1 h-12 border rounded-lg hover:bg-gray-50 flex items-center justify-center">Kembali</a>
                    <button type="submit" class="flex-1 h-12 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg flex items-center justify-center gap-2">
                        <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                        Kirim Pemesanan
                    </button>
                </div>
            </form>
        </div>

        <!-- Ringkasan -->
        <div class="lg:col-span-1">
            @include('booking.summary', ['room' => $room])
        </div>
    </div>
</div>

<script>
document.querySelector('[name="duration"]').addEventListener('change', function() {
    const months = this.value;
    const price = {{ $room['price'] }};
    const total = price * months;
    document.getElementById('total').textContent = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('duration').textContent = months + ' bulan';
});
lucide.createIcons();
</script>
@endsection
