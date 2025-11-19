<?php

namespace App\Http\Controllers;

use App\Services\SupabaseService;
use Illuminate\View\View;

class HomeController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index(): View
    {
        // Ambil semua kamar dari Supabase
        $rooms = $this->supabase->getAllRooms();

        // Total kamar
        $totalRooms = count($rooms);

        // Kamar tersedia (status != occupied)
        $availableRooms = count(array_filter($rooms, function ($room) {
            return !isset($room['status']) || $room['status'] !== 'occupied';
        }));

        // Kirim ke view home
        return view('home.index', [
            'rooms'          => $rooms,
            'totalRooms'     => $totalRooms,
            'availableRooms' => $availableRooms,
        ]);
    }
}
