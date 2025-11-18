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
        $this->url = rtrim(env('SUPABASE_URL'), '/');
        $this->key = env('SUPABASE_KEY');

        $this->headers = [
            'apikey'            => $this->key,
            'Authorization'     => 'Bearer ' . $this->key,
            'Content-Type'      => 'application/json',
            'Prefer'            => 'return=representation'
        ];
    }

    public function getAllRooms()
    {
        $response = Http::withHeaders($this->headers)
            ->get("{$this->url}/rest/v1/rooms", [
                'select' => '*',
                'order'  => 'created_at.desc'
            ]);

        return $response->successful() ? $response->json() : [];
    }

    public function getAllBookingsSimple()
    {
        $response = Http::withHeaders($this->headers)
            ->get("{$this->url}/rest/v1/bookings", [
                'select' => '*',
                'order'  => 'created_at.desc'
            ]);

        return $response->successful() ? $response->json() : [];
    }

    public function createBooking($data)
    {
        $response = Http::withHeaders($this->headers)
            ->post("{$this->url}/rest/v1/bookings", $data);

        if ($response->failed()) {
            Log::error('Supabase createBooking Error: ' . $response->body());
        }

        return $response;
    }

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

    

    public function deleteBooking($id)
    {
        $response = Http::withHeaders($this->headers)
            ->delete("{$this->url}/rest/v1/bookings?id=eq.{$id}");

        if ($response->failed()) {
            Log::error('Supabase deleteBooking Error: ' . $response->body());
        }

        return $response;
    }
}


