@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<style>
    /* dotted soft background */
    .light-dots {
        background-image: radial-gradient(rgba(0,0,0,0.06) 1px, transparent 1px);
        background-size: 22px 22px;
    }

    /* testimonial gradient soft */
    .testi-card {
        border-radius: 28px;
        padding: 32px;
        background: linear-gradient(145deg, rgba(255,255,255,0.85), rgba(240,245,255,0.95));
        backdrop-filter: blur(12px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        transition: .25s;
    }
    .testi-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 45px rgba(0,0,0,0.12);
    }

    /* slick arrow */
    .slick-prev, .slick-next {
        width: 42px;
        height: 42px;
        background: white;
        border-radius: 50%;
        display: flex !important;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        z-index: 20;
        transition: .25s;
    }
    .slick-prev:hover, .slick-next:hover {
        background: #e9f0ff;
    }
    .slick-prev { left: -50px; }
    .slick-next { right: -50px; }

    .slick-dots li button:before {
        color: #0A3A82 !important;
        opacity: .7;
        font-size: 10px;
    }
</style>



{{-- ===================================================== --}}
{{-- HERO SECTION (Versi awal yang kamu suka) --}}
{{-- ===================================================== --}}
<section class="relative h-[600px] overflow-hidden light-dots flex items-center">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1920&h=900&fit=crop"
             class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 via-blue-800/80 to-blue-900/95"></div>
    </div>

    <div class="relative container mx-auto px-6">
        <div class="max-w-3xl text-white">

            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-5 py-2 rounded-full mb-6 border border-white/20">
                <i data-lucide="sparkles" class="w-5 h-5"></i>
                <span class="text-sm font-semibold">Platform Terpercaya Mahasiswa ITK</span>
            </div>

            <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                Temukan Kamar Kos <br>
                <span class="text-yellow-300">Impianmu</span> di ITK
            </h1>

            <p class="text-lg text-gray-200 max-w-xl mb-8">
                Platform reservasi kamar kos modern untuk mahasiswa ITK.
                Cepat, nyaman, aman, dan terpercaya.
            </p>

            {{-- Tombol Cek Login --}}
            @if(!session('is_logged_in'))
                <a href="{{ url('/login') }}"
                   class="px-8 py-4 bg-white text-blue-700 font-semibold rounded-xl shadow-lg hover:bg-blue-50 inline-flex items-center gap-2">
                    Lihat Daftar Kamar
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            @else
                <a href="{{ route('rooms.index') }}"
                   class="px-8 py-4 bg-white text-blue-700 font-semibold rounded-xl shadow-lg hover:bg-blue-50 inline-flex items-center gap-2">
                    Lihat Daftar Kamar
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            @endif

        </div>
    </div>
</section>





{{-- ===================================================== --}}
{{-- STATISTICS --}}
{{-- ===================================================== --}}
<section class="mt-[-80px] relative z-10 px-6">
    <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">

        <div class="glass rounded-xl p-6 text-center shadow-md border border-blue-100">
            <i data-lucide="building-2" class="mx-auto mb-3 w-8 h-8 text-blue-600"></i>
            <h3 class="text-3xl font-bold text-blue-700">6+</h3>
            <p class="text-gray-700">Kamar Kos</p>
        </div>

        <div class="glass rounded-xl p-6 text-center shadow-md border border-green-100">
            <i data-lucide="users" class="mx-auto mb-3 w-8 h-8 text-green-600"></i>
            <h3 class="text-3xl font-bold text-green-700">50+</h3>
            <p class="text-gray-700">Mahasiswa</p>
        </div>

        <div class="glass rounded-xl p-6 text-center shadow-md border border-yellow-100">
            <i data-lucide="star" class="mx-auto mb-3 w-8 h-8 text-yellow-500"></i>
            <h3 class="text-3xl font-bold text-yellow-500">4.8</h3>
            <p class="text-gray-700">Rating</p>
        </div>

        <div class="glass rounded-xl p-6 text-center shadow-md border border-purple-100">
            <i data-lucide="clock" class="mx-auto mb-3 w-8 h-8 text-purple-600"></i>
            <h3 class="text-3xl font-bold text-purple-600">24/7</h3>
            <p class="text-gray-700">Support</p>
        </div>

    </div>
