<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupabaseService;

class BookingManagementController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        // Ambil data booking dari Supabase
        $bookings = $this->supabase->getAllBookingsSimple();

        // Ambil semua kamar
        $rooms = $this->supabase->getAllRooms();

        // Map room_id → detail room
        $roomMap = [];
        foreach ($rooms as $room) {
            $roomMap[$room['id']] = $room;
        }

        // Gabungkan room ke setiap booking TANPA merusak kolom id booking
        foreach ($bookings as &$b) {
            $b['room'] = $roomMap[$b['room_id']] ?? null;
        }

        return view('admin.rooms.index', [
            'bookings' => $bookings
        ]);
    }

    public function updateStatus($id)
    {
        request()->validate([
            'status' => 'required|in:pending,confirmed,rejected'
        ]);

        $status = request()->input('status');

        // Update status ke Supabase
        $this->supabase->updateBookingStatus($id, $status);

        return back()->with('success', 'Status booking diperbarui.');
    }
}
