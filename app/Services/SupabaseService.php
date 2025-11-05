<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // ← TAMBAH INI!

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
        ];
    }

    public function getRoom($id)
    {
        $response = Http::withHeaders($this->headers)
            ->get("{$this->url}/rooms", [
                'id' => "eq.{$id}"
            ]);

        if ($response->failed()) {
            Log::error('Supabase Error: ' . $response->body()); // ← SEKARANG JALAN!
            return [];
        }

        return $response->json();
    }

    public function createBooking($data)
    {
        return Http::withHeaders($this->headers)
            ->post("{$this->url}/bookings", $data);
    }

    public function getAllBookingsWithRoom()
    {
        return Http::withHeaders($this->headers)
            ->get("{$this->url}/bookings", [
                'select' => '*,room:rooms(name,location,price)',
                'order' => 'created_at.desc'
            ])
            ->json();
    }

    public function updateBookingStatus($id, $status)
    {
        return Http::withHeaders($this->headers)
            ->patch("{$this->url}/bookings", ['status' => $status])
            ->withQueryParameters(['id' => "eq.{$id}"]);
    }

    public function deleteBooking($id)
    {
        return Http::withHeaders($this->headers)
            ->delete("{$this->url}/bookings", ['id' => "eq.{$id}"]);
    }

    public function getLatestBookingId()
    {
        $data = Http::withHeaders($this->headers)
            ->get("{$this->url}/bookings", [
                'select' => 'id',
                'order' => 'id.desc',
                'limit' => 1
            ])
            ->json();

        return $data ? (int) end($data)['id'] : 0;
    }
}
