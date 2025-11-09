<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SupabaseService
{
    protected $url;
    protected $key;
    protected $headers;

    public function __construct()
    {
        $this->url = config('services.supabase.url');
        $this->key = config('services.supabase.key');
        $this->headers = [
            'apikey' => $this->key,
            'Authorization' => 'Bearer ' . $this->key,
            'Content-Type' => 'application/json',
            'Prefer' => 'return=minimal'
        ];
    }

    // 1. GET ROOM BY UUID
    public function getRoom($id)
    {
        $response = Http::withHeaders($this->headers)
            ->get("{$this->url}/rooms", ['id' => "eq.{$id}"]);

        if ($response->failed()) {
            Log::error('Supabase getRoom Error: ' . $response->body());
            return [];
        }

        return $response->json();
    }

    // 2. CREATE BOOKING
    public function createBooking($data)
    {
        return Http::withHeaders($this->headers)
            ->post("{$this->url}/bookings", $data);
    }

    // 3. GET ALL BOOKINGS + ROOM INFO
        public function getAllBookingsWithRoom()
    {
        $response = Http::withHeaders($this->headers)
            ->get("{$this->url}/bookings", [
                'select' => '*,room:rooms(name,location,price,image)',
                'order' => 'created_at.desc'
            ]);

        return $response->body(); // RETURN STRING, BUKAN ->json()!
    }
    // 4. UPDATE STATUS (PAKAI UUID!)
    public function updateBookingStatus($id, $status)
    {
        return Http::withHeaders($this->headers)
            ->patch("{$this->url}/bookings?id=eq.{$id}", ['status' => $status]);
    }

    // 5. DELETE BOOKING (PAKAI UUID!)
    public function deleteBooking($id)
    {
        return Http::withHeaders($this->headers)
            ->delete("{$this->url}/bookings?id=eq.{$id}");
    }

    // 6. HITUNG TOTAL BOOKING → UNTUK B001, B002, B003
    public function getBookingCount()
    {
        $response = Http::withHeaders($this->headers)
            ->get("{$this->url}/bookings", ['select' => 'id']);

        if ($response->failed()) {
            Log::error('getBookingCount failed: ' . $response->body());
            return 0;
        }

        return count($response->json());
    }
}
