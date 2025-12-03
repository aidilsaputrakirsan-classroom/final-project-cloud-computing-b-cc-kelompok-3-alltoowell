@extends('layouts.admin')

@section('title', 'Detail Activity Log')

@section('content')
<div class="bg-white rounded-xl shadow p-8">

    <a href="{{ route('admin.activity.index') }}"
       class="inline-flex items-center gap-2 text-blue-600 hover:underline mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali
    </a>

    <h2 class="text-2xl font-bold mb-4">Detail Aktivitas</h2>

    <div class="grid md:grid-cols-2 gap-6">

        <div class="bg-blue-50 p-5 rounded-xl">
            <h3 class="text-sm text-gray-600">User</h3>
            <p class="font-semibold text-lg">
                {{ $log['user_name'] ?? '-' }}
            </p>
            <p class="text-gray-500 text-sm">
                {{ $log['user_email'] ?? '-' }}
            </p>
        </div>

        <div class="bg-gray-50 p-5 rounded-xl">
            <h3 class="text-sm text-gray-600">Aksi</h3>
            <p class="font-semibold text-lg">{{ $log['action'] ?? '-' }}</p>

            <h3 class="text-sm text-gray-600 mt-4">Waktu</h3>
            <p class="text-gray-700">
                {{ \Carbon\Carbon::parse($log['created_at'])->format('d M Y, H:i') }}
            </p>
        </div>

    </div>

    <div class="mt-6">
        <h3 class="text-sm text-gray-600">Deskripsi</h3>
        <p class="text-gray-800 p-4 bg-white rounded-xl border">
            {{ $log['description'] ?? '-' }}
        </p>
    </div>

</div>

@push('scripts')
<script> lucide.createIcons(); </script>
@endpush

@endsection
