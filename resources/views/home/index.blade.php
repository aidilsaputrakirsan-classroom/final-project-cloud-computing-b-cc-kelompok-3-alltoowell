@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- ========================= --}}
{{-- HERO SECTION --}}
{{-- ========================= --}}
<div class="relative h-[600px] overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1920&h=700&fit=crop"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 via-blue-800/80 to-blue-900/90"></div>
        <div class="absolute inset-0 pattern-dots"></div>
    </div>

    <div class="relative container mx-auto px-6 h-full flex items-center">
        <div class="max-w-3xl text-white animate-fade-in">
            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-6 py-3 rounded-full mb-6 border border-white/30">
                <i data-lucide="sparkles" class="w-5 h-5"></i>
                <span class="text-sm font-semibold">Platform Terpercaya untuk Mahasiswa ITK</span>
            </div>

            <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                Temukan Kamar Kos <br>
                <span class="text-yellow-300">Impianmu</span> di ITK
            </h1>

            <p class="text-xl text-blue-100 mb-8">
                Platform reservasi modern untuk mahasiswa Institut Teknologi Kalimantan. Mudah, cepat, aman, dan terpercaya.
            </p>

            <a href="{{ route('rooms.index') }}"
                class="px-10 py-5 bg-white text-blue-600 font-bold rounded-2xl hover:bg-blue-50 shadow-xl transform hover:scale-105 inline-flex items-center gap-3">
                <span>Lihat Daftar Kamar</span>
                <i data-lucide="arrow-right" class="w-6 h-6"></i>
            </a>
        </div>
    </div>
</div>

{{-- ========================= --}}
{{-- STAT CARDS --}}
{{-- ========================= --}}
<div class="relative -mt-20 z-10">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 max-w-5xl mx-auto">

            {{-- Kamar --}}
            <div class="glass rounded-2xl p-6 text-center shadow-xl border-2 border-blue-100 feature-card">
                <div class="w-16 h-16 gradient-blue rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="building-2" class="w-8 h-8 text-white"></i>
                </div>
                <h3 class="text-4xl font-bold text-blue-600">6+</h3>
                <p class="text-gray-600 text-sm font-semibold">Kamar Kos</p>
            </div>

            {{-- Mahasiswa --}}
            <div class="glass rounded-2xl p-6 text-center shadow-xl border-2 border-green-100 feature-card">
                <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="users" class="w-8 h-8 text-white"></i>
                </div>
                <h3 class="text-4xl font-bold text-green-600">50+</h3>
                <p class="text-gray-600 text-sm font-semibold">Mahasiswa</p>
            </div>

            {{-- Rating --}}
            <div class="glass rounded-2xl p-6 text-center shadow-xl border-2 border-yellow-100 feature-card">
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="star" class="w-8 h-8 text-white"></i>
                </div>
                <h3 class="text-4xl font-bold text-yellow-500">4.8</h3>
                <p class="text-gray-600 text-sm font-semibold">Rating</p>
            </div>

            {{-- Support --}}
            <div class="glass rounded-2xl p-6 text-center shadow-xl border-2 border-purple-100 feature-card">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="clock" class="w-8 h-8 text-white"></i>
                </div>
                <h3 class="text-4xl font-bold text-purple-600">24/7</h3>
                <p class="text-gray-600 text-sm font-semibold">Support</p>
            </div>

        </div>
    </div>
</div>

{{-- ========================= --}}
{{-- PENGALAMAN BOOKING --}}
{{-- ========================= --}}
@include('home.sections.experience')

{{-- ========================= --}}
{{-- TESTIMONIAL --}}
{{-- ========================= --}}
@include('home.sections.testimonial')

{{-- ========================= --}}
{{-- TENTANG --}}
{{-- ========================= --}}
@include('home.sections.about')

{{-- ========================= --}}
{{-- KONTAK --}}
{{-- ========================= --}}
@include('home.sections.contact')

{{-- ========================= --}}
{{-- FINAL CTA --}}
{{-- ========================= --}}
@include('home.sections.cta')

@endsection


@push('scripts')
<script>
$(document).ready(function(){
    $('.testimonial-carousel').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        autoplay: true,
        autoplaySpeed: 4000,
        arrows: true,
        responsive: [
            { breakpoint: 1024, settings: { slidesToShow: 2 }},
            { breakpoint: 640,  settings: { slidesToShow: 1, arrows: false }}
        ]
    });

    lucide.createIcons();
});
</script>
@endpush
