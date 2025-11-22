@extends('layouts.app')

@section('navbar')
    @include('components.navbar')
@endsection

@section('content')

{{-- HERO SECTION --}}
<section id="hero">
    @include('components.home.hero')
</section>

{{-- QUICK STATS --}}
<section id="stats">
    @include('components.home.stats')
</section>

{{-- FEATURES --}}
<section id="features">
    @include('components.home.features')
</section>

{{-- CTA --}}
<section id="cta">
    @include('components.home.cta')
</section>

{{-- TESTIMONIAL --}}
<section id="testimonial">
    @include('components.home.testimonial')
</section>

{{-- ABOUT --}}
<section id="about-section">
    @include('components.home.about')
</section>

{{-- CONTACT --}}
<section id="contact">
    @include('components.home.contact')
</section>

{{-- FINAL CTA --}}
<section id="final-cta">
    @include('components.home.final-cta')
</section>

@endsection
