@extends('layouts.admin')

@section('title','Hapus Kamar')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-2xl shadow-xl mt-10 border">

    <h1 class="text-2xl font-bold text-blue-900 mb-4 text-center">Konfirmasi Hapus Kamar</h1>

    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200 mb-6">
        <p class="mb-2"><strong>Nama:</strong> {{ $room['name'] }}</p>
        <p class="mb-2"><strong>Harga:</strong> Rp {{ number_format($room['price'],0,',','.') }}</p>
        <p class="mb-2"><strong>Kapasitas:</strong> {{ $room['capacity'] }} orang</p>
        <p class="mb-2"><strong>Status:</strong> {{ ucfirst($room['status']) }}</p>
        <p class="mb-2"><strong>Lokasi:</strong> {{ $room['location'] }}</p>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.rooms.index') }}"
           class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
           Batal
        </a>

        <form action="{{ route('admin.rooms.destroy', $room['id']) }}"
              method="POST" onsubmit="return confirm('Yakin hapus?')">

            @csrf
            @method('DELETE')

            <button type="submit"
                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                Ya, Hapus
            </button>
        </form>
    </div>

</div>
@endsection
