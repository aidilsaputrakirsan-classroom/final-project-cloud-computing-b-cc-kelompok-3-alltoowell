<div class="py-20 bg-white relative overflow-hidden">
    <div class="absolute inset-0 gradient-mesh"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-gradient-to-r from-yellow-100 to-orange-100 px-6 py-2 rounded-full mb-4 border-2 border-yellow-200">
                <i data-lucide="message-circle" class="w-4 h-4 text-yellow-700"></i>
                <span class="text-yellow-700 font-bold text-sm">Testimonial</span>
            </div>

            <h2 class="text-4xl md:text-5xl font-bold mb-4">Apa Kata Mereka?</h2>

            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Pengalaman nyata dari mahasiswa ITK yang sudah booking di KOST-SI.
            </p>
        </div>

        <div class="testimonial-carousel max-w-6xl mx-auto pb-16">

            {{-- Testimonial 1 --}}
            <div class="px-4">
                <div class="feature-card bg-white p-8 rounded-3xl shadow-2xl border-2 border-blue-100">
                    <x-stars />
                    <p class="text-gray-700 mb-6 leading-relaxed text-lg italic">
                        "KOST-SI sangat membantu saya menemukan kamar kos nyaman & dekat kampus."
                    </p>

                    <x-testimonial-avatar label="AR" name="Ahmad Rizki" major="Teknik Informatika 2023" />
                </div>
            </div>

            {{-- Testimonial 2 --}}
            <div class="px-4">
                <div class="feature-card bg-white p-8 rounded-3xl shadow-2xl border-2 border-pink-100">
                    <x-stars />
                    <p class="text-gray-700 mb-6 leading-relaxed text-lg italic">
                        "Booking gampang, harga transparan, ga ada biaya tambahan!"
                    </p>

                    <x-testimonial-avatar label="SN" name="Siti Nurhaliza" major="Teknik Sipil 2022" />
                </div>
            </div>

            {{-- Testimonial 3 --}}
            <div class="px-4">
                <div class="feature-card bg-white p-8 rounded-3xl shadow-2xl border-2 border-green-100">
                    <x-stars />
                    <p class="text-gray-700 mb-6 leading-relaxed text-lg italic">
                        "Fasilitas lengkap, harga sesuai budget, sangat membantu mahasiswa baru."
                    </p>

                    <x-testimonial-avatar label="BS" name="Budi Santoso" major="Teknik Elektro 2023" />
                </div>
            </div>

        </div>
    </div>
</div>
