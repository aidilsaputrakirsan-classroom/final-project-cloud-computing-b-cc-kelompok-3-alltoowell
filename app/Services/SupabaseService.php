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
        // Pakai config() karena lebih aman & standar dalam Laravel
        $this->url = rtrim(config('services.supabase.url', env('SUPABASE_URL')), '/');
        $this->key = config('services.supabase.key', env('SUPABASE_KEY'));

        $this->headers = [
            'apikey'        => $this->key,
            'Authorization' => 'Bearer ' . $this->key,
            'Content-Type'  => 'application/json',
            'Prefer'        => 'return=representation'
        ];
    }

    /**
     * Ambil semua rooms
     */
    public function getAllRooms()
    {
        $response = Http::withHeaders($this->headers)->get("{$this->url}/rest/v1/rooms", [
            'select' => '*',
            'order'  => 'created_at.desc'
        ]);

        return $response->successful() ? $response->json() : [];
    }

    /**
     * Ambil room berdasarkan nomor
     */
    public function getRoomByNumber($number)
    {
        $response = Http::withHeaders($this->headers)->get("{$this->url}/rest/v1/rooms", [
            'room_number' => "eq.{$number}"
        ]);

        return $response->successful() ? $response->json() : [];
    }

    /**
     * Ambil semua booking sederhana
     */
    public function getAllBookingsSimple()
    {
        $response = Http::withHeaders($this->headers)->get("{$this->url}/rest/v1/bookings", [
            'select' => '*',
            'order'  => 'created_at.desc'
        ]);

        return $response->successful() ? $response->json() : [];
    }

    /**
     * Ambil booking + join room
     */
    public function getAllBookingsWithRoom()
    {
        $response = Http::withHeaders($this->headers)->get("{$this->url}/rest/v1/bookings", [
            'select' => '*, room:rooms(name, price, location, image, room_number)',
            'order'  => 'created_at.desc'
        ]);

        return $response->successful() ? $response->json() : [];
    }

    /**
     * Buat booking baru
     */
    public function createBooking($data)
    {
        $response = Http::withHeaders($this->headers)
            ->post("{$this->url}/rest/v1/bookings", $data);

        if ($response->failed()) {
            Log::error('Supabase createBooking Error: ' . $response->body());
        }

        return $response;
    }

    /**
     * Update status booking
     */
    public function updateBookingStatus($id, $status)
    {
        $response = Http::withHeaders($this->headers)
            ->patch("{$this->url}/rest/v1/bookings?id=eq.{$id}", [
                'status' => $status
            ]);

        if ($response->failed()) {
            Log::error('Supabase updateBookingStatus Error: ' . $response->body());
        }

        return $response;
    }

    /**
     * Hapus booking
     */
    public function deleteBooking($id)
    {
        $response = Http::withHeaders($this->headers)
            ->delete("{$this->url}/rest/v1/bookings?id=eq.{$id}");

        if ($response->failed()) {
            Log::error('Supabase deleteBooking Error: ' . $response->body());
        }

        return $response;
    }

    /**
     * Hitung total booking
     */
    public function getBookingCount()
    {
        $response = Http::withHeaders($this->headers)
            ->get("{$this->url}/rest/v1/bookings", [
                'select' => 'id'
            ]);

        if ($response->failed()) {
            return 0;
        }

        // Supabase mengirim Content-Range: */123
        $range = $response->header('Content-Range');

        if ($range && preg_match('/\/(\d+)$/', $range, $matches)) {
            return (int) $matches[1];
        }

        // fallback
        return count($response->json());
    }
}
