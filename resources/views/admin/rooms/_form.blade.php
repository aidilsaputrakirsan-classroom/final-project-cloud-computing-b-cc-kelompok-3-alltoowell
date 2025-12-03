<div class="mb-5">
    <label class="block mb-1 font-semibold text-slate-700">Nama Kamar</label>
    <input type="text" name="name"
        class="w-full border border-blue-200 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400"
        placeholder="Contoh: Kamar Deluxe A1"
        value="{{ old('name', $room['name'] ?? '') }}">
</div>

<div class="mb-5">
    <label class="block mb-1 font-semibold text-slate-700">Harga</label>
    <input type="number" name="price"
        class="w-full border border-blue-200 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400"
        placeholder="Contoh: 1500000"
        value="{{ old('price', $room['price'] ?? '') }}">
</div>

<div class="mb-5">
    <label class="block mb-1 font-semibold text-slate-700">Kapasitas</label>
    <input type="number" name="capacity"
        class="w-full border border-blue-200 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400"
        placeholder="Ex: 1"
        value="{{ old('capacity', $room['capacity'] ?? '') }}">
</div>

<div class="mb-5">
    <label class="block mb-1 font-semibold text-slate-700">Status</label>
    <select name="status"
        class="w-full border border-blue-200 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400">
        <option value="available" {{ old('status', $room['status'] ?? '')=='available'?'selected':'' }}>Tersedia</option>
        <option value="unavailable" {{ old('status', $room['status'] ?? '')=='unavailable'?'selected':'' }}>Tidak Tersedia</option>
    </select>
</div>

<div class="mb-5">
    <label class="block mb-1 font-semibold text-slate-700">Fasilitas (pisahkan dengan koma)</label>
    <input type="text" name="facilities"
        class="w-full border border-blue-200 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400"
        placeholder="AC, Kasur, Meja Belajar"
        value="{{ old('facilities', isset($room['facilities']) ? (is_array($room['facilities']) ? implode(', ', $room['facilities']) : $room['facilities']) : '') }}">
</div>

<div class="mb-5">
    <label class="block mb-1 font-semibold text-slate-700">Lokasi</label>
    <input type="text" name="location"
        class="w-full border border-blue-200 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400"
        placeholder="Contoh: Jl. Soekarno Hatta No. 15"
        value="{{ old('location', $room['location'] ?? '') }}">
</div>

<div class="mb-5">
    <label class="block mb-1 font-semibold text-slate-700">Upload Gambar</label>
    <input type="file" name="image" id="imageInput"
        class="w-full border border-blue-200 px-4 py-2 rounded-lg cursor-pointer bg-white">
</div>

<div class="mb-3">
    <label class="block mb-1 font-semibold text-slate-700">Preview Gambar</label>

    <div id="previewContainer"
        class="w-48 h-32 border border-blue-200 bg-blue-50 rounded-lg flex items-center justify-center text-gray-400 overflow-hidden">
        <span id="previewText">Preview muncul di sini</span>
    </div>
</div>

<script>
    const previewContainer = document.getElementById('previewContainer');
    const previewText = document.getElementById('previewText');
    const imageInput = document.getElementById('imageInput');

    function setPreview(src) {
        previewContainer.innerHTML = "";
        const img = document.createElement("img");
        img.src = src;
        img.className = "w-full h-full object-cover rounded";
        previewContainer.appendChild(img);
    }

    imageInput.addEventListener("change", (e) => {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = (ev) => setPreview(ev.target.result);
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Jika EDIT MODE punya gambar lama
    @if(isset($room['image']) && $room['image'])
        setPreview("{{ room_image($room['image']) }}");
    @endif
</script>
