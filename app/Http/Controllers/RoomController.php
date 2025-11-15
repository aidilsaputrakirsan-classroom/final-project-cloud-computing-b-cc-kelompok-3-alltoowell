<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class RoomController extends Controller
{
    private $supabaseUrl;
    private $supabaseKey;

    public function __construct()
    {
        $this->supabaseUrl = rtrim(env('SUPABASE_URL'), '/');
        $this->supabaseKey = env('SUPABASE_KEY');
    }

    /**
     * Halaman daftar kamar (untuk user)
     */
    public function index()
    {
        $response = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/rooms?select=*&order=created_at.desc");

        $rooms = $response->json();

        return view('rooms.index', compact('rooms'));
    }

    /**
     * Halaman detail kamar (untuk user)
     */
    public function show($id)
    {
        $response = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/rooms?id=eq.{$id}&select=*");

        $data = $response->json();

        if (empty($data)) {
            abort(404, 'Kamar tidak ditemukan');
        }

        $room = $data[0];

        // Convert facilities JSON string → array
        if (!empty($room['facilities']) && is_string($room['facilities'])) {
            $room['facilities'] = json_decode($room['facilities'], true);
        }

        return view('rooms.show', compact('room'));
    }
}
