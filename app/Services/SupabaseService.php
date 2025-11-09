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
            'Prefer' => 'return=representation'
        ];
    }

    // 1. GET ALL ROOMS
    public function getAllRooms()
    {
        $response = Http::withHeaders($this->headers)
            ->get("{$this->url}/rooms", [
                'select' => '*',
                'order' => 'room_number.asc'
            ]);

        return $response->successful() ? $response->json() : [];
    }

    // 2. GET ROOM BY room_number
    public function getRoomByNumber($number)
    {
        $response = Http::withHeaders($this->headers)
            ->get("{$this->url}/rooms", [
                'room_number' => "eq.{$number}"
            ]);

        return $response->successful() ? $response->json() : [];
    }

    // 3. CREATE BOOKING
    public function createBooking($data)
    {
        $response = Http::withHeaders($this->headers)->post("{$this->url}/bookings", $data);

        if ($response->failed()) {
            Log::error('Supabase createBooking Error: ' . $response->body());
        }
        return $response;
    }

    // 4. GET ALL BOOKINGS + ROOM INFO
    public function getAllBookingsWithRoom()
    {
        $response = Http::withHeaders($this->headers)
            ->get("{$this->url}/bookings", [
                'select' => '*,room:rooms(name,price,location,image,room_number)',
                'order' => 'created_at.desc'
            ]);

        return $response->successful() ? $response->body() : '[]';
    }

    // 5. UPDATE STATUS BOOKING (INI YANG BENAR!)
    public function updateBookingStatus($id, $status)
    {
        $response = Http::withHeaders($this->headers)
            ->patch("{$this->url}/bookings?id=eq.{$id}", [
                'status' => $status
            ]);

        if ($response->failed()) {
            Log::error('Supabase updateBookingStatus Error: ' . $response->body());
        }
        return $response;
    }

    // 6. DELETE BOOKING (INI YANG BENAR!)
    public function deleteBooking($id)
    {
        $response = Http::withHeaders($this->headers)
            ->delete("{$this->url}/bookings?id=eq.{$id}");

        if ($response->failed()) {
            Log::error('Supabase deleteBooking Error: ' . $response->body());
        }
        return $response;
    }

    // 7. HITUNG TOTAL BOOKING
    public function getBookingCount()
    {
        $response = Http::withHeaders($this->headers)
            ->get("{$this->url}/bookings", ['select' => 'id']);

        if ($response->failed()) return 0;

        $range = $response->header('Content-Range');
        if ($range && preg_match('/\/(\d+)$/', $range, $matches)) {
            return (int)$matches[1];
        }

        return count($response->json());
    }
}
