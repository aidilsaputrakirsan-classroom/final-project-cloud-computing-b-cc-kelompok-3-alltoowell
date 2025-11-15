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
        // Ambil data kamar dari Supabase
        $rooms = $this->supabase->getAllRooms();

        // Hitung total kamar
        $totalRooms = count($rooms);

        // Hitung kamar yang tersedia
        $availableRooms = count(array_filter($rooms, function ($r) {
            return empty($r['status']) || $r['status'] !== 'occupied';
        }));

        // Kirim ke view
        return view('home.index', compact('rooms', 'totalRooms', 'availableRooms'));
    }
}
