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
     * HALAMAN LIST KAMAR
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
     * HALAMAN DETAIL KAMAR
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

        /*
        |---------------------------------------------------------------
        | OWNER INFO OTOMATIS BERDASARKAN TIPE KAMAR
        |---------------------------------------------------------------
        |
        | Kamu tidak perlu simpan info pemilik di Supabase,
        | semua dikendalikan dari sini.
        |
        */

        $name = strtolower($room['name']);

        if (str_contains($name, 'standard')) {
            $owner = [
                'phone' => '+62 812-3456-7890',
                'email' => 'owner-standard@kost-si.com',
                'wa'    => 'https://wa.me/6281234567890'
            ];
        } elseif (str_contains($name, 'deluxe')) {
            $owner = [
                'phone' => '+62 813-8888-1212',
                'email' => 'owner-deluxe@kost-si.com',
                'wa'    => 'https://wa.me/6281388881212'
            ];
        } elseif (str_contains($name, 'superior')) {
            $owner = [
                'phone' => '+62 811-7777-3333',
                'email' => 'owner-superior@kost-si.com',
                'wa'    => 'https://wa.me/6281177773333'
            ];
        } elseif (str_contains($name, 'premium')) {
            $owner = [
                'phone' => '+62 814-9999-4545',
                'email' => 'owner-premium@kost-si.com',
                'wa'    => 'https://wa.me/6281499994545'
            ];
        } else {
            // default kalau tidak masuk kategori manapun
            $owner = [
                'phone' => '+62 812-1111-2222',
                'email' => 'info@kost-si.com',
                'wa'    => 'https://wa.me/6281211112222'
            ];
        }

        return view('rooms.show', [
            'room' => $room,
            'owner' => $owner
        ]);
    }
}
