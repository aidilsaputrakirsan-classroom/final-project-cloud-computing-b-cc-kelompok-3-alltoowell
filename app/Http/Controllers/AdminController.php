<?php

namespace App\Http\Controllers;

use App\Services\SupabaseService;

class AdminController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function dashboard()
    {
        $rooms = $this->supabase->getAllRooms();
        $bookings = $this->supabase->getAllBookingsWithRoom();
        $totalBookings = $this->supabase->getBookingCount();

        return view('admin.dashboard', compact(
            'rooms',
            'bookings',
            'totalBookings'
        ));
    }
}
