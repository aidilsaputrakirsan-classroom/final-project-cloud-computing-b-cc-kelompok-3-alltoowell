@extends('admin.layout')

@section('content')
<h2 class="text-xl font-bold mb-4">Daftar Pengguna</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

<table class="min-w-full border">
    <thead>
        <tr class="text-center bg-gray-100">
            <th class="px-4 py-2 border">No</th>
            <th class="px-4 py-2 border">Nama</th>
            <th class="px-4 py-2 border">Email</th>
            <th class="px-4 py-2 border">Telepon</th>
            <th class="px-4 py-2 border">Status Kamar</th>
            <th class="px-4 py-2 border">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengguna as $index => $p)
        <tr class="text-center">
            <td class="px-4 py-2 border">{{ $index + 1 }}</td>
            <td class="px-4 py-2 border">{{ $p->nama }}</td>
            <td class="px-4 py-2 border">{{ $p->email }}</td>
            <td class="px-4 py-2 border">{{ $p->telepon }}</td>
            <td class="px-4 py-2 border">
                {{ $p->status_checkin ? 'Available' : 'Unavailable' }}
            </td>
            <td class="px-4 py-2 border">
                <form action="{{ route('admin.pengguna.update', $p->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status_checkin" class="border rounded px-2 py-1">
                        <option value="0" {{ $p->status_checkin ? '' : 'selected' }}>Unavailable</option>
                        <option value="1" {{ $p->status_checkin ? 'selected' : '' }}>Available</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Simpan</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
