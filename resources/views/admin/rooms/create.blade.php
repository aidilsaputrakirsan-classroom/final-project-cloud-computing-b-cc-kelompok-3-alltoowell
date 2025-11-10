@extends('layouts.app')
@section('title', 'Tambah Kamar Baru')

@section('content')
<div class="min-h-screen bg-[#5B3FE0] flex items-center justify-center p-6">
    <div class="w-full max-w-4xl">
        <!-- Card Utama -->
        <div class="bg-white rounded-3xl shadow-2xl p-10 md:p-16">
            <h1 class="text-4xl font-bold text-center text-[#5B3FE0] mb-12">
                Tambah Kamar Baru
            </h1>

            <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Kiri -->
                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kamar</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-[#4F46E5]/30 focus:border-[#4F46E5] transition"
                                   placeholder="Deluxe Room A1">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Harga</label>
                            <input type="number" name="price" value="{{ old('price') }}" required
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-[#4F46E5]/30 focus:border-[#4F46E5]"
                                   placeholder="1500000">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kapasitas</label>
                            <input type="number" name="capacity" value="{{ old('capacity', 1) }}" min="1" required
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-[#4F46E5]/30 focus:border-[#4F46E5]"
                                   placeholder="1">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                            <input type="text" name="location" value="{{ old('location') }}"
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-[#4F46E5]/30 focus:border-[#4F46E5]"
                                   placeholder="Jl. Soekarno Hatta No. 123">
                        </div>
                    </div>

                    <!-- Kanan -->
                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Wi-Fi, AC, pisahkan dengan koma)</label>
                            <input type="text" id="facilities_input" value="{{ old('facilities_input') }}"
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-[#4F46E5]/30 focus:border-[#4F46E5]"
                                   placeholder="Wi-Fi, AC, Kamar mandi dalam">
                            <input type="hidden" name="facilities" id="facilities_hidden">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                            <select name="status" required
                                    class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-[#4F46E5]/30 focus:border-[#4F46E5]">
                                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                                <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Tidak Tersedia</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kontak Pemilik</label>
                            <input type="text" name="owner_contact" value="{{ old('owner_contact') }}"
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-[#4F46E5]/30 focus:border-[#4F46E5]"
                                   placeholder="081234567890">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Kamar</label>
                            <input type="file" name="image" accept="image/*"
                                   class="block w-full text-sm text-gray-600 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:bg-[#4F46E5] file:text-white hover:file:bg-[#4338CA]">
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mt-10">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4"
                              class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-[#4F46E5]/30 focus:border-[#4F46E5]"
                              placeholder="Kamar nyaman, dekat kampus, fasilitas lengkap...">{{ old('description') }}</textarea>
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end mt-12">
                    <button type="submit"
                            class="bg-[#4F46E5] hover:bg-[#4338CA] text-white px-10 py-4 rounded-full font-bold text-lg shadow-xl hover:shadow-2xl hover:scale-105 transition transform">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

<script>
document.querySelector('form').addEventListener('submit', function () {
    const input = document.getElementById('facilities_input').value;
    const facilities = input.split(',').map(f => f.trim()).filter(f => f);
    document.getElementById('facilities_hidden').value = JSON.stringify(facilities);
});
</script>
@endsection