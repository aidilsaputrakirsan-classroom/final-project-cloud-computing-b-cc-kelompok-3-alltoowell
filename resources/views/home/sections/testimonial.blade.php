<section class="py-24 bg-white light-dots">
    <div class="container mx-auto max-w-7xl px-6">

        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-yellow-100 px-4 py-2 rounded-full border border-yellow-300 mb-4">
                <i data-lucide="message-circle" class="w-4 h-4 text-yellow-700"></i>
                <span class="text-yellow-700 font-semibold">Testimonial</span>
            </div>

            <h2 class="text-4xl font-bold text-primary">Apa Kata Mereka?</h2>
            <p class="text-gray-600 max-w-xl mx-auto mt-2">
                Pendapat nyata mahasiswa ITK tentang KOST-SI.
            </p>
        </div>

        {{-- DATA TESTIMONI --}}
        @php
            $testi = [
                [
                    'nama' => 'Dewi Kusuma',
                    'kelas' => 'Teknik Informatika 2023',
                    'text' => 'Aplikasi ini sangat membantu. Proses cepat dan tampilannya enak dilihat!'
                ],
                [
                    'nama' => 'Reza Putra',
                    'kelas' => 'Teknik Sipil 2022',
                    'text' => 'Harga transparan, proses booking cepat, semua jelas dan aman.'
                ],
                [
                    'nama' => 'Budi Santoso',
                    'kelas' => 'Teknik Elektro 2023',
                    'text' => 'Fasilitas lengkap, lokasi strategis, sangat nyaman.'
                ],
                [
                    'nama' => 'Siti Nurhaliza',
                    'kelas' => 'Arsitektur 2023',
                    'text' => 'Sistemnya rapi dan mudah digunakan. Sangat membantu!'
                ],
            ];
        @endphp

        <div class="testimonial-slider">

            @foreach($testi as $index => $t)
            <div class="px-4">

                <div class="testi-card {{ $index % 2 == 0 ? 'bg-gradient-to-br from-blue-50 to-blue-100' : 'bg-gradient-to-br from-[#E8F0FF] to-white' }}">

                    {{-- TANPA FOTO --}}
                    <div class="mb-4">
                        <h4 class="font-bold text-lg">{{ $t['nama'] }}</h4>
                        <p class="text-gray-600 text-sm">{{ $t['kelas'] }}</p>
                    </div>

                    {{-- ISI TESTIMONI --}}
                    <p class="mb-4 text-gray-800 leading-relaxed">“{{ $t['text'] }}”</p>

                    {{-- STAR --}}
                    <div>
                        @for($i=0; $i<5; $i++)
                            <i data-lucide="star" class="w-4 h-4 text-yellow-400 inline"></i>
                        @endfor
                    </div>

                </div>

            </div>
            @endforeach

        </div>

    </div>
</section>
