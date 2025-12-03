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
     * Tampilkan Form Booking
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
     * Simpan Booking + Hitung Total Price
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

        // Ambil data room
        $roomResponse = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/rooms?id=eq.$id&select=*");

        $roomData = $roomResponse->json();
        if (empty($roomData)) {
            abort(404, 'Room tidak ditemukan.');
        }

        $room = $roomData[0];

        // Hitung total price
        $duration = (int) $request->duration;
        $pricePerMonth = (int) $room['price'];
        $totalPrice = $duration * $pricePerMonth;

        // Generate ID
        $uuid       = (string) Str::uuid();
        $bookingId  = 'BK-' . strtoupper(Str::random(6));

        // Data booking
        $payload = [
            'id'             => $uuid,
            'booking_id'     => $bookingId,
            'room_id'        => $id,
            'user_id'        => session('user_id'),
            'user_name'      => session('user_name'),
            'user_email'     => session('user_email'),
            'user_phone'     => session('user_phone'),
            'start_date'     => $request->start_date,
            'duration'       => $duration,
            'payment_method' => $request->payment_method,
            'total_price'    => $totalPrice,
            'status'         => 'pending',
        ];

        // Simpan ke Supabase
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

        return redirect()->route('user.bookings')
            ->with('success', 'Booking berhasil dibuat!');
    }

    /**
     * Pesanan Saya
     */
    public function userBookings()
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Silakan login dulu.');
        }

        $userId = session('user_id');

        // Ambil booking + total_price
        $bookings = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/bookings?user_id=eq.$userId&select=*")
            ->json() ?? [];

        // Ambil data kamar
        $rooms = Http::withHeaders([
            'apikey'        => $this->supabaseKey,
            'Authorization' => 'Bearer ' . $this->supabaseKey,
        ])->get("{$this->supabaseUrl}/rest/v1/rooms")
            ->json();

        $roomMap = collect($rooms)->keyBy('id')->toArray();

        // Gabungkan
        foreach ($bookings as &$b) {
            $b['room'] = $roomMap[$b['room_id']] ?? null;
        }

        return view('booking.my-bookings', compact('bookings'));
    }
}
