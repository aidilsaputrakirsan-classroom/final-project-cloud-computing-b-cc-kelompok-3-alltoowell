<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Kamar - {{ $room['name'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg max-w-2xl mx-auto p-8">
            <h1 class="text-3xl font-bold text-purple-600 mb-6 text-center">
                Booking Kamar {{ $room['name'] }}
            </h1>

            <div class="bg-gray-50 p-6 rounded-lg mb-8">
                <div class="grid grid-cols-2 gap-4 text-lg">
                    <div><strong>Harga per bulan:</strong></div>
                    <div class="text-right">Rp {{ number_format($room['price']) }}</div>
                    <div><strong>Lokasi:</strong></div>
                    <div class="text-right">{{ $room['location'] }}</div>
                </div>
            </div>

            <form action="/booking/{{ $room['id'] }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 border rounded-lg" placeholder="Budi Santoso">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Email</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 border rounded-lg" placeholder="budi@gmail.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">No. Telepon</label>
                        <input type="text" name="phone" required minlength="10" class="w-full px-4 py-3 border rounded-lg" placeholder="081234567890">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">NIK</label>
                        <input type="text" name="nik" required maxlength="16" minlength="16" class="w-full px-4 py-3 border rounded-lg" placeholder="1234567890123456">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Tanggal Mulai</label>
                        <input type="date" name="start_date" required min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Durasi (bulan)</label>
                        <select name="duration" required class="w-full px-4 py-3 border rounded-lg">
                            <option value="3">3 Bulan</option>
                            <option value="6">6 Bulan</option>
                            <option value="12">12 Bulan</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium mb-2">Metode Pembayaran</label>
                        <select name="payment" required class="w-full px-4 py-3 border rounded-lg">
                            <option>Transfer Bank</option>
                            <option>Cash</option>
                            <option>E-Wallet</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="mt-8 w-full bg-purple-600 text-white py-4 rounded-lg text-xl font-bold hover:bg-purple-700">
                    KIRIM PEMESANAN
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="/admin/bookings" class="text-purple-600 hover:underline">Lihat Semua Booking →</a>
            </div>
        </div>
    </div>
</body>
</html>
