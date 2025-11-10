@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-100 via-blue-50 to-purple-100 p-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-extrabold text-indigo-700 mb-8 text-center drop-shadow-sm">
            👥 Data Penyewa Kamar
        </h1>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6 shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white/90 backdrop-blur-sm shadow-2xl rounded-2xl overflow-hidden border border-indigo-200">
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-sm uppercase tracking-wide">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Nama</th>
                            <th class="px-6 py-3 text-left font-semibold">Kamar</th>
                            <th class="px-6 py-3 text-left font-semibold">Durasi</th>
                            <th class="px-6 py-3 text-left font-semibold">Status</th>
                            <th class="px-6 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">
                        @foreach ($penyewa as $p)
                            <tr class="border-b border-indigo-100 hover:bg-indigo-50 transition-all duration-200">
                                <td class="px-6 py-4 font-medium">{{ $p['nama'] }}</td>
                                <td class="px-6 py-4">{{ $p['kamar'] }}</td>
                                <td class="px-6 py-4">{{ $p['durasi'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                        {{ $p['status'] == 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $p['status'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('admin.updateStatus', $p['id']) }}" method="POST" class="inline-flex items-center gap-3">
                                        @csrf
                                        <select name="status" class="border border-gray-300 rounded-lg text-sm p-1.5 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
                                            <option value="Aktif" {{ $p['status'] == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Berakhir" {{ $p['status'] == 'Berakhir' ? 'selected' : '' }}>Berakhir</option>
                                        </select>
                                        <button type="submit"
                                            class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white px-3 py-1.5 rounded-lg text-sm font-medium shadow hover:scale-105 hover:from-indigo-600 hover:to-blue-600 transition">
                                            Simpan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
