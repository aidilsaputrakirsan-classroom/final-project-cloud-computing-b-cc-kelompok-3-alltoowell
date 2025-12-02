<section class="py-28 bg-[#F2F7FF] light-dots" id="tentang">
    <div class="container mx-auto px-6 max-w-7xl">

        {{-- Heading --}}
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-blue-100 px-4 py-2 rounded-full border border-blue-200 mb-4">
                <i data-lucide="info" class="w-4 h-4 text-blue-700"></i>
                <span class="text-blue-700 font-semibold">Tentang Kami</span>
            </div>

            <h2 class="text-4xl md:text-5xl font-bold text-primary">Tentang KOST-SI</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mt-3 leading-relaxed">
                Platform online untuk mempermudah mahasiswa ITK dalam menemukan kamar kos ideal
                dengan cepat, aman, dan transparan.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-14 items-center">

            {{-- TEKS --}}
            <div class="space-y-6">

                <h3 class="text-2xl font-bold text-gray-900">Platform Digital Terpercaya</h3>

                <p class="text-gray-700 leading-relaxed">
                    KOST-SI membantu mahasiswa dalam mendapatkan informasi kos secara lengkap.
                    Mulai dari harga, fasilitas, lokasi, jumlah kamar tersedia, hingga foto asli kamar
                    yang telah diverifikasi.
                </p>

                <p class="text-gray-700 leading-relaxed">
                    Semua proses mulai dari melihat daftar kamar hingga melakukan pemesanan bisa
                    selesai dalam beberapa klik.
                </p>

                <div class="flex gap-4 pt-4">
                    <div class="bg-blue-700 text-white px-6 py-4 rounded-2xl text-center shadow-md">
                        <h4 class="text-3xl font-bold">100%</h4>
                        <p class="opacity-80 text-sm">Kepuasan</p>
                    </div>

                    <div class="bg-green-600 text-white px-6 py-4 rounded-2xl text-center shadow-md">
                        <h4 class="text-3xl font-bold">50+</h4>
                        <p class="opacity-80 text-sm">Pengguna Aktif</p>
                    </div>
                </div>

            </div>

            {{-- SLIDER GAMBAR --}}
            <div class="rounded-3xl overflow-hidden shadow-xl mx-auto" style="max-width: 450px;">
                <div class="about-slider">

                    @php
                        $folder = public_path('images');
                        $files = glob($folder . '/room*.jpg');
                    @endphp

                    @if(count($files) > 0)
                        @foreach($files as $file)
                            <div>
                                <img src="{{ asset('images/' . basename($file)) }}"
                                     class="w-full h-[360px] object-cover" />
                            </div>
                        @endforeach
                    @else
                        <div class="p-10 text-center text-gray-500">
                            Tidak ada gambar ditemukan di folder <br> <strong>/public/images/</strong>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</section>
