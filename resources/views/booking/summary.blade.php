@props(['room'])

<div class="bg-white rounded-xl shadow-lg p-6 sticky top-4">
    <div class="bg-gradient-to-br from-primary/5 to-primary/10 p-4 rounded-lg border border-primary/20 mb-4">
        <h3 class="text-xl font-bold">Ringkasan Pemesanan</h3>
    </div>
    <div class="space-y-4">
        <div><p class="text-sm text-gray-500">Kamar</p><p class="font-medium">{{ $room['name'] }}</p></div>
        <div><p class="text-sm text-gray-500">Lokasi</p><p class="font-medium text-sm">{{ $room['location'] }}</p></div>
        <div><p class="text-sm text-gray-500">Harga / Bulan</p><p class="text-primary font-medium">Rp {{ number_format($room['price']) }}</p></div>
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-300 rounded-lg p-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600">Total</p>
                    <h2 class="text-2xl font-bold text-green-600" id="total">Rp {{ number_format($room['price'] * 6) }}</h2>
                </div>
                <div class="bg-white px-3 py-1.5 rounded-full text-sm font-medium" id="duration">6 bulan</div>
            </div>
        </div>
    </div>
    <div class="mt-6 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4 text-sm text-blue-800">
        Setelah mengirim, tunggu konfirmasi admin via WhatsApp dalam 1x24 jam.
    </div>
</div>
