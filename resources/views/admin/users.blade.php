@extends('layouts.admin')

@section('title', 'Data Pengguna')

@section('content')
<h1 class="fw-bold mb-4"><i class="bi bi-people-fill me-2"></i>Data Pengguna yang Cek In</h1>

<p class="text-secondary mb-4">Berikut daftar penghuni yang sedang menempati kamar di SI-KOST.</p>

@php
    // Contoh data dummy — nanti bisa diganti dari database
    $users = [
        [
            'nama' => 'Andi Pratama',
            'email' => 'andi@example.com',
            'kamar' => 'Kamar Deluxe 1',
            'tanggal_masuk' => '2025-11-01',
            'status' => 'Cek In'
        ],
        [
            'nama' => 'Siti Nurhaliza',
            'email' => 'siti@example.com',
            'kamar' => 'Kamar Standard 2',
            'tanggal_masuk' => '2025-10-27',
            'status' => 'Cek In'
        ],
        [
            'nama' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'kamar' => 'Kamar Hemat 4',
            'tanggal_masuk' => '2025-10-20',
            'status' => 'Cek Out'
        ],
    ];
@endphp

<div class="card shadow-sm rounded-4 border-0">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>Kamar</th>
                    <th>Tanggal Masuk</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $i => $u)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $u['nama'] }}</td>
                        <td>{{ $u['email'] }}</td>
                        <td>{{ $u['kamar'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($u['tanggal_masuk'])->format('d M Y') }}</td>
                        <td>
                            @if ($u['status'] === 'Cek In')
                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Cek In</span>
                            @else
                                <span class="badge bg-secondary"><i class="bi bi-box-arrow-right me-1"></i> Cek Out</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
