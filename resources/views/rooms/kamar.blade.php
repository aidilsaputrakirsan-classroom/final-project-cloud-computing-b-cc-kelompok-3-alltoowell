@extends('layouts.admin')

@section('content')
<h1>Data Kamar</h1>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kamar</th>
            <th>Harga</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kamar as $k)
            <tr>
                <td>{{ $k['id'] }}</td>
                <td>{{ $k['nama'] ?? '-' }}</td>
                <td>Rp {{ number_format($k['harga'] ?? 0) }}</td>
                <td>
                    <span class="badge bg-{{ $k['status'] == 'tersedia' ? 'success' : 'danger' }}">
                        {{ ucfirst($k['status']) }}
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
