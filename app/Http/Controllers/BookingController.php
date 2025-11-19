<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    private $supabaseUrl;
    private $supabaseKey;

    public function __construct()
    {
        $this->supabaseUrl = rtrim(env('SUPABASE_URL'), '/');
        $this->supabaseKey = env('SUPABASE_KEY');
    }

    /**
     * TAMPILKAN FORM BOOKING
     */
    public function show($id)
    {
        $response = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/rooms?id=eq.$id&select=*");

        $data = $response->json();

        if (empty($data)) {
            abort(404, 'Kamar tidak ditemukan');
        }

        $room = $data[0];

        return view('booking.index', compact('room'));
    }

    /**
     * SIMPAN BOOKING ↗️ KE SUPABASE
     */
    public function store(Request $request, $id)
    {
        // Validasi input form
        $request->validate([
            'start_date'      => 'required|date',
            'duration'        => 'required|integer|min:1',
            'payment_method'  => 'required|string',
        ]);

        // Pastikan user login
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Silakan login dulu.');
        }

        // Generate ID booking
        $uuid       = (string) Str::uuid();
        $bookingId  = 'BK-' . strtoupper(Str::random(6));

        // Data yang dikirim ke Supabase
        $payload = [
            'id'             => $uuid,
            'booking_id'     => $bookingId,
            'room_id'        => $id,
            'user_id'        => session('user_id'),
            'user_name'      => session('user_name'),
            'user_email'     => session('user_email'),
            'user_phone'     => session('user_phone'),
            'start_date'     => $request->start_date,
            'duration'       => (int) $request->duration,
            'payment_method' => $request->payment_method,
            'status'         => 'pending',
        ];

        // Kirim ke Supabase
        $response = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Content-Type'  => 'application/json',
            'Prefer'        => 'return=representation'
        ])->post("{$this->supabaseUrl}/rest/v1/bookings", $payload);

        /**
         * 🔥 DEBUG — SUPABASE ERROR AKAN MUNCUL DI LAYAR
         * KIRIM screenshot halamannya ke aku nanti ku fix.
         */
        if ($response->failed()) {
            dd([
                'status'  => $response->status(),
                'error'   => $response->body(),
                'payload' => $payload,
            ]);
        }

        return redirect('/')
            ->with('success', 'Booking berhasil disimpan!');
    }
}
