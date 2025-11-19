@extends('layouts.admin')

@section('content')

<h1>Data Pengguna Menginap</h1>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
    }
    th, td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
    }
    th {
        background: #1f2937;
        color: white;
    }
</style>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kamar</th>
            <th>Masuk</th>
            <th>Keluar</th>
        </tr>
    </thead>

    <tbody>
        @forelse($pengguna as $p)
        <tr>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->kamar }}</td>
            <td>{{ $p->masuk }}</td>
            <td>{{ $p->keluar }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" style="text-align:center;">Belum ada pengguna menginap.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
