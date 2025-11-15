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
        $rooms = $this->supabase->getAllRooms();

        $totalRooms = count($rooms);
        $availableRooms = count(array_filter($rooms, fn($r) =>
            empty($r['status']) || $r['status'] !== 'occupied'
        ));

        return view('home.index', compact('rooms', 'totalRooms', 'availableRooms'));
    }
}