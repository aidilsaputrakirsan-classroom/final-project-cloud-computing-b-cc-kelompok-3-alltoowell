@extends('layouts.admin')

@section('title', 'Edit Kamar')

@section('content')
<div class="max-w-3xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6 text-blue-900">Edit Kamar</h1>

    <form action="{{ route('admin.rooms.update', $room['id']) }}"
          method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @include('admin.rooms._form', ['room' => $room])

        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('admin.rooms.index') }}"
               class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
               Batal
            </a>

            <button class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>
@endsection
