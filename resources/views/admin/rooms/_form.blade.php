<div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 max-w-5xl mx-auto">
    <form {{ $action ?? '' }} enctype="multipart/form-data">
        @csrf
        @if(isset($room)) @method('PUT') @endif

        <h2 class="text-2xl font-semibold mb-6 text-gray-800">
            {{ isset($room) ? 'Edit Data Kamar' : 'Tambah Kamar Baru' }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kamar</label>
                <input type="text" name="name" value="{{ old('name', $room->name ?? '') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:outline-none">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Harga (per bulan)</label>
                <input type="number" name="price" value="{{ old('price', $room->price ?? '') }}" required min="100000"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:outline-none">
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $room->location ?? '') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kapasitas</label>
                <select name="capacity" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:outline-none">
                    @for($i = 1; $i <= 4; $i++)
                        <option value="{{ $i }}" {{ old('capacity', $room->capacity ?? '') == $i ? 'selected' : '' }}>
                            {{ $i }} Orang
                        </option>
                    @endfor
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:outline-none">
                    <option value="available" {{ old('status', $room->status ?? '') == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="occupied" {{ old('status', $room->status ?? '') == 'occupied' ? 'selected' : '' }}>Terisi</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Kamar</label>
                <input type="file" name="image" {{ !isset($room) ? 'required' : '' }}
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:outline-none">
                @if(isset($room) && $room->image)
                    <img src="{{ $room->image }}" class="w-24 h-24 object-cover mt-2 rounded-lg border">
                @endif
            </div>
        </div>

        <div class="mt-8">
            <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas (Pilih beberapa)</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                @foreach(['AC', 'WiFi', 'Kamar Mandi Dalam', 'Lemari', 'Meja', 'Kasur', 'TV', 'Kulkas'] as $fasilitas)
                    <label class="flex items-center gap-2 text-gray-700 hover:text-[#5B3FE0] transition">
                        <input type="checkbox" name="facilities[]" value="{{ $fasilitas }}"
                            class="accent-[#5B3FE0]"
                            {{ (old('facilities', $room->facilities ?? []) && in_array($fasilitas, old('facilities', $room->facilities ?? []))) ? 'checked' : '' }}>
                        <span class="text-sm">{{ $fasilitas }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="mt-8">
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" rows="4" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-[#5B3FE0] focus:outline-none">{{ old('description', $room->description ?? '') }}</textarea>
        </div>

        <div class="mt-8 flex gap-3">
            <button type="submit"
                class="bg-[#5B3FE0] hover:bg-[#4A32C8] text-white px-6 py-2 rounded-lg shadow-md transition font-medium">
                {{ isset($room) ? 'Update' : 'Simpan' }}
            </button>
            <a href="{{ route('admin.rooms.index') }}"
                class="border border-gray-300 text-gray-600 px-6 py-2 rounded-lg hover:bg-gray-100 transition">
                Batal
            </a>
        </div>
    </form>
</div>
