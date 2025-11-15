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
        $rooms = $this->supabase->getAllRooms();
        $bookings = $this->supabase->getAllBookingsWithRoom();

        return view('admin.dashboard', [
            'totalRooms' => count($rooms),
            'availableRooms' => count(array_filter($rooms, fn($r) => $r['status'] === 'available')),
            'totalBookings' => count($bookings),
        ]);
    }
}
