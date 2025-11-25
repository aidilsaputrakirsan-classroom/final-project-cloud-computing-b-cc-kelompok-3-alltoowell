<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Helpers\ActivityLogger;

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
     * USER MELIHAT FORM BOOKING
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

        // ACTIVITY LOG
        if (session('user_id')) {
            ActivityLogger::log(
                'view_booking_form',
                'User membuka halaman booking',
                ['room_id' => $id]
            );
        }

        return view('booking.index', compact('room'));
    }

    /**
     * USER MENAMBAH BOOKING
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'start_date'      => 'required|date',
            'duration'        => 'required|integer|min:1',
            'payment_method'  => 'required|string',
        ]);

        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Silakan login dulu.');
        }

        // Generate ID unik booking
        $uuid       = (string) Str::uuid();
        $bookingId  = 'BK-' . strtoupper(Str::random(6));

        // Payload ke Supabase
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

        $response = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
            'Content-Type'  => 'application/json',
            'Prefer'        => 'return=representation'
        ])->post("{$this->supabaseUrl}/rest/v1/bookings", $payload);

        if ($response->failed()) {
            dd([
                'status'  => $response->status(),
                'error'   => $response->body(),
                'payload' => $payload,
            ]);
        }

        // ACTIVITY LOG
        ActivityLogger::log(
            'create_booking',
            'User membuat booking baru',
            [
                'booking_id' => $bookingId,
                'room_id' => $id,
                'duration' => $request->duration,
                'payment_method' => $request->payment_method
            ]
        );

        return redirect()->route('user.bookings')
            ->with('success', 'Booking berhasil dibuat. Silakan tunggu konfirmasi.');
    }

    /**
     * USER MELIHAT LIST BOOKING
     */
    public function userBookings()
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Silakan login dulu.');
        }

        $userId = session('user_id');

        // Ambil booking user
        $bookings = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/bookings?user_id=eq.$userId&select=*")->json() ?? [];

        // Ambil kamar
        $roomsData = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/rooms")->json();

        $roomMap = collect($roomsData)->keyBy('id')->toArray();

        foreach ($bookings as &$b) {
            $b['room'] = $roomMap[$b['room_id']] ?? null;
        }

        // ACTIVITY LOG
        ActivityLogger::log(
            'view_user_bookings',
            'User membuka halaman daftar booking'
        );

        return view('booking.my-bookings', compact('bookings'));
    }
}
