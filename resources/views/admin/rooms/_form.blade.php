<div class="mb-4">
    <label class="block mb-1 font-semibold">Nama Kamar</label>
    <input type="text" name="name" class="w-full border px-3 py-2 rounded"
        value="{{ old('name', $room['name'] ?? '') }}">
</div>

<div class="mb-4">
    <label class="block mb-1 font-semibold">Harga</label>
    <input type="number" name="price" class="w-full border px-3 py-2 rounded"
        value="{{ old('price', $room['price'] ?? '') }}">
</div>

<div class="mb-4">
    <label class="block mb-1 font-semibold">Kapasitas</label>
    <input type="number" name="capacity" class="w-full border px-3 py-2 rounded"
        value="{{ old('capacity', $room['capacity'] ?? '') }}">
</div>

<div class="mb-4">
    <label class="block mb-1 font-semibold">Status</label>
    <select name="status" class="w-full border px-3 py-2 rounded">
        <option value="available" {{ old('status', $room['status'] ?? '') == 'available' ? 'selected' : '' }}>
            Available
        </option>
        <option value="unavailable" {{ old('status', $room['status'] ?? '') == 'unavailable' ? 'selected' : '' }}>
            Unavailable
        </option>
    </select>
</div>

<div class="mb-4">
    <label class="block mb-1 font-semibold">Fasilitas (pisahkan dengan koma)</label>
    <input type="text" name="facilities" class="w-full border px-3 py-2 rounded"
        value="{{ old('facilities', isset($room['facilities']) ? (is_array($room['facilities']) ? implode(', ', $room['facilities']) : $room['facilities']) : '') }}">
</div>

<div class="mb-4">
    <label class="block mb-1 font-semibold">Lokasi</label>
    <input type="text" name="location" class="w-full border px-3 py-2 rounded"
        value="{{ old('location', $room['location'] ?? '') }}">
</div>

{{-- Upload file --}}
<div class="mb-4">
    <label class="block mb-1 font-semibold">Upload Gambar</label>
    <input type="file" name="image" id="imageInput" class="border px-3 py-2 rounded">
</div>

{{-- Preview gambar --}}
<div class="mb-4">
    <label class="block mb-1 font-semibold">Preview Gambar</label>
    <div id="previewContainer" class="w-48 h-32 border rounded flex items-center justify-center text-gray-400">
        Preview akan muncul di sini
    </div>
</div>

<script>
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('previewContainer');

    function showPreview(src) {
        previewContainer.innerHTML = '';
        const img = document.createElement('img');
        img.src = src;
        img.className = 'w-full h-full object-cover rounded';
        previewContainer.appendChild(img);
    }

    imageInput.addEventListener('change', (e) => {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(event) {
                showPreview(event.target.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Jika edit mode sudah ada gambar
    @if(isset($room['image']) && $room['image'])
        showPreview("{{ $room['image'] }}");
    @endif
</script>
