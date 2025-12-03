@extends('admin.layout')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Data Kamar</h2>

    <div class="overflow-x-auto rounded-lg shadow">
        <table class="w-full border border-gray-300 text-gray-700">
            <thead>
                <tr class="bg-gray-100 text-center font-semibold">
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Gambar</th>
                    <th class="px-4 py-2 border">Nama Kamar</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Harga</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kamar as $k)
                    <tr class="text-center hover:bg-gray-50 transition">
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">
                            @if(!empty($k['gambar']))
                                <img src="{{ $k['gambar'] }}" alt="Gambar Kamar" class="w-20 h-16 object-cover mx-auto rounded">
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-2 border">{{ $k['nama'] ?? '-' }}</td>
                        <td class="px-4 py-2 border">
                            @if(!empty($k['status']) && $k['status'] === 'tersedia')
                                <span class="text-green-600 font-semibold">Tersedia</span>
                            @else
                                <span class="text-red-600 font-semibold">Tidak Tersedia</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border">Rp {{ number_format($k['harga'] ?? 0, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">
                            Tidak ada data kamar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
