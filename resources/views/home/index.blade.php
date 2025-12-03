@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- STYLE --}}
@include('home.sections.style')

{{-- SECTION TERURUT --}}
@include('home.sections.hero')
@include('home.sections.statistics')
@include('home.sections.experience')
@include('home.sections.testimonial')   {{-- hanya 1x! --}}
@include('home.sections.about')
@include('home.sections.contact')

@endsection

@push('scripts')
@include('home.sections.scripts')
@endpush
