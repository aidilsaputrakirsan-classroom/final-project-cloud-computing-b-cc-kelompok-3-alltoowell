@extends('layouts.app')
@section('title', ' - Beranda')

@section('content')
    @include('components.hero')

    @include('components.search-filter')

    <div class="container mx-auto px-4 py-12">
        <div id="rooms-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($rooms as $room)
                @include('components.room-card', ['room' => $room])
            @endforeach
        </div>
    </div>

    <!-- CTA -->
    <div class="bg-gradient-to-r from-primary to-purple-700 text-white py-16 mt-12">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Butuh Bantuan?</h2>
            <p class="text-white/90 mb-6 max-w-2xl mx-auto">
                Tim kami siap membantu Anda menemukan kamar kos yang sempurna sesuai kebutuhan dan budget Anda.
            </p>
            <button class="px-6 py-3 bg-white text-primary font-medium rounded-lg hover:bg-gray-100 transition-colors">
                Hubungi Kami
            </button>
        </div>
    </div>
@endsection
