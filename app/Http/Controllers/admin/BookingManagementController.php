<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupabaseService;
use App\Helpers\ActivityLogger;

class BookingManagementController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        $bookings = $this->supabase->getAllBookingsSimple();
        $rooms = $this->supabase->getAllRooms();

        $roomMap = [];
        foreach ($rooms as $room) {
            $roomMap[$room['id']] = $room;
        }

        foreach ($bookings as &$b) {
            $b['room'] = $roomMap[$b['room_id']] ?? [
                'name' => 'Tidak ditemukan',
                'location' => '-',
                'price' => 0
            ];
        }

        ActivityLogger::log(
            'admin_open_booking_management',
            'Admin membuka halaman manajemen booking'
        );

        return view('admin.bookings', [
            'bookings' => $bookings
        ]);
    }

    public function updateStatus($id)
    {
        request()->validate([
            'status' => 'required|in:pending,confirmed,rejected'
        ]);

        $status = request('status');

        $this->supabase->updateBookingStatus($id, $status);

        ActivityLogger::log(
            'admin_update_booking',
            'Admin mengubah status booking',
            [
                'booking_id' => $id,
                'new_status' => $status
            ]
        );

        return back()->with('success', 'Status booking berhasil diperbarui');
    }
}
