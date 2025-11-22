<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupabaseService;

class DashboardController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        // Ambil data
        $rooms = $this->supabase->getAllRooms();
        $bookings = $this->supabase->getAllBookingsSimple();

        // Map harga & nama kamar
        $roomMap = [];
        foreach ($rooms as $room) {
            $roomMap[$room['id']] = [
                'price' => $room['price'] ?? 0,
                'name'  => $room['name'] ?? '-',
            ];
        }

        // Gabungkan room info ke booking
        $bookings = array_map(function ($b) use ($roomMap) {
            $rid = $b['room_id'] ?? null;

            $b['room_price'] = $roomMap[$rid]['price'] ?? 0;
            $b['room_name']  = $roomMap[$rid]['name'] ?? '-';

            return $b;
        }, $bookings);

        // Booking valid (confirmed)
        $validBookings = array_filter($bookings, fn($b) =>
            ($b['status'] ?? '') === 'confirmed'
        );

        // Perhitungan KPI
        $totalRevenue = 0;
        $monthlyRevenue = 0;
        $currentMonth = date('Y-m');

        $bookingChart = [];
        $revenueChart = [];
        $roomPopularity = [];

        foreach ($validBookings as $b) {
            $rid = $b['room_id'] ?? null;
            $price = $roomMap[$rid]['price'] ?? 0;

            // Total revenue
            $totalRevenue += $price;

            // Revenue bulan ini
            if (isset($b['created_at']) && str_starts_with($b['created_at'], $currentMonth)) {
                $monthlyRevenue += $price;
            }

            // Grafik bulanan
            if (isset($b['created_at'])) {
                $monthKey = date('Y-m', strtotime($b['created_at']));

                $bookingChart[$monthKey] = ($bookingChart[$monthKey] ?? 0) + 1;
                $revenueChart[$monthKey] = ($revenueChart[$monthKey] ?? 0) + $price;
            }

            // Popularitas kamar
            $roomPopularity[$roomMap[$rid]['name']] =
                ($roomPopularity[$roomMap[$rid]['name']] ?? 0) + 1;
        }

        // Sort grafik
        ksort($bookingChart);
        ksort($revenueChart);
        arsort($roomPopularity);

        // Kamar tersedia (confirmed mengunci kamar)
        $bookedRoomIds = array_column($validBookings, 'room_id');
        $availableRooms = array_filter($rooms, fn($room) =>
            !in_array($room['id'], $bookedRoomIds)
        );

        // Pending count
        $pendingCount = count(array_filter($bookings, fn($b) =>
            ($b['status'] ?? '') === 'pending'
        ));

        // Recent booking (limit 6)
        $recentBookings = array_slice($bookings, 0, 6);

        // Kirim ke view
        return view('admin.dashboard', [
            'rooms'            => $rooms,
            'bookings'         => $bookings,
            'recentBookings'   => $recentBookings,
            'totalRooms'       => count($rooms),
            'availableRooms'   => count($availableRooms),
            'totalBookings'    => count($validBookings),

            'pendingCount'     => $pendingCount,
            'totalRevenue'     => $totalRevenue,
            'monthlyRevenue'   => $monthlyRevenue,

            'bookingChart'     => $bookingChart,
            'revenueChart'     => $revenueChart,

            'topRooms'         => array_slice($roomPopularity, 0, 5, true),
        ]);
    }
}
