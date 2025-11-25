@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Activity Log Booking</h1>

    <div class="bg-white shadow rounded p-4 overflow-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border-b p-3">User ID</th>
                    <th class="border-b p-3">Booking ID</th>
                    <th class="border-b p-3">Room ID</th>
                    <th class="border-b p-3">Duration</th>
                    <th class="border-b p-3">Payment</th>
                    <th class="border-b p-3">Timestamp</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($logs as $log)
                <tr>
                    <td class="border-b p-3">
                        {{ $log['user_id'] ?? '-' }}
                    </td>

                    <td class="border-b p-3">
                        {{ $log['metadata']['booking_id'] ?? '-' }}
                    </td>

                    <td class="border-b p-3">
                        {{ $log['metadata']['room_id'] ?? '-' }}
                    </td>

                    <td class="border-b p-3">
                        {{ $log['metadata']['duration'] ?? '-' }} hari
                    </td>

                    <td class="border-b p-3">
                        {{ $log['metadata']['payment_method'] ?? '-' }}
                    </td>

                    <td class="border-b p-3">
                        {{ $log['created_at'] }}
                    </td>
                </tr>
                @empty
                <tr class="text-center">
                    <td colspan="6" class="p-4 text-gray-500">Tidak ada data booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
