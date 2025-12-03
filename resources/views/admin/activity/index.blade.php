@extends('layouts.admin')

@section('title', 'Activity Log')

@section('content')
<div class="space-y-8">

    <!-- TITLE -->
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Activity Log</h1>
        <p class="text-gray-600">Riwayat aktivitas pengguna dalam sistem.</p>
    </div>

    <!-- TABLE WRAPPER -->
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">

        <!-- TABLE HEADER -->
        <div class="bg-blue-600 px-6 py-4">
            <h2 class="text-lg font-semibold text-white">Riwayat Aktivitas</h2>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-sm">
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">User ID</th>
                        <th class="px-6 py-3">Aksi</th>
                        <th class="px-6 py-3">Deskripsi</th>
                        <th class="px-6 py-3">Waktu</th>
                        <th class="px-6 py-3">Detail</th>
                    </tr>
                </thead>

                <tbody class="text-gray-800">

                    @forelse($logs as $log)
                        <tr class="border-b">

                            <td class="px-6 py-4 font-semibold">
                                {{ $log['user_name'] ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-gray-600 text-sm">
                                {{ $log['user_id'] ?? '-' }}
                            </td>

                            <td class="px-6 py-4 capitalize">
                                <span class="px-3 py-1 rounded-full text-sm
                                    @if($log['action'] === 'login') bg-green-100 text-green-700 @endif
                                    @if($log['action'] === 'logout') bg-yellow-100 text-yellow-700 @endif
                                    @if($log['action'] === 'booking') bg-blue-100 text-blue-700 @endif
                                    @if($log['action'] === 'update') bg-purple-100 text-purple-700 @endif
                                ">
                                    {{ $log['action'] }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                {{ $log['description'] }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($log['created_at'])->format('d M Y, H:i') }}
                            </td>

                            <td class="px-6 py-4">
                                <a href="{{ route('admin.activity.show', $log['id']) }}"
                                   class="text-blue-600 hover:underline font-medium">
                                    Lihat Detail
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                                Tidak ada aktivitas tercatat.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
