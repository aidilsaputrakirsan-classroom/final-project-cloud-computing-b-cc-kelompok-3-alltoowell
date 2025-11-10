<div class="container mx-auto px-4 -mt-8 relative z-10">
    <div class="bg-white rounded-xl shadow-2xl border-0 p-6 animate-fade-in">
        <form action="/" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <div class="relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama kamar atau lokasi..."
                        class="w-full pl-10 h-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                    />
                </div>
            </div>

            <div>
                <select name="price" class="w-full h-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary px-3">
                    <option value="all" {{ request('price') == 'all' ? 'selected' : '' }}>Semua Harga</option>
                    <option value="low" {{ request('price') == 'low' ? 'selected' : '' }}>&lt; Rp 1.000.000</option>
                    <option value="medium" {{ request('price') == 'medium' ? 'selected' : '' }}>Rp 1.000.000 - 1.500.000</option>
                    <option value="high" {{ request('price') == 'high' ? 'selected' : '' }}>&gt; Rp 1.500.000</option>
                </select>
            </div>

            <div>
                <select name="status" class="w-full h-12 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary px-3">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="occupied" {{ request('status') == 'occupied' ? 'selected' : '' }}>Terisi</option>
                </select>
            </div>
        </form>

        <div class="flex items-center justify-between mt-4 pt-4 border-t">
          <p class="text-sm text-gray-600">
                Menampilkan <span class="text-primary font-medium">{{ count($rooms) }}</span> dari {{ $totalRooms }} kamar
            </p>
        </div>
    </div>
</div>
