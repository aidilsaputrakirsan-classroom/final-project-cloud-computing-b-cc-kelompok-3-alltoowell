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
        // ============================
        // AMBIL DATA
        // ============================
        $rooms = $this->supabase->getAllRooms();
        $bookings = $this->supabase->getAllBookingsSimple();

        // ============================
        // MAP ROOM -> PRICE & NAME
        // ============================
        $roomMap = [];
        foreach ($rooms as $room) {
            $roomMap[$room['id']] = [
                'price' => $room['price'] ?? 0,
                'name'  => $room['name'] ?? '-',
            ];
        }

        // =====================================================
        // TAMBAHKAN INFO ROOM KE SEMUA BOOKING UNTUK TABEL
        // =====================================================
        $bookings = array_map(function ($b) use ($roomMap) {
            $roomId = $b['room_id'] ?? null;

            $b['room_price'] = $roomMap[$roomId]['price'] ?? 0;
            $b['room_name']  = $roomMap[$roomId]['name'] ?? '-';

            return $b;
        }, $bookings);

        // =====================================================
        // FILTER BOOKING VALID (CONFIRMED SAJA)
        // =====================================================
        $validBookings = array_filter($bookings, function ($b) {
            return isset($b['status']) && $b['status'] === 'confirmed';
        });

        // =====================================================
        // HITUNG REVENUE & GRAFIK
        // =====================================================
        $totalRevenue = 0;
        $monthlyRevenue = 0;
        $currentMonth = date('Y-m');

        $bookingChart = [];
        $revenueChart = [];
        $roomPopularity = [];

        foreach ($validBookings as $b) {
            $roomId = $b['room_id'] ?? null;
            $price = $roomMap[$roomId]['price'] ?? 0;

            // Total pendapatan
            $totalRevenue += $price;

            // Pendapatan bulan berjalan
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
            $roomPopularity[$roomMap[$roomId]['name']] =
                ($roomPopularity[$roomMap[$roomId]['name']] ?? 0) + 1;
        }

        ksort($bookingChart);
        ksort($revenueChart);
        arsort($roomPopularity);

        // =====================================================
        // HITUNG KAMAR TERSEDIA (HANYA CONFIRMED YG MENGUNCI)
        // =====================================================
        $bookedRoomIds = array_column($validBookings, 'room_id');

        $availableRooms = array_filter($rooms, function ($room) use ($bookedRoomIds) {
            return !in_array($room['id'], $bookedRoomIds);
        });

        // =====================================================
        // KIRIM DATA KE BLADE
        // =====================================================
        return view('admin.dashboard', [
            'rooms'          => $rooms,
            'bookings'       => $bookings, // semua status untuk tabel
            'totalRooms'     => count($rooms),
            'availableRooms' => count($availableRooms),
            'totalBookings'  => count($validBookings), // hanya confirmed

            'totalRevenue'   => $totalRevenue,
            'monthlyRevenue' => $monthlyRevenue,

            'bookingChart'   => $bookingChart,
            'revenueChart'   => $revenueChart,

            'topRooms'       => array_slice($roomPopularity, 0, 5, true),
        ]);
    }
}
