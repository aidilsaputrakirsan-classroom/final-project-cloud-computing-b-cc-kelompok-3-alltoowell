@extends('layouts.app')

@section('title', 'Tambah Kamar')

@section('content')
<div class="container mx-auto p-6 max-w-3xl">
    <h1 class="text-3xl font-bold mb-6" style="color: #5B3FE0;">Tambah Kamar</h1>

    <form 
        action="{{ route('admin.rooms.store') }}" 
        method="POST" 
        enctype="multipart/form-data"
    >
        @csrf

        @include('admin.rooms._form')

        <div class="mt-6 flex justify-end gap-2">
            <a href="{{ route('admin.rooms.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">Batal</a>
            <button type="submit" class="bg-[#5B3FE0] text-white px-4 py-2 rounded-lg hover:bg-[#4a32c9]">Tambah Kamar</button>
        </div>
    </form>
</div>
@endsection