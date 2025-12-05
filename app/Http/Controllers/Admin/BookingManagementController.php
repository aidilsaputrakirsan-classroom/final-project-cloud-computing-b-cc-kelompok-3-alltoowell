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

        // Buat map id kamar → detail kamar
        $roomMap = [];
        foreach ($rooms as $room) {
            $roomMap[$room['id']] = $room;
        }

        // Gabungkan room detail ke booking
        foreach ($bookings as &$b) {
            $b['room'] = $roomMap[$b['room_id']] ?? [
                'name' => 'Tidak ditemukan',
                'location' => '-',
                'price' => 0
            ];
        }

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

        // Update ke Supabase
        $this->supabase->updateBookingStatus($id, $status);

        return back()->with('success', 'Status booking berhasil diperbarui');
    }
}
