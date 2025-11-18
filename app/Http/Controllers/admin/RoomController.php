<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupabaseService;

class RoomController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        // Ambil semua booking
        $bookings = $this->supabase->getAllBookingsSimple();

        // Ambil semua rooms untuk relasi
        $rooms = $this->supabase->getAllRooms();

        // Mapping room id → room detail
        $roomMap = [];
        foreach ($rooms as $r) {
            $roomMap[$r['id']] = $r;
        }

        // Gabungkan room ke booking
        foreach ($bookings as &$b) {
            $roomId = $b['room_id'] ?? null;
            $b['room'] = $roomMap[$roomId] ?? null;
        }

        return view('admin.rooms.index', [
            'bookings' => $bookings
        ]);
    }
}