</section>





{{-- ===================================================== --}}
{{-- EXPERIENCE --}}
{{-- ===================================================== --}}
<section class="py-24 bg-white light-dots">
    <div class="container mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 bg-blue-100 px-4 py-2 rounded-full mb-4 border border-blue-200">
            <i data-lucide="zap" class="w-4 h-4 text-blue-700"></i>
            <span class="text-blue-700 font-semibold">Kenapa KOST-SI?</span>
        </div>

        <h2 class="text-4xl font-bold mb-4">
            Pengalaman Booking <span class="text-blue-600">Yang Berbeda</span>
        </h2>

        <p class="text-gray-700 mb-16 max-w-2xl mx-auto">
            Kemudahan dan kenyamanan dalam setiap langkah proses booking kamar kos.
        </p>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

            <div class="bg-white border-2 border-blue-100 rounded-3xl p-8 shadow-md feature-card">
                <i data-lucide="mouse-pointer-click" class="w-10 h-10 text-blue-700 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Proses Mudah</h3>
                <p class="text-gray-600">Booking cepat, interface mudah, user-friendly.</p>
            </div>

            <div class="bg-white border-2 border-green-100 rounded-3xl p-8 shadow-md feature-card">
                <i data-lucide="shield-check" class="w-10 h-10 text-green-700 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Aman</h3>
                <p class="text-gray-600">Data terjaga. Sistem keamanan khusus ITK.</p>
            </div>

            <div class="bg-white border-2 border-purple-100 rounded-3xl p-8 shadow-md feature-card">
                <i data-lucide="wallet" class="w-10 h-10 text-purple-700 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Harga Transparan</h3>
                <p class="text-gray-600">Semua biaya jelas sebelum checkout.</p>
            </div>

        </div>
    </div>
</section>





{{-- ===================================================== --}}
{{-- TESTIMONIAL PREMIUM --}}
{{-- ===================================================== --}}
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

        <div class="testimonial-slider">

            @php
                $testi = [
                    [
                        'nama' => 'Dewi Kusuma',
                        'kelas' => 'Teknik Informatika 2023',
                        'foto' => asset('images/avatar1.jpg'),
                        'text' => 'Aplikasi ini sangat membantu. Proses cepat dan tampilannya enak dilihat!',
                    ],
                    [
                        'nama' => 'Reza Putra',
                        'kelas' => 'Teknik Sipil 2022',
                        'foto' => asset('images/avatar2.jpg'),
                        'text' => 'Harga transparan, proses booking mudah, semua jelas dan aman.',
                    ],
                    [
                        'nama' => 'Budi Santoso',
                        'kelas' => 'Teknik Elektro 2023',
                        'foto' => asset('images/avatar3.jpg'),
                        'text' => 'Fasilitas lengkap, lokasi strategis, sangat nyaman.',
                    ],
                    [
                        'nama' => 'Siti Nurhaliza',
                        'kelas' => 'Arsitektur 2023',
                        'foto' => asset('images/avatar4.jpg'),
                        'text' => 'Tampilan modern dan user-friendly. Sangat membantu mahasiswa!',
                    ],
                ];
            @endphp

            @foreach ($testi as $t)
            <div class="px-4">
                <div class="testi-card">

                    <div class="flex items-center gap-4 mb-4">
                        <img src="{{ $t['foto'] }}"
                             class="w-14 h-14 rounded-full object-cover shadow-md">
                        <div>
                            <h4 class="font-bold text-lg">{{ $t['nama'] }}</h4>
                            <p class="text-gray-600 text-sm">{{ $t['kelas'] }}</p>
                        </div>
                    </div>

                    <p class="mb-4 text-gray-800 leading-relaxed">“{{ $t['text'] }}”</p>

                    <div>
                        @for ($i = 0; $i < 5; $i++)
                            <i data-lucide="star" class="w-4 h-4 text-yellow-400 inline"></i>
                        @endfor
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>





{{-- ===================================================== --}}
{{-- ABOUT SECTION --}}
{{-- ===================================================== --}}
<section class="py-28 bg-[#F2F7FF] light-dots" id="tentang">
    <div class="container mx-auto px-6 max-w-7xl">

        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-blue-100 px-4 py-2 rounded-full border border-blue-200 mb-4">
                <i data-lucide="info" class="w-4 h-4 text-blue-700"></i>
                <span class="text-blue-700 font-semibold">Tentang Kami</span>
            </div>

            <h2 class="text-4xl md:text-5xl font-bold text-primary">Tentang KOST-SI</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mt-3">
                Platform yang dirancang untuk mempermudah mahasiswa ITK dalam menemukan kamar kos ideal
                dengan cepat, aman, dan transparan.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-14 items-center">

            <div class="space-y-6">

                <h3 class="text-2xl font-bold text-gray-900">Platform Digital Terpercaya</h3>

                <p class="text-gray-700 leading-relaxed">
                    KOST-SI hadir sebagai solusi bagi mahasiswa yang kesulitan mencari kos yang tepat.
                    Dengan informasi lengkap dan sistem yang mudah dipahami, mahasiswa dapat mengecek lokasi,
                    harga, fasilitas, dan ketersediaan kamar secara langsung tanpa harus datang ke tempat.
                </p>

                <p class="text-gray-700 leading-relaxed">
                    Sistem ini juga dirancang dengan tampilan modern sehingga nyaman digunakan. Semua proses
                    mulai dari melihat daftar kamar hingga melakukan pemesanan bisa selesai hanya dalam beberapa klik.
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

            <div class="rounded-3xl overflow-hidden shadow-xl mx-auto"
                 style="max-width: 460px; height: 360px;">
                <img src="{{ asset('images/room3.jpg') }}"
                     class="w-full h-full object-cover" />
            </div>

        </div>
    </div>
</section>





{{-- ===================================================== --}}
{{-- CONTACT --}}
{{-- ===================================================== --}}
<section class="py-24 bg-white light-dots" id="kontak">
    <div class="container mx-auto max-w-6xl px-6 text-center">

        <h2 class="text-4xl font-bold mb-2">Ada Pertanyaan?</h2>
        <p class="text-gray-600 mb-12 max-w-2xl mx-auto">
            Tim kami siap membantu 24/7. Hubungi kami jika ada pertanyaan.
        </p>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="card-soft p-8 rounded-3xl bg-white">
                <i data-lucide="phone" class="w-10 h-10 mx-auto text-blue-700 mb-4"></i>
                <p class="font-bold text-lg">Telepon</p>
                <p class="text-blue-700 font-semibold">+62 812-3456-7890</p>
            </div>

            <div class="card-soft p-8 rounded-3xl bg-white">
                <i data-lucide="mail" class="w-10 h-10 mx-auto text-green-700 mb-4"></i>
                <p class="font-bold text-lg">Email</p>
                <p class="text-green-700 font-semibold">info@kost-si.com</p>
            </div>

            <div class="card-soft p-8 rounded-3xl bg-white">
                <i data-lucide="map-pin" class="w-10 h-10 mx-auto text-purple-700 mb-4"></i>
                <p class="font-bold text-lg">Lokasi</p>
                <p class="text-purple-700 font-semibold">Kampus ITK, Balikpapan</p>
            </div>

        </div>

    </div>
</section>

@endsection



{{-- ===================================================== --}}
{{-- SCRIPTS --}}
{{-- ===================================================== --}}
@push('scripts')
<script>
$(document).ready(function () {

    /* testimonial slider */
    $('.testimonial-slider').slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 400,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3500,
        prevArrow:
            '<button type="button" class="slick-prev"><i data-lucide="chevron-left"></i></button>',
        nextArrow:
            '<button type="button" class="slick-next"><i data-lucide="chevron-right"></i></button>',
        responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 2 }},
            { breakpoint: 640, settings: { slidesToShow: 1, arrows: false }}
        ]
    });

    /* icons render */
    setTimeout(() => { lucide.createIcons(); }, 250);

});
</script>
@endpush
